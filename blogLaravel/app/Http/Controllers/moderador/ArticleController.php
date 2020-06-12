<?php

namespace App\Http\Controllers\moderador;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use App\ArticleImage;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miga='Artículos';
        //Cogemos usuario autenticado(moderador)
        $usuario=auth()->user();
        //Para mostrar cuantos artículos hay
        $todosArticulos=$usuario->articles()->withoutGlobalScope('activo')->count();
        //withoutGlobalScope para indicarle que no solo saque los articulos activos, si no todos.
        $articulos=$usuario->articles()->withoutGlobalScope('activo')->with(['user','theme'])->orderBy('id','desc')->paginate(10);
        return view('moderador.articulos.index')->with(compact('miga','articulos','todosArticulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $miga='Añadir Articulo';
        return view('moderador.articulos.create')->with(compact('miga'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages=[
            'titulo.required' => 'El campo Título no puede quedar vacío',
            'titulo.unique' => 'El Título de este artículo ya existe',
            'contenido' => 'El campo Contenido no puede quedar vacío',
            'foto0.mimes' => 'No es una imagen',
            'foto0.max' => 'Archivo demasiado grande',
            'foto1.mimes' => 'No es una imagen',
            'foto1.max' => 'Archivo demasiado grande',
            'foto2.mimes' => 'No es una imagen',
            'foto2.max' => 'Archivo demasiado grande',
        ];

        $rules=[
            'titulo' => 'required|unique:articles',
            'contenido' => 'required',
            //tipos de extension se indica con "mimes" y tamaño de imagen 1mb
            'foto0' => 'mimes:jpeg,png|max:1048',
            'foto1' => 'mimes:jpeg,png|max:1048',
            'foto2' => 'mimes:jpeg,png|max:1048',

        ];

        $this->validate($request, $rules, $messages);

        $articulo=new Article();
        $articulo->titulo=$request->titulo;
        $articulo->theme_id=$request->theme_id;
        $articulo->contenido=$request->contenido;
        $articulo->user_id=auth()->user()->id;
        $articulo->save();

        //Guardamos las imagenes en nuestro proyecto

        for($i=0;$i<3;$i++)
        {
            //¿Tiene algún archivo?
            if($request->hasfile('foto'.$i))
            {
                //guardamos imagen en la carpeta especificada
                $path=$request->file('foto'.$i)->store('public/imagenesArticulos');
                //para que en el servidor aparezca solo el nombre del archivo y no toda la ruta donde guardamos la imagen mas el nombre del archivo.
                $nombreImagen = collect(explode('/', $path))->last();
                $extensionImagen = collect(explode('.', $path))->last();

                //Reducir peso imagen
                //Cogemos la imagen que hemos metido anteriormente
                $imagen = Image::make(Storage::get($path));
                //Redimensionamos imagen
                $imagen->resize(250,250);
                //Volvemos a meter la imagen
                Storage::put($path,$imagen->encode($extensionImagen, 75));

                //Creamos instancia del modelo ArticleImage() que es el que esta relacionado con las imagenes de los articulos y en el atributo imagen metemos el nombre de la imagen.
                $imagen=new ArticleImage();
                $imagen->nombre = $nombreImagen;
                //corresponde a la id del articulo
                $imagen->article_id = $articulo->id;
                $imagen->save();
            }
        }

        $articuloTitulo = $articulo->titulo;
        $notificacion = "El artículo $articuloTitulo se ha añadido correctamente";
        return back()->with(compact('notificacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $this->authorize('view', $articulo);
        $miga='Mostrar Articulo';
        return view('moderador.articulos.show')->with(compact('miga','articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $this->authorize('edit', $articulo);
        $miga='Editar Artículo';
        return view('moderador.articulos.edit')->with(compact('articulo','miga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $this->authorize('update', $articulo);
         $messages=[
            'titulo.required' => 'El campo Título no puede quedar vacío',
            'titulo.unique' => 'El Título de este artículo ya existe',
            'contenido' => 'El campo Contenido no puede quedar vacío',
            'foto1.mimes' => 'No es una imagen',
            'foto1.max' => 'Archivo demasiado grande',
            'foto2.mimes' => 'No es una imagen',
            'foto2.max' => 'Archivo demasiado grande',
            'foto3.mimes' => 'No es una imagen',
            'foto3.max' => 'Archivo demasiado grande',
        ];

        $rules=[
            'titulo' => ['required',Rule::unique('articles')->ignore($articulo->id)],
            'contenido' => 'required',
            //tipos de extension se indica con "mimes" y tamaño de imagen 1mb
            'foto1' => 'mimes:jpeg,png|max:1048',
            'foto2' => 'mimes:jpeg,png|max:1048',
            'foto3' => 'mimes:jpeg,png|max:1048',

        ];

        $this->validate($request, $rules, $messages);


        $articulo->titulo=$request->titulo;
        $articulo->theme_id=$request->theme_id;
        $articulo->contenido=$request->contenido;
        $articulo->save();

        //Guardamos las imagenes en nuestro proyecto

        for($i=1;$i<4;$i++)
        {
            //¿Tiene algún archivo?
            if($request->hasfile('foto'.$i))
            {
                //guardamos imagen en la carpeta especificada
                $path=$request->file('foto'.$i)->store('public/imagenesArticulos');
                //para que en el servidor aparezca solo el nombre del archivo y no toda la ruta donde guardamos la imagen mas el nombre del archivo.
                $nombreImagen = collect(explode('/', $path))->last();
                $extensionImagen = collect(explode('.', $path))->last();

                //Reducir peso imagen
                //Cogemos la imagen que hemos metido anteriormente
                $imagen = Image::make(Storage::get($path));
                //Redimensionamos imagen
                $imagen->resize(250,250);
                //Volvemos a meter la imagen
                Storage::put($path,$imagen->encode($extensionImagen, 75));

                //Creamos instancia del modelo ArticleImage() que es el que esta relacionado con las imagenes de los articulos y en el atributo imagen metemos el nombre de la imagen.
                $imagen=new ArticleImage();
                $imagen->nombre = $nombreImagen;
                //corresponde a la id del articulo
                $imagen->article_id = $articulo->id;
                $imagen->save();
            }
        }

        $miga='Artículos';
        $notificacion = "El artículo se ha actualizado correctamente";
        return redirect('moderador/articulos')->with(compact('notificacion','miga'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $this->authorize('delete', $articulo);
        foreach($articulo->images as $imagen)
        {
            // Borramos la imagen físicamente
            Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
        }
        $articulo->delete();
        $notificacion2="El articulo ha sido eliminado";
        return back()->with(compact('notificacion2'));
    }
}

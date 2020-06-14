<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Theme;
use Illuminate\Support\Facades\Storage;
use App\Jobs\BorrarTema;
use Illuminate\Validation\Rule;

class ThemeController extends Controller
{
    //Mostramos
    public function index()
    {
        $miga='Temas';
    	//Consigue todos los temas y los ordena descendente para que salgan los actuales primero
    	$temas=Theme::with(['user'])->orderBy('id','desc')->get();
    	return view('admin.temas.index')->with(compact('temas','miga'));
    }

    //Creamos
    public function create()
    {
        $miga='Añadir Tema';
        return view('admin.temas.create')->with(compact('miga'));
    }

    public function store(Request $request, Theme $tema)
    {
        $messages=[
            'nombre.required'=>'El campo Nombre no puede quedar vacío',
            'nombre.unique'=>'El nombre de este tema ya existe'
        ];

        $rules=[
            'nombre' => ['required',Rule::unique('themes')->ignore($tema->id)]
        ];

        $this->validate($request, $rules, $messages);

        $destacado=$request->destacado;
        $suscripcion=$request->suscripcion;

        if($destacado && $suscripcion)
        {
            $notificacion2="Un tema de suscripción no puede estar en la página de inicio";
            return back()->with(compact('notificacion2'));
        }

        //Creamos un objeto y le asignamos atributos
        $tema=new Theme($request->all());
        /*$tema->nombre=$request->nombre;
        $tema->destacado=$request->destacado;
        $tema->suscripcion=$request->suscripcion;*/
        $tema->user_id=auth()->user()->id;
        $tema->slug=mb_strtolower((str_replace(" ","-",$request->nombre)),'UTF-8');
        $tema->save();
        $temaNombre = $tema->nombre;
        $notificacion="El tema $temaNombre se ha añadido correctamente";
        return back()->with(compact('notificacion'));
    }

    //Editamos
    public function edit(Theme $tema)
    {
        $miga='Editar Tema';
        return view('admin.temas.edit')->with(compact('tema','miga'));
    }

    //Actualizamos
    public function update(Request $request,Theme $tema)
    {
        $messages=[
            'nombre.required' => 'El campo Nombre no puede quedar vacío',
            'nombre.unique' => 'El nombre de este tema ya existe'
        ];

        $rules=[
            'nombre' => ['required',Rule::unique('themes')->ignore($tema->id)]
        ];

        $destacado=$request->destacado;
        $suscripcion=$request->suscripcion;

        //Si destacado vale 1 y suscripcion vale 1 , lanzamos mensaje
        if($destacado && $suscripcion)
        {
            $notificacion2="Un tema de suscripcion no puede estar en la pagina de inicio";
            return redirect('admin/temas')->with(compact('notificacion2'));
        }

        $this->validate($request, $rules, $messages);

        /*$tema->nombre=$request->nombre;
        $tema->destacado=$request->destacado;
        $tema->suscripcion=$request->suscripcion;*/
        /*$tema->save();*/
        $tema->update($request->all());
        $miga='Temas';
        $notificacion2='El tema se ha actualizado correctamente';
        return redirect('admin/temas')->with(compact('notificacion2','miga'));
    }

    //Eliminamos tema seleccionado en la cola de trabajo ( BorrarTema.php )
    public function destroy(Theme $tema)
    {
    	
    	BorrarTema::dispatch($tema);
        $tema->delete();
    	$notificacion="El tema se ha eliminado correctamente";
    	return back()->with(compact('notificacion'));
    }
}

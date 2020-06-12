<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Theme;
use App\User;

class SearchArticleController extends Controller
{
    
    public function index(Request $request)
    {
        $miga='Buscador Artículo';
        //recogemos informacion introducida
        $busqueda=$request->busqueda;
        //Podemos buscar por tema o usuario
        $tema=Theme::where('nombre','like',"$busqueda")->first();
        $usuario=User::where('name','like',"$busqueda")->first();

        if($usuario)
        {
            foreach($usuario->roles as $role)
            {
                //Si es administrador o moderador
                if($role->nombre=="administrador" || $role->nombre=="moderador")
                {
                    //Cogemos los articulos de ese usuario
                    $articulos=$usuario->articles()->withoutGlobalScope('activo')->with(['user','theme'])->orderBy('id','desc')->get();
                    return view('admin.articulos.buscador')->with(compact('miga','articulos'));
                }
            }
        }

        if($tema)
        {
            $articulos=$tema->articles()->withoutGlobalScope('activo')->with(['user','theme'])->orderBy('id','desc')->get();
            return view('admin.articulos.buscador')->with(compact('miga','articulos'));
        }

        $articulos=Article::withoutGlobalScope('activo')->with(['user','theme'])->where('titulo','like',"%$busqueda%")->orderBy('id','desc')->get();
        return view('admin.articulos.buscador')->with(compact('miga','articulos'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theme;

class ThemeController extends Controller
{
    public function show(Theme $tema)
    {
    	/*$temasTodos=Theme::all();*/
    	/*con paginate creamos el paginador y le damos un valor de 9 articulos por página*/
    	$articulos=$tema->articles()->where('activo', '=' ,1)->with(['images'])->orderBy('id','desc')->paginate(6);
    	/*$articulos=$tema->articles()->where('activo', '=' ,1)->orderBy('id','desc')->get();*/
    	return view('tema.articulos')->with(compact('tema','articulos'));
    }
}

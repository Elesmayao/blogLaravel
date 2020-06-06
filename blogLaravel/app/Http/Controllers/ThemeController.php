<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theme;

class ThemeController extends Controller
{
    public function show($theme_id)
    {
    	$temasTodos=Theme::all();
    	$tema=Theme::find($theme_id);
    	$articulos=$tema->articles()->where('activo', '=' ,1)->orderBy('id','desc')->get();
    	return view('tema.articulos')->with(compact('temasTodos','tema','articulos'));
    }
}

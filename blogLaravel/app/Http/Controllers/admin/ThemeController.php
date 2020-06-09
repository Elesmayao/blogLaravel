<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Theme;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    public function index()
    {
    	//Consigue todos los temas y los ordena descendente para que salgan los actuales primero
    	$temas=Theme::with(['user'])->orderBy('id','desc')->get();
    	return view('admin.temas.index')->with(compact('temas'));
    }


    //Eliminamos tema seleccionado
    public function destroy(Theme $tema)
    {
    	//$tema->delete();
    	$articulos=$tema->articles()->with(['images'])->get();
    	foreach ($articulos as $articulo){
    		foreach($articulo->images as $imagen)
    		{
    			//borramos las imágenes físicas
    			Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
    		}
    	}
    	//con esto valdría solo para borrar las tablas
    	$tema->delete();
    	$notificacion="El tema se ha eliminado correctamente";
    	return back()->with(compact('notificacion'));
    }
}

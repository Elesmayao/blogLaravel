<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class SearchController extends Controller
{
    public function index(Request $request)
    {
    	/*el objeto request va a coger el valor del campo busqueda*/
    	$busqueda=$request->busqueda;
    	/*hacemos la consulta, %$busqueda -> busca los que contengan esa palabra , que sea un articulo activo , orden descendente*/
    	$articulos=Article::where('titulo','like',"%$busqueda%")->where('activo', '=', 1)->with(['images'])->orderBy('id','desc')->get();
    	/*retorna a la vista buscador los articulos que hayamos buscado*/
    	return view('buscador')->with(compact('articulos'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class SearchController extends Controller
{
    public function index(Request $request)
    {
    	/*
    	/*el objeto request va a coger el valor del campo busqueda*/
    	/*$busqueda=$request->busqueda;
    	/*hacemos la consulta, %$busqueda -> busca los que contengan esa palabra , que sea un articulo activo , orden descendente*/
    	/*$articulos=Article::where('titulo','like',"%$busqueda%")->ArticulosActivos()->with(['images'])->orderBy('id','desc')->get();
    	/*retorna a la vista buscador los articulos que hayamos buscado*/
    	/*return view('buscador')->with(compact('articulos'));*/

    	/*Creo una coleccion -> articulosPermitidos que va a contener los articulos permitidos por los usuarios no autenticados*/
    	$articulosPermitidos=collect();
    	$busqueda=$request->busqueda;
    	/*si el usuario esta autenticado*/
    	if(auth()->check())
    	{
            /*Comprobamos que no esté bloqueado*/
            if(!auth()->user()->bloqueado)
            {
        		$articulos=Article::where('titulo','like',"%$busqueda%")->with(['images'])->orderBy('id','desc')->get();
                return view('buscador')->with(compact('articulos'));
            }
            $articulos=Article::where('titulo','like',"%$busqueda%")->with(['images'])->orderBy('id','desc')->get();

            foreach($articulos as $articulo)
            {
                /*Si no pertenece a un tema con suscripcion*/
                if(!$articulo->theme->suscripcion)
                    $articulosPermitidos->push($articulos);
            }
            return view('buscador')->with(compact('articulosPermitidos'));

    	}
        /*Si no está autenticado*/
        $articulos=Article::where('titulo','like',"%$busqueda%")->with(['images'])->orderBy('id','desc')->get();

    	foreach($articulos as $articulo)
    	{
    		/*Si no pertenece a un tema con suscripcion*/
    		if(!$articulo->theme->suscripcion)
    			$articulosPermitidos->push($articulos);
    	}
    	return view('buscador')->with(compact('articulosPermitidos'));
    }
}

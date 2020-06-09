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
    	/*$articulos=$tema->articles()->where('activo', '=' ,1)->orderBy('id','desc')->get();*/
    	/*$articulos=$tema->articles()->where('activo', '=' ,1)->with(['images'])->orderBy('id','desc')->paginate(6);
    	return view('tema.articulos')->with(compact('tema','articulos'));*/

    	/*con esto decimos que el usuario que vaya a ver el tema esta autenticado*/
    	$usuarioAutenticado=true;
        $usuarioBloqueado=false;

    	/*Si es un tema de suscripción*/
    	if($tema->suscripcion)
    	{
    		/*Si está autenticado*/
    		if(auth()->check())
    		{
                /*Si está bloqueado*/
                if(auth()->user()->bloqueado)
                {
                    /*decimos que si está bloqueado y nos retorna a la siguiente vista*/
                    $usuarioBloqueado=true;
                    return view('tema.articulos')->with(compact('tema','usuarioAutenticado','usuarioBloqueado'));
                }
    			/*mostramos los artículos, enviandole a la vista usuarioAutenticado con los artículos*/
    			$articulos=$tema->articles()->with(['images'])->orderby('id','desc')->paginate(6);
    			return view('tema.articulos')->with(compact('tema','articulos','usuarioAutenticado','usuarioBloqueado'));
    		}
    		/*Si no está autenticado, enviandole a la vista usuarioAutenticado sin artículos*/
    		$usuarioAutenticado=false;
    		return view('tema.articulos')->with(compact('tema','usuarioAutenticado','usuarioBloqueado'));
    	}

    	$articulos=$tema->articles()->with(['images'])->orderBy('id','desc')->paginate(6);
    	return view('tema.articulos')->with(compact('tema','articulos','usuarioAutenticado','usuarioBloqueado'));
    }
}

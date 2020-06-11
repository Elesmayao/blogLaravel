<?php

namespace App\Http\Middleware;

use Closure;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Si el usuario autenticado es administrador pasa
        if(auth()->user()->es_admin)
        {
            return $next($request);
        }
        //Si no lo es, lo redirigimos al index
        return redirect('/');
    }
}

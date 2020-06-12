<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Mail;
use App\Mail\CorreoMasivo;

class CorreoMasivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miga='Enviar Correos';
        return view('admin.correo-masivo')->with(compact('miga'));
    }

    public function correoMasivo(Request $request)
    {
        
        $messages=[
            'titulo.required'=>'El campo Asunto no puede estar vacío',
            'contenido.required'=>'El campo Contenido no puede estar vacío',
        ];

        $rules=[
            'titulo'=>'required',
            'contenido'=>'required',
        ];

        $this->validate($request, $rules, $messages);
        $asunto=$request->titulo;
        $contenido=$request->contenido;
        //Solo reciben el email los usuarios no bloqueados
        $usuarios=User::where('bloqueado',false)->get();
        foreach($usuarios as $usuario){
            //Enviamos el correo a los usuarios
            Mail::to($usuario)->queue(new CorreoMasivo($usuario, $asunto , $contenido));
        }

        $notificacion="Se ha enviado correctamente el correo a todos los usuarios autenticados";
        return back()->with(compact('notificacion'));
    }
}

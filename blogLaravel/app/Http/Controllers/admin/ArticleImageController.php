<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ArticleImage;
use Illuminate\Support\Facades\Storage;

class ArticleImageController extends Controller
{
    public function destroy(ArticleImage $imagen)
    {
    	//Eliminamos físicamente la imagen
    	Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
    	//Borramos el registro que se corresponde con esa imagen físicamente
    	$imagen->delete();
    	$notificacion="Imagen eliminada correctamente";
    	return back()->with(compact('notificacion'));
    }
}

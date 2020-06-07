<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;

class Article extends Model
{

    // $article->theme
    public function theme()
    {
    	return $this->belongsTo(Theme::class);
    }

    // $article->user

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    // $articulo->imagen
    public function images()
    {
        return $this->hasMany(ArticleImage::class);
    }

    public function imagenDestacada()
    {
        $imagenDestacada=$this->images->first();
        /*si no encuentra imagen para ese articulo retornamos "sin_imagen.jpg"*/
        if(!$imagenDestacada)
            return 'sin_imagen.jpg';
        return $imagenDestacada->nombre;
    }
}

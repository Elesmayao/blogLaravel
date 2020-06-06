<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    /*le pasamos a la ruta el valor slug*/
    public function getRouteKeyName()
    {
        return 'slug';
    }
    // $theme->user
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    // $theme->articles
    public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Theme extends Model
{
    protected $fillable=['nombre','destacado','suscripcion'];
    
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

    /*Accesor para el campo destacados ( Para que en vez de salir en este apartado numero salga Si o No )*/
    public function getEsDestacadoAttribute()
    {
        $esDestacado=$this->destacado;
        if($esDestacado)
            return 'Si';
        return 'No';
    }

    /*Accesor para el campo suscripcion ( Para que en vez de salir en este apartado numero salga Si o No )*/
    public function getEsSuscripcionAttribute()
    {
        $esSuscripcion=$this->suscripcion;
        if($esSuscripcion)
            return 'Si';
        return 'No';
    }
}

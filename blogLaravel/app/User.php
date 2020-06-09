<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'alias' , 'web' , 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // $user->themes
    public function themes()
    {
        return $this->hasOne(Theme::class);
    }

    // $user->articles
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /*Accesors*/
    /*public function getNameAttribute($valor)
    {
        /*Cambiamos la primera palabra del valor pasado a mayus
        return ucfirst(strtolower($valor));
    }
    */

    /*Mutators*/
    public function setNameAttribute($value)
    {
        $this->attributes['name']=ucfirst(strtolower($value));
    }

}

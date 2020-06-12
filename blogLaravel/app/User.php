<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

class User extends Authenticatable implements MustVerifyEmail
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

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
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
        $this->attributes['name']=ucfirst(mb_strtolower($value,'UTF-8'));
    }

    public function getUsuarioRolesAttribute()
    {
        $roles=$this->roles;
            foreach ($roles as $role)
            {
                echo $role->nombre."<br>";
            }
    }

    public function getUsuarioBloqueadoAttribute()
    {
        $bloqueado=$this->bloqueado;
        if(!$bloqueado)
            return "No bloqueado";
        return "Bloqueado";
    }

    public function hasRole($role)
    {
        //cogemos todos los roles
        $roles=$this->roles;
            foreach ($roles as $suRole)
            {
                //mira si su rol es igual al rol
                if($suRole->nombre==$role)
                    return true;
            }
            return false;
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
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

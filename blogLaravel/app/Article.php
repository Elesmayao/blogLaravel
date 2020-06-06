<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Article extends Model
{
    public function getCreatedAtAttribute($fecha)
    {
        return new Date($fecha);
    }
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
}

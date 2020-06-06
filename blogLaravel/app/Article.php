<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}

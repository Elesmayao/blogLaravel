<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\ArticleImage;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles=factory(Article::class,50)->create();
        /*Los articulos crean imagenes*/
        $articles->each(function($article){
        	/*1 articulo crea 3 imagenes*/
        	$images=factory(ArticleImage::class,3)->make();
        	/*Relación articulo con las imagenes*/
        	$article->images()->saveMany($images);
        });
    }
}

<?php

use Faker\Generator as Faker;

$factory->define(App\ArticleImage::class, function (Faker $faker) {
    return [
    	/*Metemos imagen en carpeta imagenesArticulos con el tamaño especificado (250,250),tipo de imagen-> cats, false porque solo queremos el nombre de la imagen y no la ruta*/
        'nombre'=>\Mmo\Faker\PicsumProvider::picsum(storage_path().'/app/public/imagenesArticulos',400,400,false),
		/*esas imagenes pertenecen a los articulos con id entre 1 y 50*/
		'article_id'=>$faker->numberBetween(1,50),
    ];
});

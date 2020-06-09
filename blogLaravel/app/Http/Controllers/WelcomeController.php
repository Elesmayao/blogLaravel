<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Theme;

class WelcomeController extends Controller
{
    public function welcome(){

    	/*$temasTodos = DB::select('select * from themes');*/
    	/*$temasTodos = DB::table('themes')->get();*/
    	/*$temasTodos = Theme::all();*/

    	/*Creamos una colección para meter los temas que sean destacados*/
    	$temasDestacados=Theme::where('destacado',1)->with(['articles.images'])->orderBy('id','desc')->get();
    	return view('welcome')->with(compact('temasDestacados'));
    }
}

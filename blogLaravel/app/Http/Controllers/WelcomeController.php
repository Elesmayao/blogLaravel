<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
/*use App\Theme;*/

class WelcomeController extends Controller
{
    public function welcome(){

    	/*$temasTodos = DB::select('select * from themes');*/
    	/*$temasTodos = DB::table('themes')->get();*/
    	/*$temasTodos = Theme::all();*/

    	return view('welcome');
    }
}

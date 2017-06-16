<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
	$times = array();

	for ($i=8; $i <24 ; $i++) { 
		array_push($times,$i.':00'.'-'.($i).':30');
		array_push($times,$i.':30'.'-'.($i+1).':00');
	}
	return view('index',compact('times'));
});

Route::post('/send', 'DataController@store');

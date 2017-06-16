<?php

namespace App\Http\Controllers;

use App\Time;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function store(){
    	$time = new Time;
    	$time->name = request('name');
    	$time->times = request('data');
    	$time->save();

    	return back();
    }
}

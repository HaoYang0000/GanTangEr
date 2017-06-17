<?php

namespace App\Http\Controllers;

use App\Event;
use App\Time;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index(){
    	$event = request('event');
    	$events = Event::where('name', 'LIKE', '%'.$event.'%')->get();
    

    	return response()->json($events, 200);
   }
}

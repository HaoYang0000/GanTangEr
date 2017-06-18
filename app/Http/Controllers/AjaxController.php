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

    	$users = array();
    	$results = array();
    	foreach ($events as $key ) {
    		$temp = Time::where('event_id','=',$key->id)->get();
    		$key->users = $temp;
    	}

    

    	return response()->json($events, 200);
   }
}

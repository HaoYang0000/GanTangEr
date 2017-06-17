<?php

namespace App\Http\Controllers;

use App\Event;
use App\Time;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function store(){
    	$event = new Event;
    	$event->name = request('event');
    	$event->secure_code = bcrypt(str_random(10));
    	$event->private = false;
    	$event->status = 'unsettled';
    	$event->save();

    	$time = new Time;
    	$time->event_id = $event->id;
    	$time->name = request('name');
    	$time->times = request('data');
    	$time->save();

    	return back();
    }
}

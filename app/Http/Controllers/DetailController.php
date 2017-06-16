<?php

namespace App\Http\Controllers;

use App\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function show(){
    	$datas = Detail::all()->toArray();
    	$len = 0;
    	$data=[];
    	foreach ($datas as $key) {
    		$temp['month'] = $key['month'];
    		$temp['shiji'] = $key['shiji'];
    		$temp['mubiao'] = $key['mubiao'];
    		array_push($data,(object) $temp);
    		$len++;
    	}
    	//dd($data);
    	return view('test',compact('data','len'));
    }
}

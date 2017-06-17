<?php

namespace App;

use App\Time;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function times(){
        return $this->hasMany(Time::class);
    }
}

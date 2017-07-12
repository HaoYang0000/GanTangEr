<?php

namespace App;

use App\Participant;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function times(){
        return $this->hasMany(Participant::class);
    }
}

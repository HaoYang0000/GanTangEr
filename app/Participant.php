<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'name', 'times',
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}

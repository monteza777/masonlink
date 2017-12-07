<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rsvp extends Model
{
    public function user(){
    return $this->belongsTo('App/User');
    }
    
	public function eventModel(){
    return $this->belongsTo('App/EventModel');
    }

}

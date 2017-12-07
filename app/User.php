<?php

namespace App;

// use Illuminate\Notifications\Notifiable;	

use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function roles(){
        return $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }

    public function hasAnyRole($roles)
    {
    	if(is_array($roles)){
    		foreach($roles as $role){
    			if($this->hasRole($role)){
    				return true;
    			}
    		}
    	} else{
    		if($this->hasRole($roles)){
    			return true;
    		}
    	}
    	return false;
    }
    public function hasRole($role){
    	if($this->roles()->where('name', $role)->first()){
    		return true;
    	}
    	return false;
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function rsvps(){
        return $this->hasMany('App\rsvp');
    }

    public function eventModel(){
        return $this->hasMany('App\EventModel');
    }

    public function comments(){
        return $this->hasManyThrough('App\Comment','App\Post');
    }

}

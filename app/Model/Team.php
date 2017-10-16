<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function users(){
    	return $this->belongsToMany('App\Model\User')->wherePivot('active', 1)->withTimestamps();
    }

    public function req_users(){
    	return $this->belongsToMany('App\Model\User')->wherePivot('request', 1)->withTimestamps();
    }

    public function team_managers(){
    	return $this->hasMany('App\Model\TeamManager');
    }

    public function race_registrations(){
    	return $this->hasMany('App\Model\RaceRegistration');
    }
}

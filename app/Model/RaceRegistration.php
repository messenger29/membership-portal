<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RaceRegistration extends Model
{
    public function race_event(){
    	return $this->belongsTo('App\Model\RaceEvent');
    }

    public function race_registration_crews(){
    	return $this->hasMany('App\Model\RaceRegistrationCrew');
    }

    public function team(){
    	return $this->belongsTo('App\Model\Team');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RaceEvent extends Model
{
    public function race_registrations(){
    	return $this->hasMany('App\Model\RaceRegistration');
    }
}

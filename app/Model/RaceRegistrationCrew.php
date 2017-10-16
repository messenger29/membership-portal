<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RaceRegistrationCrew extends Model
{
		public function race_registration(){
    	return $this->belongsTo('App\Model\RaceRegistration');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RaceRegistrationCrewManifest extends Model
{
    public function race_registration_crew(){
    	return $this->belongsTo('App\Model\RaceRegistrationCrew');
    }

    public function user(){
    	return $this->belongsTo('App\Model\User');
    }
}

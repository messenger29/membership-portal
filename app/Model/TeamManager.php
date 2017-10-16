<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeamManager extends Model
{
    public function teams(){
    	return $this->belongsTo('App\Model\Team');
    }

    public function user(){
    	return $this->belongsTo('App\Model\User');
    }
}

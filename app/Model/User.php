<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne('App\Model\Profile');
    }

    public function waivers(){
        return $this->hasMany('App\Model\Waiver');
    }

    public function memberships(){
        return $this->hasMany('App\Model\Membership');
    }

    public function teams(){
        return $this->belongsToMany('App\Model\Team')->wherePivot('active', 1)->withTimestamps();
    }

    public function req_teams(){
        return $this->belongsToMany('App\Model\Team')->wherePivot('request', 1)->withTimestamps();
    }

    public function team_managers(){
        return $this->hasMany('App\Model\TeamManager');
    }
}

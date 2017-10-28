<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Team;
use App\Model\RaceEvent;
use App\Model\RaceRegistration;

class ManageTeamsController extends Controller
{
	protected $currentYear;

  public function __construct(){
    $this->middleware('auth');
    $this->currentYear = date('Y');
  }

  public function index(){
  	$user = Auth::user();

  	$teams_manage = $user->team_managers()->where('team_managers.active', '1')->leftJoin('teams', 'team_managers.team_id', 'teams.id')->where('teams.active', 1)->orderby('teams.name')->get();

  	return view('manage_teams.index')->with('teams_manage', $teams_manage);
  }

  /*
   * Team Dashboard
   */
  public function show($team_id){
  	$user = Auth::user();

  	if(!$user->team_managers->where('team_id', $team_id)->where('active', 1)->first()){
  		return redirect('/dashboard')->with('error', 'Access Denied. Please request access from the webmaster.');
  	}

  	// get team info
  	$team = Team::find($team_id);

  	// get any active upcoming race events
  	$race_events = RaceEvent::where('event_start_date','>',date('Y-m-d'))->where('active', 1)->orderBy('event_start_date')->get();

    foreach($race_events as $race_event){
      $race_reg = RaceRegistration::where('race_event_id', $race_event->id)->where('team_id', $team_id)->first();

      $race_event['registered'] = $race_reg ? $race_reg->id : 0;
    }

  	// get all users associated with the team
  	$members = $team->users()->orderBy('name')->get();

  	// get all users requesting to join team
  	$team_req = $team->req_users()->orderBy('name')->get();

  	// get list of all managers and point of contacts for team
  	$managers = $team->team_managers()->where('active', '1')->leftJoin('users', 'team_managers.user_id', 'users.id')->get();

  	return view('manage_teams.show', [
  		'team' => $team,
  		'members' => $members,
  		'team_req' => $team_req,
  		'managers' => $managers,
  		'race_events' => $race_events,
  	]);
  }

  public function roster($team_id){
  	$team = Team::find($team_id);
  	$users = $team->users()->orderBy('name')->get();

  	$members = array();
  	foreach($users as $user){
  		$currentYear = $this->currentYear;

	    $profile = $user->profile;
	    $profile_flag = $profile ? $profile->updated_at > $currentYear.'-01-01 00:00:00' ? 1 : -1 : 0;

	    $waiver_flag = $user->waivers()->where('user_id', $user->id)->where('year', $currentYear)->orderBy('year', 'desc')->count();

	    $membership_flag = $user->memberships()->where('year', $currentYear)->where('active', 1)->count();

  		$members[] = [
  			'profile' => $profile,
  			'profile_flag' => $profile_flag,
  			'waiver_flag' => $waiver_flag,
  			'membership_flag' => $membership_flag,
  		];

  		
  	}

  	return view('manage_teams.roster', [
  		'team' => $team,
  		'members' => $members,
  	]);
  }

  /*
   * Interface to edit team information
   */
  public function edit_team($team_id){
  	
  }

  /*
   * Update the team information
   */
  public function update_team(Request $request){
  	
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Model\Waiver;
use App\Model\Profile;

class DashboardController extends Controller
{

  protected $currentYear;

	public function __construct(){
    $this->currentYear = date('Y');
		$this->middleware('auth');
	}

  public function index(){
    $user = auth()->user();

    // get profile of user
    $profile = Profile::where('user_id', $user->id)->first();
    // check if profile exists; if so, check if outdate (not current year)
    $profile_flag = $profile ? $profile->updated_at > $this->currentYear.'-01-01 00:00:00' ? 1 : -1 : 0;

    // check if user has a completed waiver for current year
    // $waiver = Waiver::where('user_id', $user->id)->where('year', $currentYear)->orderBy('year', 'desc')->first();
    $waiver_flag = Waiver::where('user_id', $user->id)->where('year', $this->currentYear)->orderBy('year', 'desc')->count();

    // check if user has an active membership for current year
    $membership_flag = $user->memberships()->where('year', $this->currentYear)->where('active', 1)->count();

    // get team that user is currently active in
    $active_team = $user->teams->first();
    // if user is not active in a team, check for any team requests
    $request_team = !$active_team ? $user->req_teams->first() : null;

    // check if user is a team manager
    $teams_manage = $user->team_managers()->where('team_managers.active', '1')->leftJoin('teams', 'team_managers.team_id', 'teams.id')->where('teams.active', 1)->orderby('teams.name')->get();

  	return view('dashboard', [
      'name' => $user->name,
      'currentYear' => $this->currentYear,
      'profile_flag' => $profile_flag,
      'waiver_flag' => $waiver_flag,
      'membership_flag' => $membership_flag,
      'active_team' => $active_team,
      'request_team' => $request_team,
      'teams_manage' => $teams_manage,
    ]);
  }
}

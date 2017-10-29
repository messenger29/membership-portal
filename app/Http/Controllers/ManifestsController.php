<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\RaceEvent;
use App\Model\RaceRegistration;
use App\Model\RaceRegistrationCrew;
use App\Model\RaceRegistrationCrewManifest;
use App\Model\Team;

class ManifestsController extends Controller
{
		protected $user;
    protected $currentYear;

    public function __construct(){
  		$this->middleware('auth');
  		$this->user = Auth::user();
      $this->currentYear = date('Y');
    }

    public function create($crew_id){

  		//check if crew exists first. 
      $race_crew = RaceRegistrationCrew::find($crew_id);
      if(!$race_crew){
          return redirect('/dashboard')->with('status', 'Race crew do not exist.');
      }

      //get and check registration as added layer
      $race_reg = $race_crew->race_registration()->first();
      if(!$race_reg){
          return redirect('/dashboard')->with('status', 'Please register for race first.');
      }

      //get team 
      $team = $race_reg->team()->first();
      if(!$this->check_team_manager($team->id)){
          return redirect('dashboard')->with('error', 'Access Denied.');
      }
      
      //get race event details
      $race_event = $race_reg->race_event()->first();
      
      //get entire roster of team that has active membership
      $team_roster = $team->users()->rightJoin('memberships','users.id', 'memberships.user_id')->where('memberships.active', 1)->where('year', $this->currentYear)->orderBy('name')->get();
      //get roster of paddlers that are selected on other crews
      $race_roster = $this->get_race_roster($race_reg->id);

      $team_roster = $this->note_roster_status($team_roster, $race_roster);
      // foreach($roster as $member){
      //     if(in_array($member->id, $race_roster)){
      //         $member['rostered'] = -1;
      //     }
      //     else{
      //         $member['rostered'] = 0;
      //     }
      // }

      return view('manifests.create', [
          'race_crew' => $race_crew,
          'race_reg' => $race_reg,
          'race_event' => $race_event,
          'team' => $team,
          'roster' => $team_roster,
      ]);
    }

    public function store(Request $request, $crew_id){
      $race_crew = RaceRegistrationCrew::find($crew_id);

      $new_version = $race_crew->version + 1;

      foreach($request->members as $member_id){
          $manifest = new RaceRegistrationCrewManifest();
          $manifest->race_registration_crew_id = $crew_id;
          $manifest->user_id = $member_id;
          $manifest->version = $new_version;
          $manifest->save();
      }

      $race_crew->version = $new_version;
      $race_crew->save();

      return redirect('/race_registration/'.$race_crew->race_registration_id)->with('success', 'Manifest saved.');
    }

    public function edit($crew_id){
      //check if crew exists first. 
      $race_crew = RaceRegistrationCrew::find($crew_id);
      if(!$race_crew){
          return redirect('/dashboard')->with('status', 'Race crew do not exist.');
      }

      //get and check registration as added layer
      $race_reg = $race_crew->race_registration()->first();
      if(!$race_reg){
          return redirect('/dashboard')->with('status', 'Please register for race first.');
      }

      //get team 
      $team = $race_reg->team()->first();
      if(!$this->check_team_manager($team->id)){
          return redirect('dashboard')->with('error', 'Access Denied.');
      }
      
      //get race event details
      $race_event = $race_reg->race_event()->first();
      
      //get entire roster of team that has active membership
      $team_roster = $team->users()->rightJoin('memberships','users.id', 'memberships.user_id')->where('memberships.active', 1)->where('year', $this->currentYear)->orderBy('name')->get();
      //get roster of paddlers that are selected on ALL crews
      $race_roster = $this->get_race_roster($race_reg->id);
      //get roster of paddlers that are selected on CURRENT crew
      $current_roster = $this->get_race_roster($race_reg->id, $race_crew->id);

      $team_roster = $this->note_roster_status($team_roster, $race_roster, $current_roster);

      // dd($team_roster);

      return view('manifests.edit', [
          'race_crew' => $race_crew,
          'race_reg' => $race_reg,
          'race_event' => $race_event,
          'team' => $team,
          'roster' => $team_roster,
      ]);
    }


    /*
     * helper functions
     */ 

    private function check_team_manager($team_id){
    	$user = Auth::user();
    	return $user->team_managers->where('team_id', $team_id)->where('active', 1)->count();
    }

    private function get_race_roster($race_reg_id, $race_crew_id = NULL){
      $race_roster = array();

      if($race_crew_id){
      	$race_crews = RaceRegistrationCrew::where('id', $race_crew_id)->get();
      }
      else{
      	$race_crews = RaceRegistrationCrew::where('race_registration_id',$race_reg_id)->get();
      }

      foreach($race_crews as $crew){
          $manifest = RaceRegistrationCrewManifest::where('race_registration_crew_id', $crew->id)->where('version', $crew->version)->get();
          foreach($manifest as $member){
              $race_roster[] = $member->user_id;
          }
      }

      return $race_roster;

    }

    private function note_roster_status($team_roster, $race_roster, $manifest_roster = NULL){
    	foreach($team_roster as $member){
          
          if(in_array($member->id, $race_roster)){

          	//member is rostered on another crew
          	$member['rostered'] = -1;

          	// if manifest roster exists, check if member is rostered on current crew
          	if($manifest_roster && in_array($member->id, $manifest_roster)){
	          	//member is rostered on current crew
	          	$member['rostered'] =  1;	
	          }

          }
          else{
          	//member is free to be rostered
            $member['rostered'] = 0;
          }
      }

    	return $team_roster;
    }
}

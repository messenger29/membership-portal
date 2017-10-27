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
        $race_crew = RaceRegistrationCrew::find($crew_id);
        if(!$race_crew){
            return redirect('/dashboard')->with('status', 'Please register for race first.');
        }

        $race_reg = $race_crew->race_registration()->first();
        if(!$race_reg){
            return redirect('/dashboard')->with('status', 'Please register for race first.');
        }
        
        $race_event = $race_reg->race_event()->first();
        $team = $race_reg->team()->first();
        $roster = $team->users()->rightJoin('memberships','users.id', 'memberships.user_id')->where('memberships.active', 1)->where('year', $this->currentYear)->orderBy('name')->get();

        $active_roster = $this->get_active_roster($race_reg->id);

        foreach($roster as $member){
            if(in_array($member->id, $active_roster)){
                $member['rostered'] = 1;
            }
            else{
                $member['rostered'] = 0;
            }
        }

        if(!$this->check_team_manager($team->id)){
            return redirect('dashboard')->with('error', 'Access Denied.');
        }

        return view('manifests.create', [
            'race_crew' => $race_crew,
            'race_reg' => $race_reg,
            'race_event' => $race_event,
            'team' => $team,
            'roster' => $roster,
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
        
    }

    private function get_active_roster($race_reg_id){
        $active_roster = array();

        $race_crews = RaceRegistrationCrew::where('race_registration_id',$race_reg_id)->get();

        foreach($race_crews as $crew){
            $manifest = RaceRegistrationCrewManifest::where('race_registration_crew_id', $crew->id)->where('version', $crew->version)->get();
            foreach($manifest as $member){
                $active_roster[] = $member->user_id;
            }
        }

        return $active_roster;

    }
}

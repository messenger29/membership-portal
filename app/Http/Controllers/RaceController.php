<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\RaceEvent;
use App\Model\RaceRegistration;
use App\Model\RaceRegistrationCrew;
use App\Model\RaceRegistrationCrewManifest;
use App\Model\Team;

class RaceController extends Controller
{
	protected $user;
    protected $currentYear;

    public function __construct(){
    	$this->middleware('auth');
    	$this->user = Auth::user();
        $this->currentYear = date('Y');
    }

    public function show($id){

    }

    public function register_create($id, $team_id){

    	if(!$this->check_team_manager($team_id)){
    		return redirect('dashboard')->with('error', 'Access Denied.');
    	}

    	$race_reg_exists = RaceRegistration::where('race_event_id', $id)->where('team_id', $team_id)->first();
    	if($race_reg_exists){
    		return redirect('race_registration/'.$race_reg_exists->id);
    	}

    	$race_event = RaceEvent::find($id);
    	if($race_event->active == 0){
    		return redirect('home');
    	}
    	$team = Team::find($team_id);
    	
    	return view('races.register_create', [
    		'race_event' => $race_event,
    		'team' => $team,
    	]);
    }

    public function register_store(Request $request, $id){
        $team_id = $request->input('team_id');

    	if(!$this->check_team_manager($team_id)){
            return redirect('dashboard')->with('error', 'Access Denied.');
        }

        $race_reg_exists = RaceRegistration::where('race_event_id', $id)->where('team_id', $team_id)->first();
        if($race_reg_exists){
            return redirect('race_registration/'.$race_reg_exists->id);
        }

        // storing race registration
        $race_reg = new RaceRegistration;
        $race_reg->race_event_id = $request->input('race_event_id');
        $race_reg->team_id = $team_id;
        $race_reg->submitted = 1;
        $race_reg->save();

        for($i = 0; $i < sizeof($request->input('name')); $i++){
            $race_reg_crew = new RaceRegistrationCrew;
            $race_reg_crew->race_registration_id = $race_reg->id;
            $race_reg_crew->name = $request->input('name')[$i];
            $race_reg_crew->crew_type = $request->input('crew_type')[$i];
            $race_reg_crew->partners = $request->input('partners')[$i];
            $race_reg_crew->crew_rank = $request->input('crew_rank')[$i];
            $race_reg_crew->notes = $request->input('notes')[$i];
            $race_reg_crew->save();
        }

        return redirect('/race_registration/'.$race_reg->id);
    }

    public function register_show($id){
        $race_reg = RaceRegistration::find($id);
        if(!$race_reg){
            return redirect('/dashboard')->with('error', 'Registration does not exist.');
        }

        $race_event = $race_reg->race_event()->first();

        $race_crews = $race_reg->race_registration_crews()->get();

        return view('races.register_show', [
            'race_reg' => $race_reg,
            'race_crews' => $race_crews,
            'race_event' => $race_event,
        ]);
    }

    public function register_edit($id){
    	
    }

    public function register_update($id){
    	
    }

    public function register_destroy($id){
    	
    }

    public function manifest_create($crew_id){
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

        return view('races.manifest_create', [
            'race_crew' => $race_crew,
            'race_reg' => $race_reg,
            'race_event' => $race_event,
            'team' => $team,
            'roster' => $roster,
        ]);
    }

    public function manifest_store(Request $request, $crew_id){
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

    public function manifest_edit($crew_id){
        
    }

    private function check_team_manager($team_id){
    	$user = Auth::user();
    	return $user->team_managers->where('team_id', $team_id)->where('active', 1)->count();
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

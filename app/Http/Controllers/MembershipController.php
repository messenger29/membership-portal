<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Membership_type;
use App\Model\Membership;
use App\Model\User;

class MembershipController extends Controller
{
    protected $currentYear;

    public function __construct(){
        $this->currentYear = date('Y');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentYear = $this->currentYear;
        $user = Auth::user();

        //get all membership types from current year
        $membership_types = Membership_type::where('year', $currentYear)->orderBy('name')->get();
        $membership_types_list = array();
        //populate list of membership types for selection in form
        if($membership_types->count()){
            foreach($membership_types as $membership_type)
            $membership_types_list[$membership_type->id] = $membership_type->name;
        }

        //get all user's memberships
        $memberships = $user->memberships()->orderBy('year', 'desc')->get();
        //set current year's membership initial state
        $currentMembership = null;
        //grab membership info from current year if exists
        if($memberships->count() && $memberships[0]->year == $currentYear){
            $currentMembership = $memberships->shift();
        }


        //get user's profile from current year
        $profile = $this->getCurrentYearProfile($user);
        //check if current year's exist
        $profile_status = $profile ? 1 : 0;

        //get user's profile from current year
        $waiver = $this->getCurrentYearWaiver($user);
        //check if current year's exist
        $waiver_status = $waiver ? 1 : 0;


        return view('memberships.index', [
            'currentYear' => $currentYear,
            'membership_types_list' => $membership_types_list,
            'memberships' => $memberships,
            'currentMembership' => $currentMembership,
            'profile' => $profile,
            'profile_status' => $profile_status,
            'waiver' => $waiver,
            'waiver_status' => $waiver_status,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get authenticated user info
        $user = Auth::user();

        //get user's profile from current year
        $profile = $this->getCurrentYearProfile($user);
        //check if current year's exist
        $profile_status = $profile ? 1 : 0;

        //get user's profile from current year
        $waiver = $this->getCurrentYearWaiver($user);
        //check if current year's exist
        $waiver_status = $waiver ? 1 : 0;

        //if either does not exist, send back to membership page
        if(!$profile_status || !$waiver_status){
            return redirect('/membership');
        }

        //initialize new Membership model and set values
        $membership = new Membership;
        $membership->user_id = $user->id;
        $membership->profile_id = $profile->id;
        $membership->waiver_id = $waiver->id;
        $membership->membership_type_id = $request->input('membership_type');
        $membership->year = $this->currentYear;
        $membership->active = 1;
        $membership->save();

        return redirect('/membership')->with('success', 'Membership status updated.');
    }

    private function getCurrentYearProfile($user){
        return $user->profile()->where('updated_at', '>', ($this->currentYear-1).'-12-31 23:59:59')->first();
    }

    private function getCurrentYearWaiver($user){
        return $user->waivers()->where('year', $this->currentYear)->first();
    }



}

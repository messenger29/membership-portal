<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Waiver;
use App\Model\Waivertext;
use App\Model\Profile;
use App\Model\User;

class WaiversController extends Controller
{
    protected $currentYear = 0;

    public function __construct(){
        $this->middleware('auth');
        $this->currentYear = date('Y');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentYear = $this->currentYear;

        // $user_id = Auth::id();

        // retrieve profile to see if exists
        $profile = Auth::user()->profile;
        // if profile does not exist, ask user to fill out profile
        if(!$profile){
            return view('waivers.profile');
        }

        $waivers = Auth::user()->waivers()->orderBy('year','desc')->get();

        $fillCurrentWaiver_flag = false;
        if($waivers->isEmpty()){
            $fillCurrentWaiver_flag = true;
        }
        elseif($waivers[0]->year != $currentYear){
            $fillCurrentWaiver_flag = true;
        }

        return view('waivers.index',[
            'waivers' => $waivers,
            'fillCurrWaiver_flag' => $fillCurrentWaiver_flag,
            'currentYear' => $currentYear,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentYear = $this->currentYear;

        $user_id = Auth::id();

        // retrieve profile to see if exists
        $profile = Auth::user()->profile;
        // if profile does not exist, ask user to fill out profile
        if(!$profile){
            return view('waivers.profile');
        }
        //get latest date by which someone turns 18
        $youthMaxDate = date('Y-m-d', strtotime(date('Y-m-d').' -18 year'));
        //set flag if user is younger than 18
        $youth_flag = $profile->birthdate > $youthMaxDate ? 1 : 0;

        //check if waiver exists and user has permissions to view by checking user_id
        $waiver = Auth::user()->waivers()->where('year', $currentYear)->first();

        //if waiver exists for current year, redirect back to waivers page
        if($waiver){
            return redirect('waivers');
        }

        //get latest active waivertext for current year
        $waiverText = Waivertext::where('year', $currentYear)->where('active_flag',1)->orderBy('active_date', 'desc')->first();

        return view('waivers.create',[
            'waivertext' => $waiverText,
            'youth_flag' => $youth_flag,
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
        $user_id = Auth::id();

        $waiver = new Waiver;
        $waiver->user_id = $user_id;
        $waiver->waivertext_id = $request->input('waivertext_id');
        $waiver->year = $request->input('year');
        $waiver->youth_flag = $request->input('youth_flag');
        if($request->input('youth_flag')):
            $waiver->youth_agree_flag = $request->input('youth_agree_flag');
        endif;
        $waiver->medical_notes = $request->input('medical_notes');
        $waiver->agree_flag = $request->input('agree_flag');
        $waiver->signature = $request->input('signature');
        $waiver->save();

        return redirect('dashboard')->with('success','Waiver created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = Auth::id();

        //check if profile exists before proceeding
        $profileDoesNotExist_flag = $this->checkProfileDoesNotExist($user_id);
        //if profile_flag returns anything other than 0, ask user to fill out profile
        if($profileDoesNotExist_flag == 1){
            return view('waivers.profile');
        }

        //check if waiver exists and user has permissions to view by checking user_id
        $waiver = Waiver::where('id', $id)->where('user_id',$user_id)->first();

        if(!$waiver){
            return redirect('waivers');
        }

        $waiverText = Waivertext::find($waiver->waivertext_id);

        return view('waivers.show',[
            'waiver' => $waiver,
            'waivertext' => $waiverText
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('waivers');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('waivers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return redirect('waivers');
    }

    private function checkProfileDoesNotExist($user_id = 0){
        if(!$user_id){
            return -1;
        }

        //check if profile exists before proceeding
        $profile = Profile::where('user_id', $user_id)->first();

        //if profile do not exists, ask user to fill out profile first
        if(is_null($profile)){
            return 1;
        }

        return 0;
    }
}

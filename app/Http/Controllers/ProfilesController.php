<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Profile;
use App\Model\User;

class ProfilesController extends Controller
{
    protected $currentYear;

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
        $user = Auth::user();
        $data = [
            'profile' => $user->profile, 
            'confirm_current_year_flag' => 0,
            'currentYear' => $this->currentYear,
        ];
        if($user->profile){

            //check if profile was confirmed for current year
            if($user->profile->updated_at < $this->currentYear.'-01-01 00:00:00'){
                $data['confirm_current_year_flag'] = 1;
            }

            return view('profiles.index', $data);
        }
        else{
            return view('profiles.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->profile){
            return redirect('profiles');
        }

        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // // validation rules
        // $rules = [
        //     'first_name' => 'required|string|max:150',
        //     'middle_initial' => 'nullable|string|max:10',
        //     'last_name' => 'required|string|max:150',
        //     'street' => 'required|string|max:150',
        //     'street2' => 'nullable|string|max:100',
        //     'city' => 'required|string|max:150',
        //     'state' => 'required|string|max:150',
        //     'zip' => 'required|string|max:20',
        //     'phone_primary' => 'required|string|max:20',
        //     'phone_alt' => 'nullable|string|max:20',
        //     'birthdate' => 'required|date',
        //     'gender' => 'required|alpha_dash|max:10',
        //     'emerg_name' => 'required|string|max:150',
        //     'emerg_relation' => 'required',
        //     'emerg_phone_primary' => 'required|string|max:20',
        //     'emerg_phone_alt' => 'nullable|string|max:20', 
        //     'emerg2_name' => 'nullable|required_with:emerg2_relation,emerg2_phone_primary|string|max:150',
        //     'emerg2_relation' => 'nullable|required_with:emerg2_name,emerg2_phone_primary|string|max:150', 
        //     'emerg2_phone_primary' => 'nullable|required_with:emerg2_name,emerg2_relation|string|max:20',
        //     'emerg2_phone_alt' => 'nullable|string|max:20',  
        // ];

        // // custom messages when validation fails
        // $messages = [    
        //     'first_name.required' => 'First Name field is required',
        //     'last_name.required' => 'Last Name field is required',
        //     'street.required' => 'Address field is required',
        //     'city.required' => 'City field is required',
        //     'state.required' => 'State field is required',
        //     'zip.required' => 'Zip Code field is required',
        //     'phone_primary.required' => 'Primary Phone field is required',
        //     'birthdate.required' => 'Birthdate field is required',
        //     'gender.required' => 'Gender field is required',
        //     'emerg_name.required' => 'Emergency Contact #1 Name field is required',
        //     'emerg_relation.required' => 'Emergency Contact #1 Relationship field is required',
        //     'emerg_phone_primary.required' => 'Emergency Contact #1 Primary Phone field is required',
        //     'emerg2_name.required_with' => 'Please fill out the Emergency Contact #2 Name field',
        //     'emerg2_relation.required_with' => 'Please fill out the Emergency Contact #2 Relationship field',
        //     'emerg2_phone_primary.required_with' => 'Please fill out the Emergency Contact #2 Primary Phone field',
        // ];

        // //rename attributes label for error messages from validation
        // $customAttributes = [
        //     'first_name' => 'First Name',
        //     'middle_initial' => 'M.I.',
        //     'last_name' => 'Last Named',
        //     'street' => 'Address',
        //     'street2' => 'Address 2',
        //     'city' => 'City',
        //     'state' => 'State',
        //     'zip' => 'Zip Code',
        //     'phone_primary' => 'Primary Phone',
        //     'phone_alt' => 'Alternate Phone',
        //     'birthdate' => 'Birthdate',
        //     'gender' => 'Gender',
        //     'emerg_name' => 'Emergency Contact #1 Name',
        //     'emerg_relation' => 'Emergency Contact #1 Relationship',
        //     'emerg_phone_primary' => 'Emergency Contact #1 Primary Phone',
        //     'emerg_phone_alt' => 'Emergency Contact #1 Alternate Phone',
        //     'emerg2_name' => 'Emergency Contact #2 Name',
        //     'emerg2_relation' => 'Emergency Contact #2 Relationship',
        //     'emerg2_phone_primary' => 'Emergency Contact #2 Primary Phone',
        //     'emerg2_phone_alt' => 'Emergency Contact #2 Alternate Phone',
        // ];

        // // validation check
        // Validator::make($request->all(), $rules, $messages, $customAttributes)->validate();


        $user_id = Auth::id();

        $profile = new Profile;
        $profile->user_id = $user_id;
        $profile->first_name = $request->input('first_name');
        $profile->middle_initial = $request->input('middle_initial');
        $profile->last_name = $request->input('last_name');
        $profile->street = $request->input('street');
        $profile->street2 = $request->input('street2');
        $profile->city = $request->input('city');
        $profile->state = $request->input('state');
        $profile->zip = $request->input('zip');
        $profile->phone_primary = $request->input('phone_primary');
        $profile->phone_alt = $request->input('phone_alt');
        $profile->birthdate = $request->input('birthdate');
        $profile->gender = $request->input('gender');
        $profile->emerg_name = $request->input('emerg_name');
        $profile->emerg_relation = $request->input('emerg_relation');
        $profile->emerg_phone_primary = $request->input('emerg_phone_primary');
        $profile->emerg_phone_alt = $request->input('emerg_phone_alt');
        $profile->emerg2_name = $request->input('emerg2_name');
        $profile->emerg2_relation = $request->input('emerg2_relation');
        $profile->emerg2_phone_primary = $request->input('emerg2_phone_primary');
        $profile->emerg2_phone_alt = $request->input('emerg2_phone_alt');
        $profile->save();

        return redirect('profiles')->with('success','Profile created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('profiles');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::id();

        $profile = Profile::where('id', $id)->where('user_id', $user_id)->first();

        if(!$profile){
            return redirect('profiles');
        }

        return view('profiles.edit', [
            'profile_edit_flag' => 1,
            'profile' => $profile,
        ]);
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
        $user_id = Auth::id();

        $profile = Profile::find($id);

        if($profile->user_id != $user_id){
            return redirect('/');
        }

        $profile->user_id = $user_id;
        $profile->first_name = $request->input('first_name');
        $profile->middle_initial = $request->input('middle_initial');
        $profile->last_name = $request->input('last_name');
        $profile->street = $request->input('street');
        $profile->street2 = $request->input('street2');
        $profile->city = $request->input('city');
        $profile->state = $request->input('state');
        $profile->zip = $request->input('zip');
        $profile->phone_primary = $request->input('phone_primary');
        $profile->phone_alt = $request->input('phone_alt');
        // $profile->birthdate = $request->input('birthdate');
        $profile->gender = $request->input('gender');
        $profile->emerg_name = $request->input('emerg_name');
        $profile->emerg_relation = $request->input('emerg_relation');
        $profile->emerg_phone_primary = $request->input('emerg_phone_primary');
        $profile->emerg_phone_alt = $request->input('emerg_phone_alt');
        $profile->emerg2_name = $request->input('emerg2_name');
        $profile->emerg2_relation = $request->input('emerg2_relation');
        $profile->emerg2_phone_primary = $request->input('emerg2_phone_primary');
        $profile->emerg2_phone_alt = $request->input('emerg2_phone_alt');
        // $profile->updated_at = date("Y-m-d H:i:s");
        $profile->save();

        return redirect('profiles')->with('success','Profile updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * To confirm profile for the current year 
     */

    public function confirm($id){
        

        $user = Auth::user();
        $profile = $user->profile;

        if(!$profile || $profile->id != $id){
            return redirect('profiles')->with('status', 'Action not allowed.');
        }

        $profile->updated_at = date("Y-m-d H:i:s");
        $profile->save();
        return redirect('profiles')->with('success','Profile confirmed for '.$this->currentYear.'.');
    }

    public function all(){
        $profiles = Profile::all();
        return view('profiles.index')->with('profiles',$profiles);
    }
}

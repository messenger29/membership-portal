<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Team;

class TeamsController extends Controller
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
        
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);

        if(!$team){
            return redirect('/');
        }

        $team_managers = $team->team_managers()->leftJoin('users','team_managers.user_id','users.id')->get();

        return view('teams.show', [
            'team' => $team,
            'team_managers' => $team_managers,
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
        //
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
        //
    }
}

<?php

namespace App\Http\Controllers\Personnel\Team;

use App\Personnel\Info\Contract;
use App\Personnel\Info\EmpBasic;
use App\Personnel\Team\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp = EmpBasic::all();
        //$user_team_id = $emp->first()->myTeam();
        $contract = Contract::all();

        $user_team = $contract->where('emp_basic_id', Auth::user()->basicInfo->pluck('id')->first())->first();  
/*
        foreach ($contract as $employee) {
            dd($contract->jobDescription->team->display_name);
        }*/

/*
        $user_team_id = Contract::

        dd($user_team_id->id);*/

        return view('personnel.team.index', compact('emp','contract', 'user_team'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personnel\Team\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personnel\Team\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personnel\Team\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personnel\Team\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}

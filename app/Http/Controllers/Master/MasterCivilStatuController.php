<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterCivilStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterCivilStatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterCivilStatus::paginate(7);

        return view('admin.master.civil.index', compact('master'));
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
    public function store(MasterCivilStatus $MasterCivilStatus, Request $request)
    {
        $validator = $request->validate([
            'key' => 'unique:master_civil_statuses,key|string|max:255|required',
            'civil_status' => 'unique:master_civil_statuses,civil_status|string|max:255|required',
        ]);

        $MasterCivilStatus->create([

            'key' => $request->input('key'),

            'civil_status' => $request->input('civil_status'),

        ]);

        return redirect(route('setting.masters.civil'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterCivilStatus  $masterCivilStatus
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCivilStatus $masterCivilStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterCivilStatus  $masterCivilStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCivilStatus $masterCivilStatus, $id)
    {
        $master = $masterCivilStatus->where('id', $id)->first();

        return view('admin.master.civil.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterCivilStatus  $masterCivilStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterCivilStatus $masterCivilStatus, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'civil_status' => 'string|max:255|required',
        ]);
        
        $master_update = $masterCivilStatus->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->civil_status = $request->input('civil_status');

        $master_update->save();
        
        return redirect(route('setting.masters.civil'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterCivilStatus  $masterCivilStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterCivilStatus $masterCivilStatus, $id)
    {
        $master = $masterCivilStatus->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.civil'))->with('success', 'Data successfully deleted.');
    }
}

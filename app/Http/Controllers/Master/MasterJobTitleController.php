<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterJobTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterJobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterJobTitle::paginate(7);

        return view('admin.master.jobtitle.index', compact('master'));
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

        $validator = $request->validate([
            'job_title' => 'unique:master_job_titles,job_titles|required',
            'description' => 'unique:master_job_titles,description|required',
        ]);

        MasterJobTitle::create([

            'job_titles' => $request->input('job_title'),

            'description' => $request->input('description'),

        ]);

        return redirect(route('setting.masters.titles'))->with('success', 'Data successfully created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterJobTitle  $masterJobTitle
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJobTitle $masterJobTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterJobTitle  $masterJobTitle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $master = MasterJobTitle::where('id', $id)->first();

        return view('admin.master.jobtitle.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterJobTitle  $masterJobTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = $request->validate([
            'job_title' => 'required',
            'description' => 'required',
        ]);
        
        $master_update = MasterJobTitle::where('id', $id)->first();

        $master_update->job_titles = $request->input('job_title');

        $master_update->description = $request->input('description');

        $master_update->save();
        
        return redirect(route('setting.masters.titles'))->with('success', 'Data successfully updated.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterJobTitle  $masterJobTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        $master = MasterJobTitle::where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.titles'))->with('success', 'Data successfully deleted.');
    }
}

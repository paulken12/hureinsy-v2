<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterEducationType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterEducationTypController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterEducationType::paginate(7);

        return view('admin.master.education.index', compact('master'));
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
    public function store(MasterEducationType $MasterEducationType, Request $request)
    {
        $validator = $request->validate([
            'key' => 'unique:master_education_types,key|string|max:255|required',
            'educational_level' => 'unique:master_education_types,educational_level|string|max:255|required',
        ]);

        $MasterEducationType->create([

            'key' => $request->input('key'),

            'educational_level' => $request->input('educational_level'),

        ]);

        return redirect(route('setting.masters.education'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterEducationType  $masterEducationType
     * @return \Illuminate\Http\Response
     */
    public function show(MasterEducationType $masterEducationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterEducationType  $masterEducationType
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterEducationType $masterEducationType, $id)
    {
        $master = $masterEducationType->where('id', $id)->first();

        return view('admin.master.education.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterEducationType  $masterEducationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterEducationType $masterEducationType, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'educational_level' => 'string|max:255|required',
        ]);
        
        $master_update = $masterEducationType->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->educational_level = $request->input('educational_level');

        $master_update->save();
        
        return redirect(route('setting.masters.education'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterEducationType  $masterEducationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterEducationType $masterEducationType, $id)
    {
        $master = $masterEducationType->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.education'))->with('success', 'Data successfully deleted.');
    }
}

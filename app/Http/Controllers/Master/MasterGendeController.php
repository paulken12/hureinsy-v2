<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterGender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterGendeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterGender::paginate(7);

        return view('admin.master.gender.index', compact('master'));
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
    public function store(MasterGender $MasterGender, Request $request)
    {
        $validator = $request->validate([
            'key' => 'unique:master_genders,key|string|max:255|required',
            'gender' => 'unique:master_genders,gender|string|max:255|required',
        ]);

        $MasterGender->create([

            'key' => $request->input('key'),

            'gender' => $request->input('gender'),

        ]);

        return redirect(route('setting.masters.gender'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterGender  $masterGender
     * @return \Illuminate\Http\Response
     */
    public function show(MasterGender $masterGender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterGender  $masterGender
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterGender $masterGender, $id)
    {
        $master = $masterGender->where('id', $id)->first();

        return view('admin.master.gender.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterGender  $masterGender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterGender $masterGender, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'gender' => 'string|max:255|required',
        ]);
        
        $master_update = $masterGender->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->gender = $request->input('gender');

        $master_update->save();
        
        return redirect(route('setting.masters.gender'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterGender  $masterGender
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterGender $masterGender, $id)
    {
        $master = $masterGender->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.gender'))->with('success', 'Data successfully deleted.');
    }
}

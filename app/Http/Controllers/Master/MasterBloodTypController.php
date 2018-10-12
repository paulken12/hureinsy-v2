<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterBloodType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterBloodTypController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterBloodType::paginate(7);

        return view('admin.master.blood.index', compact('master'));
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
    public function store(MasterBloodType $MasterBloodType, Request $request)
    {
        $validator = $request->validate([
            'key' => 'unique:master_blood_types,key|string|max:255|required',
            'blood_type' => 'unique:master_blood_types,blood_type|string|max:255|required',
        ]);

        $MasterBloodType->create([

            'key' => $request->input('key'),

            'blood_type' => $request->input('blood_type'),

        ]);

        return redirect(route('setting.masters.blood'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterBloodType  $masterBloodType
     * @return \Illuminate\Http\Response
     */
    public function show(MasterBloodType $masterBloodType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterBloodType  $masterBloodType
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterBloodType $masterBloodType, $id)
    {
        $master = $masterBloodType->where('id', $id)->first();

        return view('admin.master.blood.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterBloodType  $masterBloodType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterBloodType $masterBloodType, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'blood_type' => 'string|max:255|required',
        ]);
        
        $master_update = $masterBloodType->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->blood_type = $request->input('blood_type');

        $master_update->save();
        
        return redirect(route('setting.masters.blood'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterBloodType  $masterBloodType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterBloodType $masterBloodType, $id)
    {
        $master = $masterBloodType->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.blood'))->with('success', 'Data successfully deleted.');
    }
}

<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterFamilyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterFamilyTypController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/*        $master = MasterFamilyType::paginate(7);

        return view('admin.master.family.index', compact('master'));*/
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
    public function store(MasterFamilyType $MasterFamilyType, Request $request)
    {
       /* $validator = $request->validate([
            'key' => 'unique:master_family_types,key|string|max:255|required',
            'family_type' => 'unique:master_family_types,family_type|string|max:255|required',
        ]);

        $MasterFamilyType->create([

            'key' => $request->input('key'),

            'family_type' => $request->input('family_type'),

        ]);

        return redirect(route('setting.masters.family'))->with('success', 'Data successfully created.');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterFamilyType  $masterFamilyType
     * @return \Illuminate\Http\Response
     */
    public function show(MasterFamilyType $masterFamilyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterFamilyType  $masterFamilyType
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterFamilyType $masterFamilyType, $id)
    {
 /*       $master = $masterFamilyType->where('id', $id)->first();

        return view('admin.master.family.edit', compact('id', 'master'));*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterFamilyType  $masterFamilyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterFamilyType $masterFamilyType, $id)
    {
/*        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'family_type' => 'string|max:255|required',
        ]);
        
        $master_update = $masterFamilyType->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->family_type = $request->input('family_type');

        $master_update->save();
        
        return redirect(route('setting.masters.family'))->with('success', 'Data successfully updated.');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterFamilyType  $masterFamilyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterFamilyType $masterFamilyType, $id)
    {
/*        $master = $masterFamilyType->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.family'))->with('success', 'Data successfully deleted.');*/
    }
}

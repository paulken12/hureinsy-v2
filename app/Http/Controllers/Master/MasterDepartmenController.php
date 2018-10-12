<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterDepartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterDepartmenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterDepartment::paginate(7);

        return view('admin.master.department.index', compact('master'));
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
    public function store(Request $request, MasterDepartment $MasterDepartment)
    {

        $validator = $request->validate([
            'key' => 'unique:master_departments,key|string|max:255|required',
            'department' => 'unique:master_departments,department|string|max:255|required',
        ]);

        $MasterDepartment->create([

            'key' => $request->input('key'),

            'department' => $request->input('department'),

        ]);

        return redirect(route('setting.masters.departments'))->with('success', 'Data successfully created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterDepartment  $masterDepartment
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterDepartment  $masterDepartment
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterDepartment $MasterDepartment, $id)
    {
        $master = $MasterDepartment->where('id', $id)->first();

        return view('admin.master.department.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterDepartment  $masterDepartment
     * @return \Illuminate\Http\Response
     */
    public function update(MasterDepartment $MasterDepartment, Request $request, $id)
    {

        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'department' => 'string|max:255|required',
        ]);
        
        $master_update = $MasterDepartment->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->department = $request->input('department');

        $master_update->save();
        
        return redirect(route('setting.masters.departments'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterDepartment  $masterDepartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterDepartment $MasterDepartment, $id)
    {
        $master = MasterDepartment::where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.departments'))->with('success', 'Data successfully deleted.');
    }
}

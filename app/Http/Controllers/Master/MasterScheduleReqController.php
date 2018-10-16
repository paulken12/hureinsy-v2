<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterScheduleTypePaf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterScheduleReqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterScheduleTypePaf::paginate(7);

        return view('admin.master.schedrequest.index', compact('master'));
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
    public function store(MasterScheduleTypePaf $MasterScheduleTypePaf, Request $request)
    { 
        $validator = $request->validate([
            'key' => 'unique:master_schedule_type_pafs,key|string|max:255|required',
            'schedule_type' => 'unique:master_schedule_type_pafs,schedule_type|string|max:255|required',
        ]);

        $MasterScheduleTypePaf->create([

            'key' => $request->input('key'),

            'schedule_type' => $request->input('schedule_type'),

        ]);

        return redirect(route('setting.masters.schedrequest'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterScheduleTypePaf $masterScheduleTypePaf, $id)
    {
        $master = $masterScheduleTypePaf->where('id', $id)->first();

        return view('admin.master.schedrequest.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterScheduleTypePaf $masterScheduleTypePaf, Request $request, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'schedule_type' => 'string|max:255|required',
        ]);
        
        $master_update = $masterScheduleTypePaf->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->schedule_type = $request->input('schedule_type');

        $master_update->save();
        
        return redirect(route('setting.masters.schedrequest'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterScheduleTypePaf $masterScheduleTypePaf, $id)
    {
        $master = $masterScheduleTypePaf->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.schedrequest'))->with('success', 'Data successfully deleted.');
    }
}

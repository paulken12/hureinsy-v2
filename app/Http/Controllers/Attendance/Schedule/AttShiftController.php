<?php

namespace App\Http\Controllers\Attendance\Schedule;

use App\Attendance\Schedule\AttShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //dd(date('l', strtotime('monday + 2 day')));

        $shift = AttShift::all();
        return view('admin.attendance-management.dtr.shift.index', compact('shift'));
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
        $shi = $request->validate([

            'in_name' => 'required|unique:att_shifts,display_name',

            'in_in' => 'required',

            'in_out' => 'required',

        ],[
            'in_name.required' => 'name is required',
            'in_name.unique' => 'name has already been taken',
        ]);

        AttShift::create([
            'display_name' => $request->in_name, 
            'time_in' => $request->in_in, 
            'time_out' => $request->in_out, 

        ]);

        return ['mes' => 'Shift added'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance\Schedule\AttShift  $attShift
     * @return \Illuminate\Http\Response
     */
    public function show(AttShift $attShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance\Schedule\AttShift  $attShift
     * @return \Illuminate\Http\Response
     */
    public function edit(AttShift $attShift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance\Schedule\AttShift  $attShift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttShift $attShift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance\Schedule\AttShift  $attShift
     * @return \Illuminate\Http\Response
     */
    public function delete(AttShift $id)
    {
        $id->delete();
    }
}

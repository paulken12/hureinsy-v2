<?php

namespace App\Http\Controllers\Attendance\Schedule;

use App\Attendance\Schedule\AttSchedule;
use App\Personnel\Info\EmpBasic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attendance-management.dtr.schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = EmpBasic::orderBy('last_name','asc')->get();

        return view('admin.attendance-management.dtr.schedule.create', compact('employees'));
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
     * @param  \App\Attendance\Schedule\AttSchedule  $attSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(AttSchedule $attSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance\Schedule\AttSchedule  $attSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(AttSchedule $attSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance\Schedule\AttSchedule  $attSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttSchedule $attSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance\Schedule\AttSchedule  $attSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttSchedule $attSchedule)
    {
        //
    }
}

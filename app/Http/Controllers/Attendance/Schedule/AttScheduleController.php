<?php

namespace App\Http\Controllers\Attendance\Schedule;

use App\Attendance\Schedule\AttAttendance;
use App\Attendance\Schedule\AttHoliday;
use App\Attendance\Schedule\AttSchedule;
use App\Attendance\Schedule\AttShift;
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
        $schedlist = AttSchedule::orderBy('id', 'desc')->get();

        return view('admin.attendance-management.dtr.schedule.index', compact('schedlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = EmpBasic::orderBy('last_name','asc')->get();
        $shifts = AttShift::all();
        return view('admin.attendance-management.dtr.schedule.create', compact('employees', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sch = $request->validate([

            'in_employee_id' => 'required|exists:emp_basics,id',

            'in_shift' => 'required|exists:att_shifts,id',

            'in_days_per_week' => 'required',

            'in_week_start' => 'required',

            'in_start' => 'required|date_format:Y-m-d',

            'in_end' => 'required|date_format:Y-m-d',

        ],[
            'in_employee_id.required' => 'Select an employee.',
            'in_employee_id.exist' => 'Employee does not exist.',
            'in_shift.required' => 'Select a shift.',
            'in_shift.exist' => 'Shift does not exist',
            'in_days_per_week.required' => 'Days per week is required',
            'in_week_start.required' => 'Select a week',
            'in_start.required' => 'Date start is required.',
            'in_end.required' => 'Date end is required.',
        ]);

        AttSchedule::create([
            'emp_basic_id' => $request->in_employee_id,
            'att_shift_key' => $request->in_shift, 
            'freq' => (strtotime($request->in_end) - strtotime($request->in_start))/86400, 
            'interval' => $request->in_total_hours, 
            'count' => $request->in_days_per_week, 
            'week_start' => $request->in_week_start, 
            'start_date' => $request->in_start, 
            'end_date' => $request->in_end, 

        ]);

        return response()->json(['success' =>'Schedule has been added.', 'redirect' => route('dashboard')],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance\Schedule\AttSchedule  $attSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(AttSchedule $id)
    {
        $emp_sched = $id->toArray();
        $emp_info = $id->empBasic;
        $holidays = AttHoliday::all();
        $emp_shift = $id->attShift;
        $emp_dtr = AttAttendance::whereBetween('date', [$id->start_date, $id->end_date])
                                 ->where('emp_basic_id', $id->empBasic->company_id)
                                 ->get();
        return view('admin.attendance-management.dtr.schedule.show', compact('emp_sched', 'emp_info', 'holidays', 'emp_shift', 'emp_dtr'));

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

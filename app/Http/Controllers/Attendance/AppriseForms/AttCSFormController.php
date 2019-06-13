<?php

namespace App\Http\Controllers\Attendance\AppriseForms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance\AppriseForms\AttCSForm;
use App\Personnel\Info\Contract;

class AttCSFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AttCSForm::where('employee_id', Auth::user()->basicInfo->pluck('id')->first())
                         ->groupBy('status', 'id')->get();
        return view('admin.attendance-management.forms.cs.index', compact('list'));
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

        $emp_id = Auth::user()->basicInfo->pluck('id')->first();

        $contract = Contract::where('emp_basic_id', $emp_id)->first();

        $CS = $request->validate([

            'cs_date' => 'required',

            'cs_time_in' => 'required',

            'cs_time_out' => 'required',

            'cs_new_date' => 'required',

            'cs_new_time_in' => 'required',

            'cs_new_time_out' => 'required',

            'cs_reason' => 'required',

        ],[
            'cs_date.required' => 'Shift date is required',

            'cs_time_in.required' => 'Shift time in is required',

            'cs_time_out.required' => 'Shift time out is required',

            'cs_new_date.required' => 'New date is required',

            'cs_new_time_in.required' => 'New time in is required',

            'cs_new_time_out.required' => 'New time out is required',

            'cs_reason.required' => 'Reason is required',            

        ]);

        for($i=0; $i < count($CS['cs_date']); ++$i ) {
            AttCSForm::create([
                'employee_id' => $emp_id,

                'reporting_to' => $contract->jobDescription->reporting_to,

                'date' => $CS['cs_date'][$i],

                'time_in' => $CS['cs_time_in'][$i],

                'time_out' => $CS['cs_time_out'][$i],

                'new_date' => $CS['cs_new_date'][$i],

                'new_time_in' => $CS['cs_new_time_in'][$i],

                'new_time_out' => $CS['cs_new_time_out'][$i],

                'reason' => $CS['cs_reason'][$i],

                'status' => 'For authorization',

                'confirmed' => 0,

                'applied' => 0

            ]);
        }

            return ['mes' => 'Temporary Change of Shift form requested'];
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttCSForm $id)
    {
        $id->confirmed = 1;
        $id->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

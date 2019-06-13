<?php

namespace App\Http\Controllers\Attendance\AppriseForms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance\AppriseForms\AttOTForm;
use App\Personnel\Info\Contract;

class AttOTFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AttOTForm::where('employee_id', Auth::user()->basicInfo->pluck('id')->first())
                         ->groupBy('status', 'id')->get();
        return view('admin.attendance-management.forms.ot.index', compact('list'));
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

        $OT = $request->validate([

            'ot_date' => 'required',

            'ot_start' => 'required',

            'ot_end' => 'required',
            
            'ot_type' => 'required',
            
            'ot_regular_time' => 'nullable',

            'ot_reason' => 'required',

        ],[
            'ot_date.required' => 'Date is required',

            'ot_start.required' => 'OT start is required',

            'ot_end.required' => 'OT end is required',
            
            'ot_type.required' => 'OT type is required',

            'ot_reason.required' => 'Reason is required',

        ]);

        for($i=0; $i < count($OT['ot_date']); ++$i ) {
            AttOTForm::create([
                'employee_id' => $emp_id,

                'reporting_to' => $contract->jobDescription->reporting_to,

                'date' => $OT['ot_date'][$i],

                'ot_start' => $OT['ot_start'][$i],

                'ot_end' => $OT['ot_end'][$i],

                'type' => $OT['ot_type'][$i],

                'regular_time' => $OT['ot_regular_time'][$i],

                'hours' => abs((strtotime($OT['ot_start'][$i]) - strtotime($OT['ot_end'][$i])) / 3600),

                'reason' => $OT['ot_reason'][$i],

                'status' => 'For authorization',

                'confirmed' => 0,
                
                'applied' => 0

            ]);
        }

            return ['mes' => 'Over Time form requested'];
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
    public function update(Request $request, AttOTForm $id)
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

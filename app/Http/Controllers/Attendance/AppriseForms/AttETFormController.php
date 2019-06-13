<?php

namespace App\Http\Controllers\Attendance\AppriseForms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance\AppriseForms\AttETForm;
use App\Personnel\Info\Contract;

class AttETFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AttETForm::where('employee_id', Auth::user()->basicInfo->pluck('id')->first())
                         ->groupBy('status', 'id')->get();
        return view('admin.attendance-management.forms.et.index', compact('list'));
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

        $ET = $request->validate([

            'et_date' => 'required',

            'et_time_out' => 'required',

            'et_new_time_out' => 'required',

            'et_reason' => 'required',

        ],[
            'et_date.required' => 'Date is required',

            'et_time_out.required' => 'Current time out is required',

            'et_new_time_out.required' => 'New time out is required',

            'et_reason.required' => 'Reason is required',

        ]);

        for($i=0; $i < count($ET['et_date']); ++$i ) {
            AttETForm::create([
                'employee_id' =>  $emp_id,

                'reporting_to' => $contract->jobDescription->reporting_to,

                'date' => $ET['et_date'][$i],

                'time_out' => $ET['et_time_out'][$i],

                'new_time_out' => $ET['et_new_time_out'][$i],

                'reason' => $ET['et_reason'][$i],

                'status' => 'For authorization',

                'confirmed' => 0,
                
                'applied' => 0

            ]);
        }

            return ['mes' => 'Early Timeout form requested'];
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
    public function update(Request $request, AttETForm $id)
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

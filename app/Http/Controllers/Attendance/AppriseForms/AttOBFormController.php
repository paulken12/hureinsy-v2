<?php

namespace App\Http\Controllers\Attendance\AppriseForms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance\AppriseForms\AttOBForm;

class AttOBFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AttOBForm::where('employee_id', Auth::user()->basicInfo->pluck('id')->first())
                         ->groupBy('status', 'id')->get();
        return view('admin.attendance-management.forms.ob.index', compact('list'));
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

        $OB = $request->validate([

            'ob_date' => 'required',

            'ob_time_in' => 'required',

            'ob_time_out' => 'required',

            'ob_reason' => 'required',

            'ob_location' => 'required',

            'ti_checked' => 'nullable',

            'to_checked' => 'nullable',

        ],[
            'ob_date.required' => 'Date is required',

            'ob_time_in.required' => 'Time in is required',

            'ob_time_out.required' => 'Time out is required',

            'ob_reason.required' => 'Reason is required',
            
            'ob_location.required' => 'Location is required',

        ]);

        for($i=0; $i < count($OB['ob_date']); ++$i ) {
            AttOBForm::create([
                'employee_id' => Auth::user()->basicInfo->pluck('id')->first(),

                'date' => $OB['ob_date'][$i],

                'time_in' => $OB['ob_time_in'][$i],

                'time_out' => $OB['ob_time_out'][$i],

                'location' => $OB['ob_location'][$i],

                'reason' => $OB['ob_reason'][$i],

                'o_in' => $OB['ti_checked'][$i],

                'o_out' => $OB['to_checked'][$i],

                'status' => 'Waiting for authorization',

                'confirmed' => 0,

            ]);
        }

            return ['mes' => 'OB form requested'];
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
    public function update(Request $request, $id)
    {
        //
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

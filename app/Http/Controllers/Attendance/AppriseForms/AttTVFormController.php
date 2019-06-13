<?php

namespace App\Http\Controllers\Attendance\AppriseForms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance\AppriseForms\AttTVForm;
use App\Personnel\Info\Contract;

class AttTVFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AttTVForm::where('employee_id', Auth::user()->basicInfo->pluck('id')->first())
                         ->groupBy('status', 'id')->get();
        return view('admin.attendance-management.forms.tv.index', compact('list'));
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
        
        $TV = $request->validate([

            'tv_date' => 'required',

            'tv_time_in' => 'nullable',

            'tv_time_out' => 'nullable',

            'tv_reason' => 'required',

        ],[
            'tv_date.required' => 'Date is required',

            'tv_time_in.required' => 'Time in is required',

            'tv_time_out.required' => 'Time out is required',

            'tv_reason.required' => 'Reason is required',

        ]);

        for($i=0; $i < count($TV['tv_date']); ++$i ) {
            AttTVForm::create([
                'employee_id' => Auth::user()->basicInfo->pluck('id')->first(),

                'date' => $TV['tv_date'][$i],

                'time_in' => $TV['tv_time_in'][$i],

                'time_out' => $TV['tv_time_out'][$i],

                'reason' => $TV['tv_reason'][$i],

                'status' => 'For authorization',

                'confirmed' => 0,
                
                'applied' => 0

            ]);
        }

            return ['mes' => 'Time Validation form requested'];
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
    public function update(Request $request, AttTVForm $id)
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

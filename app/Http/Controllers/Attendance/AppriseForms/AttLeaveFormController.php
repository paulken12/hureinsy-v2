<?php

namespace App\Http\Controllers\Attendance\AppriseForms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Attendance\AppriseForms\AttLeaveForm;
use App\Attendance\SILManagement;
use App\Master\MasterLeaveType;
use App\Personnel\Info\EmpBasic;
use App\Http\Controllers\Controller;

class AttLeaveFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave = MasterLeaveType::all();
        $sil = SILManagement::all();
        $list = AttLeaveForm::where('employee_id', Auth::user()->basicInfo->pluck('id')->first())
                         ->groupBy('status', 'id')->get();
        $emp = Auth::user()->basicInfo->pluck('id')->first();
        return view('admin.attendance-management.forms.leave.index', compact('list', 'leave', 'sil', 'emp'));
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

        $paf = $request->validate([
            "leave_type" => 'required',
            "leave_start" => 'required',
            "leave_end" => 'required',
            "reason" => 'required',
            "sil" => 'nullable',
            "total_days" => 'required',
        ]);
        AttLeaveForm::create([
            "employee_id" => Auth::user()->basicInfo->pluck('id')->first(),
            "validated_by" => '',    
            "approved_by" => '', 
            "leave_type" => $paf['leave_type'],  
            "reason" => $paf['reason'],  
            "date_start" => $paf['leave_start'],  
            "date_end" => $paf['leave_end'],    
            "total_leaves" => $paf['total_days'],    
            "status" => 'For Evaluation',
        ]);
        //
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

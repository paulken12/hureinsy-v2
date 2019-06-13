<?php

namespace App\Http\Controllers\Attendance;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance\Schedule\AttAttendance;
use App\Attendance\AppriseForms\AttCSForm;
use App\Attendance\AppriseForms\AttETForm;
use App\Attendance\AppriseForms\AttOBForm;
use App\Attendance\AppriseForms\AttOTForm;
use App\Attendance\AppriseForms\AttTVForm;
use App\Personnel\Info\EmpBasic;

class AttTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cs = AttCSForm::where('status', 'For Authorization')
                         ->where('reporting_to', Auth::user()->basicInfo->pluck('id')->first())
                         ->get();

        $et = AttETForm::where('status', 'For Authorization')
                         ->where('reporting_to', Auth::user()->basicInfo->pluck('id')->first())
                         ->get();

        $ob = AttOBForm::where('status', 'For Authorization')
                         ->where('reporting_to', Auth::user()->basicInfo->pluck('id')->first())
                         ->get();

        $ot = AttOTForm::where('status', 'For Authorization')
                         ->where('reporting_to', Auth::user()->basicInfo->pluck('id')->first())
                         ->get();

        $tv = AttTVForm::where('status', 'For Authorization')
                         ->where('reporting_to', Auth::user()->basicInfo->pluck('id')->first())
                         ->get();

        $employee = EmpBasic::all();

        return view('admin.attendance-management.task.index', compact('cs', 'et', 'ob', 'ot', 'tv', 'employee'));
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

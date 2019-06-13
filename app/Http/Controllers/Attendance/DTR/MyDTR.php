<?php

namespace App\Http\Controllers\Attendance\DTR;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Attendance\Schedule\AttAttendance;
use App\Http\Controllers\Controller;

class MyDTR extends Controller
{
    public function list()
    {
    	$dtr = AttAttendance::where('emp_basic_id', Auth::user()->basicInfo->pluck('id')->first())->get();

        return view('admin.attendance-management.dtr.raw-data-table.list', compact('dtr', 'dlist'));
    }

    public function index($dtr)
    {
    	$raw_file = AttAttendance::where('dtr_id', $dtr)->get()->toarray();

		return view('admin.attendance-management.dtr.raw-data-table.index', compact('raw_file'));
    }

}

<?php

namespace App\Http\Controllers\Attendance\DTR;

use Illuminate\Http\Request;
use App\Attendance\Schedule\AttAttendance;
use App\Http\Controllers\Controller;

class MyDTR extends Controller
{
    public function list()
    {
    	$dtr = AttAttendance::distinct('dtr_id')->pluck('dtr_id');
    	$dlist = array();
    	$cout = 1;

    	foreach($dtr as $list){
    		$date = str_split($list, strlen($list)/2);
    		$dlist[] = array(
    					'id' => $cout,
    					'dtr_id' => $list,
    					'date_start' => date('Y-m-d', strtotime($date[0])),
    					'date_end' => date('Y-m-d', strtotime($date[1])),
    		);

    		$cout = $cout+1;
    	}
    	//dd(date('Y-m-d', strtotime('20190114')));
        return view('admin.attendance-management.dtr.raw-data-table.list', compact('dlist'));
    }

    public function index($dtr)
    {
    	$raw_file = AttAttendance::where('dtr_id', $dtr)->get()->toarray();

		return view('admin.attendance-management.dtr.raw-data-table.index', compact('raw_file'));
    }

}

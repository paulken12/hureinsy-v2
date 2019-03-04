<?php

namespace App\Http\Controllers\Attendance\Schedule;

use Illuminate\Http\Request;
use App\Attendance\Schedule\AttHoliday;
use App\Http\Controllers\Controller;

class AttHolidayController extends Controller
{
    public function index()
    {
    	$holiday = AttHoliday::all();
        return view('admin.attendance-management.dtr.holiday.index', compact('holiday'));
    }

    public function store(Request $request)
    {

        $hol = $request->validate([

            'in_date' => 'required|unique:att_holidays,date',

            'in_holiday_name' => 'required'

        ],[
            'in_holiday_name.required' => 'holiday name is required',
        	'in_date.required' => 'date is required',
        	'in_date.unique' => 'date has already been taken',
        ]);

    	AttHoliday::create([
    		'date' => $request->in_date,
    		'name' => $request->in_holiday_name, 

    	]);

    	return ['mes' => 'Holiday added'];
/*
    	dd();
    	$holiday = $request->validate([]);*/
    }

    public function delete(AttHoliday $id)
    {	
        $id->delete();
    }
}

<?php

namespace App\Http\Controllers\Attendance;

use Illuminate\Http\Request;
use App\Imports\AttImportRaw;
use App\Http\Controllers\Controller;
use App\Attendance\Schedule\AttAttendance;
use App\Attendance\AppriseForms\AttCSForm;
use App\Attendance\AppriseForms\AttETForm;
use App\Attendance\AppriseForms\AttOBForm;
use App\Attendance\AppriseForms\AttTVForm;
use App\Personnel\Info\EmpBasic;
use Maatwebsite\Excel\Facades\Excel;

class AttImportController extends Controller
{   
    public function index()
    {
        return view('admin.attendance-management.dtr.att.index');
    }

	public function import(Request $request) 
    {
        Excel::import(new AttImportRaw, request()->file('import_file'));
        $att= AttAttendance::all();
        //where('dtr_id', date('ymd'))->get()
        $et = AttETForm::where('status', 'Authorized')
        				->where('applied', '0')->get();

        foreach ($et as $set) {
            $dtr = $att->where('date', $set->date)->where('emp_basic_id', $set->employee_id)->first();
            if($dtr){
                $dtr->is_under_time = '0';
                $dtr->save();
                $set->applied = '1';
                $set->save(); 
            }
        }

        $tv = AttTVForm::where('status', 'Authorized')
                        ->where('applied', '0')->get();

        foreach ($tv as $stv) {
            $dtr = $att->where('date', $stv->date)->where('emp_basic_id', $stv->employee_id)->first();
            if($dtr){
                if($stv->time_in){
                    $dtr->time_in = date('H:i', strtotime($stv->time_in));
                }
                if($stv->time_out){
                    $dtr->time_out = date('H:i', strtotime($stv->time_out));
                }
                $dtr->total_hours = $this->time_diff($dtr->time_in, $dtr->time_out);
                $dtr->is_late = $this->isLate($dtr->required_time_in, $dtr->time_in);
                $dtr->is_under_time = $this->isUndertime($dtr->required_time_out, $dtr->time_out);
                $dtr->save();
                $stv->applied = '1';
                $stv->save(); 
            }
        }

        $ob = AttOBForm::where('status', 'Authorized')
                        ->where('applied', '0')->get();

        foreach ($ob as $sob) {
            $dtr = $att->where('date', $sob->date)->where('emp_basic_id', $sob->employee_id)->first();
            if($dtr){
                if($sob->o_in == '0'){
                    $dtr->time_in = date('H:i', strtotime($sob->time_in));
                }
                if($sob->o_out == '0'){
                    $dtr->time_out = date('H:i', strtotime($sob->time_out));
                }
                $dtr->total_hours = $this->time_diff($dtr->time_in, $dtr->time_out);
                $dtr->is_late = $this->isLate($dtr->required_time_in, $dtr->time_in);
                $dtr->is_under_time = $this->isUndertime($dtr->required_time_out, $dtr->time_out);
                $dtr->save();
                $sob->applied = '1';
                $sob->save(); 
            }
        }

        $cs = AttCSForm::where('status', 'Authorized')
                        ->where('applied', '0')->get();

        foreach ($cs as $scs) {
            $dtr = $att->where('date', $scs->date)->where('emp_basic_id', $scs->employee_id)->first();
            if($dtr){
                $dtr->required_time_in = date('H:i', strtotime($scs->new_time_in));
                $dtr->required_time_out = date('H:i', strtotime($scs->new_time_out));
                $dtr->total_hours = $this->time_diff($dtr->time_in, $dtr->time_out);
                $dtr->is_late = $this->isLate($dtr->required_time_in, $dtr->time_in);
                $dtr->is_under_time = $this->isUndertime($dtr->required_time_out, $dtr->time_out);
                $dtr->save();
                $scs->applied = '1';
                $scs->save(); 
            }
        }

        return redirect(route('att.import.table', date('ymd')));
    }

    public function table($dtr_id) 
    {   
        $list = AttAttendance::where('dtr_id', $dtr_id)->get();
        $employees = EmpBasic::all();
        return view('admin.attendance-management.dtr.att.table.index', compact('list', 'employees'));
    }

    function time_diff($x, $y){
        if(empty($x)){
            return '0';
        }
        if(empty($y)){
            return '0';
        }else{
            $h =date('H', strtotime($x));
            $m =date('i', strtotime($x));
            return date('H.i', strtotime('-'.$h.'hour -'.$m.'minutes' , strtotime($y)));
        }
    }

    function isLate($x, $y){
        if($y <= $x){
            return '0';
        }
        else{
            return '1';
        }
    }

    function isUndertime($x, $y){
        if($y >= $x){
            return '0';
        }
        else{
            return '1';
        }
    }
}

<?php

namespace App\Helper\Paf;
 
use App\User;
use App\Personnel\Info\EmpBasic;
use App\Master\MasterCompany;
use App\Master\MasterJobTitle;
use App\Master\MasterDepartment;
use App\Paf\PafManagement;
use App\Master\MasterScheduleTypePaf;
use App\Master\MasterEmpStatusPaf;
use App\Paf\PafChangeJob;
use App\Paf\PafChangeSchedule;
use App\Paf\PafChangeCompensation;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;

class PersonnelActionManagement {

    public static function get_paf_request($paf_id){
        return PafManagement::find($paf_id);
    }

    public static function get_paf_job_detail($paf_id){
        return PafChangeJob::where('request_id', $paf_id)->first();
    }

    public static function get_paf_schedule_detail($paf_id){
        return PafChangeSchedule::where('request_id', $paf_id)->first();
    }

    public static function get_paf_compensation_detail($paf_id){
        return PafChangeCompensation::where('request_id', $paf_id)->first();
    }

    public static function get_employee_info($user_id){
    	return EmpBasic::where('company_id', $user_id)->first();
    }

    public static function call_user(){
    	return User::all();
    }

    public static function call_emp_info(){
    	return EmpBasic::all();
    }

    public static function call_master_company(){
    	return MasterCompany::all();
    }

    public static function call_master_job_title(){
    	return MasterJobTitle::all();
    }

    public static function call_master_department(){
    	return MasterDepartment::all();
    }

    public static function call_master_paf_schedule_type(){
    	return MasterScheduleTypePaf::all();
    }

    public static function call_master_employment_status(){
    	return MasterEmpStatusPaf::all();
    }

    public static function call_paf_lists(){
    	return PafManagement::paginate(10);
    }

}
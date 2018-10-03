<?php

namespace App\Helper\Paf;
 
use App\User;
use App\Master\MasterCompany;
use App\Master\MasterJobTitle;
use App\Master\MasterDepartment;
use App\Master\MasterEmpStatus;
use App\Master\MasterScheduleTypePaf;
use App\Paf\PafChangeJob;
use App\Paf\PafManagement;
use App\Paf\PafChangeSchedule;
use App\Paf\PafChangeCompensation;
use App\Personnel\Info\EmpBasic;
use App\Personnel\Info\EmpContract;
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

    public static function get_employee_contract($user_id){
        return EmpContract::where('emp_basic_id', $user_id)->first();
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
    	return MasterEmpStatus::all();
    }

    public static function call_paf_lists(){
    	return PafManagement::paginate(10);
    }

    public static function call_contract(){
        return EmpContract::all();
    }

    public static function register_date_effective(){

        $get_paf_info = PafManagement::all();
        $get_date_today = date('Y-m-d');

       foreach ($get_paf_info as $register_date) {
            if ($get_date_today == $register_date->date_effective) {

                $get_emp_info = EmpBasic::where('company_id', $register_date->employee_company_id)->first();
                
                $get_paf_job = PafChangeJob::where('request_id', $register_date->id)->first();

                $get_paf_sched = PafChangeSchedule::where('request_id', $register_date->id)->first();
                
                $get_emp_contract = EmpContract::where('emp_basic_id', $get_emp_info->id)->first();

                $get_emp_contract->employment_status = $register_date->master_key_employment_status; 

                $get_emp_info->reporting_to = $get_paf_job->proposed_reports_to;

                $get_emp_contract->master_job_title_id = $get_paf_job->proposed_key_position_title;
                
                $get_emp_contract->master_company_key = $get_paf_job->proposed_key_project_assignment;
                
                $get_emp_contract->master_department_key = $get_paf_job->proposed_key_department;                
/*
                $get_emp_contract->master_shift_key = $get_paf_sched->proposed_type_of_shift;
*/
                $get_emp_contract->save();
            }
        }
            
    }

}
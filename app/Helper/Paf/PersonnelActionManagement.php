<?php

namespace App\Helper\Paf;
 
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Master\MasterCompany;
use App\Master\MasterJobTitle;
use App\Master\MasterDepartment;
use App\Master\MasterContractChangePaf;
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

    public static function call_contract_change(){
    	return MasterContractChangePaf::all();
    }

    public static function call_contract(){
        return EmpContract::all();
    }

    public static function count_complete_user(){
        return PafManagement::where('master_id_request_status', '2')
                            ->whereDate('created_at', date('Y-m-d'))
                            ->count();
    }    

    public static function count_open_hr(){
        $user_id = Auth::user()->basicInfo->pluck('company_id')->first();
        return PafManagement::where('master_id_sub_request_status', '1')
                            ->whereIn('assessed_by_company_id', [$user_id, ''])
                            ->count();
    }
    
    public static function count_open_exec(){
        return PafManagement::where('master_id_request_status', '2')
                            ->where('approved_by_company_id', '')
                            ->count();
    }

    public static function count_open_man(){
        return PafManagement::where('master_id_request_status', '3')
                            ->where('employee_company_id', Auth::user()->basicInfo->pluck('company_id')->first())
                            ->count();
    }

    public static function call_paf_lists($month, $year){
        $user_id = Auth::user()->basicInfo->pluck('company_id')->first();
        return PafManagement::when($user_id, function($query, $user_id){
                                if (Auth::user()->hasRole('human-resource')) {
                                    return $query->whereIn('assessed_by_company_id', [$user_id, '']);
                                }else{
                                    return null;
                                }
                            })
                            ->whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->orderBy('master_id_request_status', 'asc')
                            ->orderBy('id', 'desc')
                            ->paginate(7);
    }

    public static function call_paf_lists_manager($month, $year){
        return PafManagement::whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->where('requested_by_company_id', Auth::user()->basicInfo->pluck('company_id')->first())
                            ->orderBy('master_id_request_status', 'asc')
                            ->orderBy('id', 'desc')
                            ->paginate(7);
    }

    public static function call_paf_lists_user($month, $year){
        return PafManagement::whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->where('employee_company_id', Auth::user()->basicInfo->pluck('company_id')->first())
                            ->orderBy('master_id_request_status', 'asc')
                            ->orderBy('id', 'desc')
                            ->paginate(7);
    }

    public static function call_paf_archived(){
        return PafManagement::selectRaw('year(created_at) year, month(created_at) month, monthname(created_at) monthname, count(*) published')
                            ->groupBy('year', 'month')
                            ->orderByRaw('min(created_at) desc')
                            ->get()
                            ->toArray();
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
<?php

namespace App\Helper\Paf;
 
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Team;
use App\Contract\Job;
use App\Contract\Project;
use App\Master\MasterCompany;
use App\Master\MasterDepartment;
use App\Master\MasterContractChangePaf;
use App\Master\MasterScheduleTypePaf;
use App\Master\MasterBehaviouralAssessmentPaf;
use App\Master\MasterOverallRecommendationPaf;
use App\Master\MasterPerformanceEvaluationPaf;
use App\Master\MasterProficiencyTestPaf;
use App\Paf\PafChangeJob;
use App\Paf\PafManagement;
use App\Paf\PafChangeSchedule;
use App\Paf\PafChangeCompensation;
use App\Paf\PafCurrentJob;
use App\Paf\PafCurrentSchedule;
use App\Paf\PafCurrentCompensation;
use App\Paf\PafHrAssessment;
use App\Personnel\Info\EmpBasic;
use App\Personnel\Info\Contract;
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

    public static function get_current_paf_job_detail($paf_id){
        return PafCurrentJob::where('request_id', $paf_id)->first();
    }

    public static function get_current_paf_schedule_detail($paf_id){
        return PafCurrentSchedule::where('request_id', $paf_id)->first();
    }

    public static function get_current_paf_compensation_detail($paf_id){
        return PafCurrentCompensation::where('request_id', $paf_id)->first();
    }

    public static function get_hr_assessment_detail($paf_id){
        return PafHrAssessment::where('request_id', $paf_id)->first();
    }

    public static function get_employee_info($user_id){
        return EmpBasic::where('id', $user_id)->first();
    }
    
    public static function get_employee_contract($user_id){
        return Contract::where('emp_basic_id', $user_id)->first();
    }
    
    public static function get_employee_team($id){
        return Team::find($id);
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
        return Job::all();
    }

    public static function call_master_project_assignment(){
        return Project::all();
    }

    public static function call_master_department(){
    	return MasterDepartment::all();
    }

    public static function call_master_paf_schedule_type(){
    	return MasterScheduleTypePaf::all();
    }

    public static function call_master_paf_behavioural_assessment(){
        return MasterBehaviouralAssessmentPaf::all();
    }

    public static function call_master_paf_overall_recommendation(){
        return MasterOverallRecommendationPaf::all();
    }

    public static function call_master_paf_performance_evaluation(){
        return MasterPerformanceEvaluationPaf::all();
    }

    public static function call_master_paf_proficiency_test_paf(){
        return MasterProficiencyTestPaf::all();
    }

    public static function call_team(){
        return Team::all();
    }

    public static function call_contract_change(){
        return MasterContractChangePaf::all();
    }

    public static function call_contract(){
        return Contract::all();
    }

    public static function call_paf(){
        return PafManagement::all();
    }

    public static function count_complete_user(){
        return PafManagement::where('master_id_request_status', '2')
                            ->where('employee_company_id', Auth::user()->basicInfo->pluck('id')->first())
                            ->where('comfirmation_flag', '0')
                            ->count();
    }    

    public static function count_open_hr(){
        $user_id = Auth::user()->basicInfo->pluck('id')->first();
        return PafManagement::where('master_id_sub_request_status', '1')
                            ->whereIn('assessed_by_company_id', [$user_id, ''])
                            ->count();
    }
    
    public static function count_open_exec(){
        return PafManagement::where('master_id_sub_request_status', '2')
                            ->count();
    }

    public static function count_open_man(){
        return PafManagement::where('master_id_sub_request_status', '3')
                            ->where('requested_by_company_id', Auth::user()->basicInfo->pluck('id')->first())
                            ->count();
    }

    public static function call_paf_lists($month, $year){
        return PafManagement::whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->orderBy('master_id_request_status', 'asc')
                            ->orderBy('id', 'desc')
                            ->paginate(7);
    }

    public static function call_paf_lists_hr($month, $year){
        $user_id = Auth::user()->basicInfo->pluck('id')->first();
        return PafManagement::whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->whereIn('assessed_by_company_id', [$user_id, ''])
                            ->orderBy('master_id_request_status', 'asc')
                            ->orderBy('id', 'desc')
                            ->paginate(7);
    }

    public static function call_paf_lists_manager($month, $year){
        return PafManagement::whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->where('requested_by_company_id', Auth::user()->basicInfo->pluck('id')->first())
                            ->orderBy('master_id_request_status', 'asc')
                            ->orderBy('id', 'desc')
                            ->paginate(7);
    }

    public static function call_paf_lists_user($month, $year){
        return PafManagement::whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->where('employee_company_id', Auth::user()->basicInfo->pluck('id')->first())
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

}
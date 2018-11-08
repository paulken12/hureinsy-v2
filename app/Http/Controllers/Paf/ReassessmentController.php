<?php

namespace App\Http\Controllers\Paf;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;
use App\Helper\Paf\PersonnelActionManagement;

class ReassessmentController extends Controller
{
    public function list($month, $year)
    {

        Cache::forever('call_paf_lists_manager', PersonnelActionManagement::call_paf_lists_manager($month, $year));

        $request_list = Cache::get('call_paf_lists_manager');

        $archives = Cache::get('call_paf_lists_archived');

    	return view('paf.mpaf.list', compact('request_list', 'archives'));
    }

    public function show($form){

        Cache::forget('call_paf_lists_manager');

        //Get Status 
        $user_log = Auth::user()->roles->first(); 
        $get_status = $user_log->status;
        $get_sub_status =$user_log->sub_status;

        //Get Master details
        $reportTo = Cache::get('call_user');

        $proj_assignment = Cache::get('call_master_project_assignment');

        $jobTitles = Cache::get('call_master_job_title');

        $department = Cache::get('call_master_department');

        $sched_type = Cache::get('call_master_paf_schedule_type');

        $project_assignment = Cache::get('call_master_company');

        $employment_status = Cache::get('call_contract_change');

        //Get paf details
        $get_paf_details = PersonnelActionManagement::get_paf_request($form);

        $get_job_details = PersonnelActionManagement::get_paf_job_detail($form); 

        $get_schedule_details = PersonnelActionManagement::get_paf_schedule_detail($form); 

        $get_compensation_details = PersonnelActionManagement::get_paf_compensation_detail($form); 

        $get_current_job_details = PersonnelActionManagement::get_current_paf_job_detail($form);

        $get_current_schedule_details = PersonnelActionManagement::get_current_paf_schedule_detail($form);

        $get_current_compensation_details = PersonnelActionManagement::get_current_paf_compensation_detail($form);

        $get_hr_assessment_details = PersonnelActionManagement::get_hr_assessment_detail($form);

        //Get employee details
        $employee_name = PersonnelActionManagement::get_employee_info($get_paf_details->employee_company_id);

        $employee_contract = PersonnelActionManagement::get_employee_contract($employee_name->id);

        if($get_paf_details->masterPafSubStatus->id == '3'){
    	   return view('paf.mpaf.showrequest', compact('employee_contract', 'form', 'employee_name', 'employment_status', 'jobTitles', 'department', 'sched_type', 'project_assignment', 'get_job_details', 'get_schedule_details', 'get_compensation_details', 'reportTo', 'sched_type', 'get_paf_details', 'get_status', 'get_sub_status', 'get_current_job_details', 'get_current_schedule_details', 'get_current_compensation_details', 'get_hr_assessment_details', 'proj_assignment'));
		}else{
    	   return view('paf.mpaf.readrequest', compact('employee_contract', 'form', 'employee_name', 'employment_status', 'jobTitles', 'department', 'sched_type', 'project_assignment', 'get_job_details', 'get_schedule_details', 'get_compensation_details', 'reportTo', 'sched_type', 'get_paf_details', 'get_current_job_details', 'get_current_schedule_details', 'get_current_compensation_details', 'get_hr_assessment_details'));
        }
    }

    public function store(Request $request, $form)
    {

        $validator = $request->validate([
            'employment_status' => 'exists:master_contract_change_pafs,key|required',
            'remarks'=>'required|string|max:191',
            'proposed_job_title' => 'nullable|string|max:191',
            'proposed_department' => 'nullable|string|max:191',
            'proposed_team' => 'nullable|string|max:191',
            'proposed_supervisor' => 'nullable|string|max:191',
            'proposed_project_assignment' => 'nullable|string|max:191',
            'proposed_schedule' => 'nullable|string|max:191',
            'proposed_work_location' => 'nullable|string|max:191',
            'proposed_job_grade' => 'nullable|string|max:191',
            'proposed_base_salary' => 'nullable|numeric|digits_between:0,10',
            'proposed_bonus_allowance' => 'nullable|string|max:191',
            'proposed_benefits' => 'nullable|string|max:191',
            'request_status' => 'exists:statuses,id|required',
            'sub_request_status' => 'exists:sub_statuses,id|required',
       ]);

        $form_update = PersonnelActionManagement::get_paf_request($form);  

        $form_update->master_key_employment_status = $request->input('employment_status');

        $form_update->remarks = $request->input('remarks');

        $form_update->master_id_request_status = $request->input('request_status');

        $form_update->master_id_sub_request_status = $request->input('sub_request_status');

        $form_update->save();

        $job_update = PersonnelActionManagement::get_paf_job_detail($form); 

        $job_update->proposed_key_job_title = $request->input('proposed_position_title');

        $job_update->proposed_key_department = $request->input('proposed_department');

        $job_update->proposed_key_team = $request->input('proposed_team');

        $job_update->proposed_key_supervisor = $request->input('proposed_supervisor');

        $job_update->proposed_key_project_assignment = $request->input('proposed_project_assignment');

        $job_update->save();

        $sched_update = PersonnelActionManagement::get_paf_schedule_detail($form); 

        $sched_update->proposed_key_schedule = $request->input('proposed_schedule');

        $sched_update->proposed_key_work_location = $request->input('proposed_work_location');

        $sched_update->save(); 

        $compensation_update = PersonnelActionManagement::get_paf_compensation_detail($form);

        $compensation_update->proposed_key_job_grade = $request->input('proposed_job_grade');

        $compensation_update->proposed_base_salary = $request->input('proposed_base_salary');
        
        $compensation_update->proposed_bonus_allowance = $request->input('proposed_bonus_allowance');

        $compensation_update->proposed_benefits = $request->input('proposed_benefits');

        $compensation_update->save();

    	return redirect(route('paf.reassess.list', [date('m'), date('Y')]))->with('success', 'Request form updated');
    }
}

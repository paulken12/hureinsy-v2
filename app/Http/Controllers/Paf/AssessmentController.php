<?php

namespace App\Http\Controllers\Paf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Role;
use App\Personnel\Info\EmpBasic;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;
use App\Helper\Paf\PersonnelActionManagement;

class AssessmentController extends Controller
{

    public function list($month, $year)
    {

        Cache::forever('call_paf_lists_hr', PersonnelActionManagement::call_paf_lists($month, $year));

        $requestList = Cache::get('call_paf_lists_hr');       

        $archives = Cache::get('call_paf_lists_archived');

        return view('paf.hpaf.list', compact('requestList', 'archives', 'count_archives'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($form)
    {  

        Cache::forget('call_paf_lists_hr');

        $user_role= Auth::user()->roles->first();

        //Get HR Assessment masters
        $proficiency = Cache::get('call_master_paf_proficiency_test_paf');
        
        $behaviour = Cache::get('call_master_paf_behavioural_assessment');
        
        $evaluation = Cache::get('call_master_paf_performance_evaluation');
        
        $overall = Cache::get('call_master_paf_overall_recommendation');

        //Get Master details
        $jobTitles = Cache::get('call_master_job_title');
        
        $department = Cache::get('call_master_department');

        $project_assignment = Cache::get('call_master_company');

        //Get Paf details
        $get_paf_details = PersonnelActionManagement::get_paf_request($form);

        $get_job_details = PersonnelActionManagement::get_paf_job_detail($form); 

        $get_schedule_details = PersonnelActionManagement::get_paf_schedule_detail($form); 

        $get_compensation_details = PersonnelActionManagement::get_paf_compensation_detail($form); 

        $get_current_job_details = PersonnelActionManagement::get_current_paf_job_detail($form);

        $get_current_schedule_details = PersonnelActionManagement::get_current_paf_schedule_detail($form);

        $get_current_compensation_details = PersonnelActionManagement::get_current_paf_compensation_detail($form);

        $get_hr_assessment_details = PersonnelActionManagement::get_hr_assessment_detail($form);

        //Get Employee details
        $employee_name = PersonnelActionManagement::get_employee_info($get_paf_details->employee_company_id);

        $employee_contract = PersonnelActionManagement::get_employee_contract($employee_name->id);

        //Get Statuses
        $request_status = $user_role->status;

        $sub_request_status = $user_role->sub_status;

        if($get_paf_details->masterPafSubStatus->id == '1'){

            return view('paf.hpaf.pending', compact('jobTitles', 'department', 'project_assignment', 'employee_contract', 'form', 'employee_name', 'get_job_details', 'request_status', 'sub_request_status', 'user_role', 'get_schedule_details', 'get_compensation_details', 'get_paf_details', 'get_current_job_details', 'get_current_schedule_details', 'get_current_compensation_details', 'get_hr_assessment_details', 'proficiency', 'behaviour', 'evaluation', 'overall'));

        }else{

            return view('paf.hpaf.readpending',compact('jobTitles', 'department', 'project_assignment', 'employee_contract', 'form', 'employee_name', 'get_job_details', 'user_role', 'get_schedule_details', 'get_compensation_details', 'get_paf_details', 'get_current_job_details', 'get_current_schedule_details', 'get_current_compensation_details', 'get_hr_assessment_details'));
        }

    }

    public function assessment(Request $request, $form)
    {
        $request->validate([
            'proposed_remarks_job' => 'max:255|required_with:proposed_job_title,proposed_department,proposed_team,proposed_supervisor,proposed_project_assignment',
            'proposed_remarks_schedule' => 'max:255|required_with:proposed_schedule,proposed_work_location',
            'proposed_remarks_compensation' => 'max:255|required_with:proposed_job_grade,proposed_base_salary,proposed_bonus_allowance,proposed_benefits',
            'proficiency_test' => 'required_with:emp|exists:master_proficiency_test_pafs,key',
            'behavioural_assessment' => 'required_with:emp|exists:master_behavioural_assessment_pafs,key',
            'performance_evaluation' => 'required_with:emp|exists:master_performance_evaluation_pafs,key',
            'other_remarks' => 'string|nullable',
            'overall_recommendation' => 'required_with:emp|exists:master_overall_recommendation_pafs,key',
            'request_status' => 'required|exists:statuses,id',
            'sub_request_status' => 'required|exists:sub_statuses,id',
        ],
        [
            'proficiency_test.required_with' => 'Proficiency test is required under hr assessment',
            'behavioural_assessment.required_with' => 'behavioural assessment is required under hr assessment',
            'performance_evaluation.required_with' => 'performance evaluation is required under hr assessment',
            'overall_recommendation.required_with' => 'overall recommendation is required under hr assessment',
            'proposed_remarks_job.required_with' => 'You need to fill out remarks on change in job title, duties, and responsibilities details field.',
            'proposed_remarks_schedule.required_with' => 'You need to fill out remarks on change in Work schedule details field.',
            'proposed_remarks_compensation.required_with' => 'You need to fill out remarks on change in compensation and benefit details field.',

        ]);

        $form_update = PersonnelActionManagement::get_paf_request($form);

        $form_update->master_id_request_status = $request->input('request_status');

        $form_update->master_id_sub_request_status = $request->input('sub_request_status');

        $form_update->assessed_by_company_id = Auth::user()->basicInfo->pluck('id')->first();

        $form_update->save();

        $job_update = PersonnelActionManagement::get_paf_job_detail($form); 

        $job_update->proposed_remarks_hr = $request->input('proposed_remarks_job');

        $job_update->save();

        $sched_update =  PersonnelActionManagement::get_paf_schedule_detail($form); 

        $sched_update->proposed_remarks_hr = $request->input('proposed_remarks_schedule');

        $sched_update->save(); 

        $compensation_update = PersonnelActionManagement::get_paf_compensation_detail($form); 

        $compensation_update->proposed_remarks_hr = $request->input('proposed_remarks_compensation');

        $compensation_update->save();

        $hr_assessment_update = PersonnelActionManagement::get_hr_assessment_detail($form);

        $hr_assessment_update->key_proficiency_test = $request->input('proficiency_test');

        $hr_assessment_update->key_behavioural_assessment = $request->input('behavioural_assessment');

        $hr_assessment_update->key_performance_evaluation = $request->input('performance_evaluation');

        $hr_assessment_update->other_remarks = $request->input('other_remarks');
 
        $hr_assessment_update->key_overall_recommendation = $request->input('overall_recommendation');

        $hr_assessment_update->save();   

        return redirect(route('paf.assessment.list', [date('m'), date('Y')]))->with('success', 'Request form updated');
    }

}

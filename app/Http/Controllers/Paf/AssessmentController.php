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

        //Get Master details
        $jobTitles = Cache::get('call_master_job_title');
        
        $department = Cache::get('call_master_department');

        $project_assignment = Cache::get('call_master_company');

        //Get Paf details
        $get_paf_details = PersonnelActionManagement::get_paf_request($form);

        $get_job_details = PersonnelActionManagement::get_paf_job_detail($form); 

        $get_schedule_details = PersonnelActionManagement::get_paf_schedule_detail($form); 

        $get_compensation_details = PersonnelActionManagement::get_paf_compensation_detail($form); 

        //Get Employee details
        $employee_name = PersonnelActionManagement::get_employee_info($get_paf_details->employee_company_id);

        $manager_name = PersonnelActionManagement::get_employee_info($get_paf_details->requested_by_company_id);

        $hr_name = PersonnelActionManagement::get_employee_info($get_paf_details->assessed_by_company_id);

        $exec_name = PersonnelActionManagement::get_employee_info($get_paf_details->approved_by_company_id);

        $employee_contract = PersonnelActionManagement::get_employee_contract($employee_name->id);

        //Get Statuses
        $request_status = $user_role->status;

        if($get_schedule_details->proposed_key_schedule_type == 'emp'){
            $sub_request_status = $user_role->sub_status;
        }else{
            $sub_request_status = $user_role->sub_status->whereNotIn('id', '4');
        }


        if($get_paf_details->masterPafSubStatus->id == '1'){

            return view('paf.hpaf.pending', compact('jobTitles', 'department', 'project_assignment', 'employee_contract', 'form', 'employee_name', 'manager_name', 'get_job_details', 'request_status', 'sub_request_status', 'user_role', 'get_schedule_details', 'get_compensation_details', 'get_paf_details'));

        }else{

            return view('paf.hpaf.readpending',compact('jobTitles', 'department', 'project_assignment', 'employee_contract', 'form', 'employee_name', 'manager_name', 'get_job_details', 'user_role', 'get_schedule_details', 'get_compensation_details', 'get_paf_details', 'hr_name', 'employee_name', 'exec_name'));
        }

    }

    public function assessment(Request $request)
    {
        $request->validate([
            'proposed_remarks_job' => 'max:255|required_with:proposed_department,proposed_reportto,proposed_position_title,proposed_project_assignment',
            'proposed_remarks_schedule' => 'max:255|required_with:proposed_days_of_work,proposed_work_hours_per_week,proposed_type_of_shift,proposed_work_hours_per_day,proposed_work_location,sched_type',
            'proposed_remarks_compensation' => 'max:255|required_with:proposed_salary,proposed_bonus_allowance,proposed_benefits',
            'request_status' => 'exists:statuses,id|required',
            'sub_request_status' => 'exists:sub_statuses,id|required',
        ],
        [
            'proposed_remarks_job.required_with' => 'You need to fill out remarks on change in job title, duties, and responsibilities details field.',
            'proposed_remarks_schedule.required_with' => 'You need to fill out remarks on change in Work schedule details field.',
            'proposed_remarks_compensation.required_with' => 'You need to fill out remarks on change in compensation and benefit details field.',

        ]);

        $form_update = PersonnelActionManagement::get_paf_request($request->input('req_id'));

        $form_update->master_id_request_status = $request->input('request_status');

        $form_update->master_id_sub_request_status = $request->input('sub_request_status');

        $form_update->assessed_by_company_id = EmpBasic::where('user_id', Auth::user()->id)->first()->company_id;

        $form_update->save();

        $job_update = PersonnelActionManagement::get_paf_job_detail($request->input('req_id')); 

        $job_update->proposed_remarks_hr = $request->input('proposed_remarks_job');

        $job_update->save();

        $sched_update =  PersonnelActionManagement::get_paf_schedule_detail($request->input('req_id')); 

        $sched_update->proposed_remarks_hr = $request->input('proposed_remarks_schedule');

        $sched_update->save(); 

        $compensation_update = PersonnelActionManagement::get_paf_compensation_detail($request->input('req_id')); 

        $compensation_update->proposed_remarks_hr = $request->input('proposed_remarks_compensation');

        $compensation_update->save();

        return redirect(route('paf.assessment.list', [date('m'), date('Y')]))->with('success', 'Request form updated');
    }

}

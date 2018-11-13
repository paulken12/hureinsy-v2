<?php

namespace App\Http\Controllers\Paf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Personnel\Info\EmpBasic;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;
use App\Helper\Paf\PersonnelActionManagement;

class ApprovalController extends Controller
{
    public function list($month, $year)
    {

        Cache::forever('call_paf_lists_exec', PersonnelActionManagement::call_paf_lists($month, $year));

        $requestList = Cache::get('call_paf_lists_exec');

        $archives = Cache::get('call_paf_lists_archived');    

        return view('paf.epaf.list', compact('requestList', 'archives'));
    }

    public function show($form){

        Cache::forget('call_paf_lists_exec');

        //Get Master details
        $jobTitles = Cache::get('call_master_job_title');
        
        $department = Cache::get('call_master_department');

        $project_assignment = Cache::get('call_master_company');

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

        $employee_team = PersonnelActionManagement::get_employee_team($employee_name->myTeam());

        //Get Status details.
        $user_role= Auth::user()->roles->first();

        $request_status = $user_role->status;

        $sub_request_status = $user_role->sub_status;

        if($get_paf_details->masterPafSubStatus->id == '2'){

            return view('paf.epaf.approval', compact('jobTitles', 'department', 'project_assignment', 'employee_contract', 'form', 'employee_name', 'get_job_details', 'request_status', 'sub_request_status', 'user_role', 'get_schedule_details', 'get_compensation_details', 'get_paf_details', 'get_current_job_details', 'get_current_schedule_details', 'get_current_compensation_details', 'get_hr_assessment_details', 'employee_team'));

        }else{

            return view('paf.epaf.readapproval',compact('jobTitles', 'department', 'project_assignment', 'employee_contract', 'form', 'get_job_details', 'user_role', 'get_schedule_details', 'get_compensation_details', 'get_paf_details', 'employee_name', 'get_current_job_details', 'get_current_schedule_details', 'get_current_compensation_details', 'get_hr_assessment_details', 'employee_team'));
        }

    }


    public function store(Request $request, $form)
    {
        $validation = $request->validate([
            'proposed_remarks_job_exec' => 'max:255|required_with:proposed_job_title,proposed_department,proposed_team,proposed_supervisor,proposed_project_assignment',
            'proposed_remarks_schedule_exec' => 'max:255|required_with:proposed_schedule,proposed_work_location',
            'proposed_remarks_compensation_exec' => 'max:255|required_with:proposed_job_grade,proposed_base_salary,proposed_bonus_allowance,proposed_benefits',
            'request_status' => 'exists:statuses,id|required',
            'sub_request_status' => 'exists:sub_statuses,id|required',
        ],
        [
            'proposed_remarks_job_exec.required_with' => 'You need to fill out remarks on change in job title, duties, and responsibilities details field.',
            'proposed_remarks_schedule_exec.required_with' => 'You need to fill out remarks on change in Work schedule details field.',
            'proposed_remarks_compensation_exec.required_with' => 'You need to fill out remarks on change in compensation and benefit details field.',

        ]);

        $form_update = PersonnelActionManagement::get_paf_request($form);

        $form_update->master_id_request_status = $request->input('request_status');

        $form_update->master_id_sub_request_status = $request->input('sub_request_status');

        $form_update->approved_by_company_id = EmpBasic::where('user_id', Auth::user()->id)->first()->id;

        if($request->input('sub_request_status') == '5'){
            $form_update->date_effective =$request->input('date_effective');
        }

        $form_update->save();

        $job_update = PersonnelActionManagement::get_paf_job_detail($form); 

        $job_update->proposed_remarks_exec = $request->input('proposed_remarks_job_exec');

        $job_update->save();

        $sched_update = PersonnelActionManagement::get_paf_schedule_detail($form); 

        $sched_update->proposed_remarks_exec = $request->input('proposed_remarks_schedule_exec');

        $sched_update->save(); 

        $compensation_update = PersonnelActionManagement::get_paf_compensation_detail($form); 

        $compensation_update->proposed_remarks_exec = $request->input('proposed_remarks_compensation_exec');

        $compensation_update->save();

        return redirect(route('paf.approval.list', [date('m'), date('Y')]))->with('success', 'Request form updated');
    }
}

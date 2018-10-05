<?php

namespace App\Http\Controllers\Paf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Paf\PafManagement;
use App\Paf\PafChangeJob;
use App\Paf\PafChangeSchedule;
use App\Paf\PafChangeCompensation;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;
use App\Helper\Paf\PersonnelActionManagement;

class RequestController extends Controller
{

    public function index()
    {  

        return view('paf.mpaf.search');
        
    }

    public function search(Request $request)
    {        

        $employee_info = PersonnelActionManagement::get_employee_info($request->input('raj_id'));  

        if (empty($employee_info)) {

            return redirect(route('paf.search'))->with('error', 'Mismatched identity, Try again.');

        }else{

            return redirect(route('paf.search.result.show', $employee_info->company_id));
        
        }
    }


    public function show($emplid)
    {   

        $jobTitles = PersonnelActionManagement::call_master_job_title();

        $department = PersonnelActionManagement::call_master_department();

        $project_assignment = PersonnelActionManagement::call_master_company();

        $employment_status = PersonnelActionManagement::call_master_employment_status();

        $sched_type = PersonnelActionManagement::call_master_paf_schedule_type();

        $reportTo = PersonnelActionManagement::call_user();

        $employee_info = PersonnelActionManagement::get_employee_info($emplid);  

        $employee_contract = PersonnelActionManagement::get_employee_contract($employee_info->id);

        return view('paf.mpaf.request', compact('employee_contract','employee_info', 'employment_status', 'department', 'reportTo', 'jobTitles', 'project_assignment', 'sched_type'));
        
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'employment_status' => 'exists:master_emp_statuses,key|required',
            'remarks'=>'required|string|max:191',
            'proposed_department' => 'nullable|string|max:191',
            'proposed_department' => 'nullable|string|max:191',
            'proposed_reportto' => 'nullable|string|max:191',
            'proposed_position_title' => 'nullable|string|max:191',
            'proposed_project_assignment' => 'nullable|string|max:191',
            'proposed_days_of_work' => 'nullable|numeric|digits_between:0,10',
            'proposed_work_hours_per_week' => 'nullable|numeric|digits_between:0,10',
            'proposed_type_of_shift' => 'nullable|string|max:191',
            'proposed_work_hours_per_day' => 'nullable|numeric|digits_between:0,10',
            'proposed_work_location' => 'nullable|string|max:191',
            'sched_type' => 'nullable|string|max:191',
            'proposed_salary' => 'nullable|numeric|digits_between:0,10',
            'proposed_bonus_allowance' => 'nullable|string|max:191',
            'proposed_benefits' => 'nullable|string|max:191',
       ]);

        $user = Auth::user()->basicInfo->pluck('company_id')->first();

        $request_id = PafManagement::create([

            'employee_company_id' => $request->input('raj_id'),

            'master_key_employment_status' => $request->input('employment_status'),

            'requested_by_company_id' => $user,

            'remarks' => $request->input('remarks'),

            'master_id_request_status' => '1',

            'master_id_sub_request_status' => '1',

        ]);

        PafChangeJob::create([

            'request_id' => $request_id->id,

            'proposed_key_department' => $request->input('proposed_department'),

            'proposed_reports_to' => $request->input('proposed_reportto'),

            'proposed_key_position_title' => $request->input('proposed_position_title'),

            'proposed_key_project_assignment' => $request->input('proposed_project_assignment'),
        ]);

        PafChangeSchedule::create([

            'request_id' => $request_id->id,

            'proposed_days_of_work' => $request->input('proposed_days_of_work'),

            'proposed_work_hours_per_week' => $request->input('proposed_work_hours_per_week'),

            'proposed_type_of_shift' => $request->input('proposed_type_of_shift'),

            'proposed_work_hours_per_day' => $request->input('proposed_work_hours_per_day'),

            'proposed_work_location' => $request->input('proposed_work_location'),

            'proposed_key_schedule_type' => $request->input('sched_type'),
        ]);

        PafChangeCompensation::create([

            'request_id' => $request_id->id,

            'proposed_salary' => $request->input('proposed_salary'),

            'proposed_bonus_allowance' => $request->input('proposed_bonus_allowance'),

            'proposed_benefits' => $request->input('proposed_benefits'),

        ]);

        return redirect(route('paf.search'))->with('success', 'Request complete, your request will be sent to the hr.');
    }
}


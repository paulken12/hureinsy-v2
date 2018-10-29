<?php

namespace App\Http\Controllers\Paf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Paf\PafManagement;
use App\Paf\PafChangeJob;
use App\Paf\PafChangeSchedule;
use App\Paf\PafChangeCompensation;
use App\Paf\PafCurrentJob;
use App\Paf\PafCurrentSchedule;
use App\Paf\PafCurrentCompensation;
use App\Paf\PafHrAssessment;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;
use App\Helper\Paf\PersonnelActionManagement;

class RequestController extends Controller
{

    public function index()
    {  

        $employee_info = Cache::get('call_emp_info');
//->where('reporting_to', Auth::user()->basicInfo->pluck('id')->first())
        return view('paf.mpaf.search', compact('employee_info'));
        
    }

    public function show($emplid)
    {

        Cache::forever('get_employee_info', PersonnelActionManagement::get_employee_info($emplid));   

        $jobTitles = Cache::get('call_master_job_title');

        $department = Cache::get('call_master_department');

        $project_assignment = Cache::get('call_master_company');

        $employment_status = Cache::get('call_contract_change');

        $sched_type = Cache::get('call_master_paf_schedule_type');

        $reportTo = Cache::get('call_user');

        $employee_name = Cache::get('get_employee_info');  

        $employee_contract = PersonnelActionManagement::get_employee_contract($employee_name->id);

        return view('paf.mpaf.request', compact('employee_contract','employee_name', 'employment_status', 'department', 'reportTo', 'jobTitles', 'project_assignment', 'sched_type'));
        
    }

    public function create($form)
    {

        $user = Auth::user()->basicInfo->pluck('id')->first();

        $request_id = PafManagement::create([

            'employee_company_id' => $form,

            'requested_by_company_id' => $user,

            'remarks' => 'Emergency request by the manager respond asap',

            'comfirmation_flag' => 0,

            'master_id_request_status' => '1',

            'master_id_sub_request_status' => '1',

        ]);

        PafChangeJob::create([

            'request_id' => $request_id->id,

        ]);

        PafCurrentJob::create([

            'request_id' => $request_id->id,

        ]);

        PafChangeSchedule::create([

            'request_id' => $request_id->id,

        ]);

        PafCurrentSchedule::create([

            'request_id' => $request_id->id,

        ]);

        PafChangeCompensation::create([

            'request_id' => $request_id->id,

        ]);
        
        PafCurrentCompensation::create([

            'request_id' => $request_id->id,


        ]);

        PafHrAssessment::create([

            'request_id' => $request_id->id,

        ]);

        return redirect(route('paf.search'))->with('success', 'Request complete, your request will be sent to the hr.');


    }

    public function store(Request $request, $form)
    {
        $validator = $request->validate([
            'employment_status' => 'required|exists:master_contract_change_pafs,key',
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
        ]);

        $user = Auth::user()->basicInfo->pluck('id')->first();

        $request_id = PafManagement::create([

            'employee_company_id' => $form,

            'master_key_employment_status' => $request->input('employment_status'),

            'requested_by_company_id' => $user,

            'remarks' => $request->input('remarks'),

            'comfirmation_flag' => 0,

            'master_id_request_status' => '1',

            'master_id_sub_request_status' => '1',

        ]);

        PafChangeJob::create([

            'request_id' => $request_id->id,

            'proposed_key_job_title' => $request->input('proposed_job_title'),

            'proposed_key_department' => $request->input('proposed_department'),

            'proposed_key_team' => $request->input('proposed_team'),

            'proposed_key_supervisor' => $request->input('proposed_supervisor'),

            'proposed_key_project_assignment' => $request->input('proposed_project_assignment'),
        ]);

        PafCurrentJob::create([

            'request_id' => $request_id->id,

            'current_key_job_title' => $request->input('current_job_title'),

            'current_key_department' => $request->input('current_department'),

            'current_key_team' => $request->input('current_team'),

            'current_key_supervisor' => $request->input('current_supervisor'),

            'current_key_project_assignment' => $request->input('current_project_assignment'),
        ]);

        PafChangeSchedule::create([

            'request_id' => $request_id->id,

            'proposed_key_schedule' => $request->input('proposed_schedule'),

            'proposed_key_work_location' => $request->input('proposed_work_location'),
        ]);

        PafCurrentSchedule::create([

            'request_id' => $request_id->id,

            'current_key_schedule' => $request->input('current_schedule'),

            'current_key_work_location' => $request->input('current_work_location'),
        ]);

        PafChangeCompensation::create([

            'request_id' => $request_id->id,

            'proposed_key_job_grade' => $request->input('proposed_job_grade'),

            'proposed_base_salary' => $request->input('proposed_base_salary'),

            'proposed_bonus_allowance' => $request->input('proposed_bonus_allowance'),

            'proposed_benefits' => $request->input('proposed_benefits'),

        ]);
        
        PafCurrentCompensation::create([

            'request_id' => $request_id->id,

            'current_key_job_grade' => $request->input('current_job_grade'),

            'current_base_salary' => $request->input('current_base_salary'),

            'current_bonus_allowance' => $request->input('current_bonus_allowance'),

            'current_benefits' => $request->input('current_benefits'),

        ]);

        PafHrAssessment::create([

            'request_id' => $request_id->id,

        ]);

        return redirect(route('paf.search'))->with('success', 'Request complete, your request will be sent to the hr.');
    }
}


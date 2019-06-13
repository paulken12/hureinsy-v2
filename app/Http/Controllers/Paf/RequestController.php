<?php

namespace App\Http\Controllers\Paf;

use App\User;
use App\Team;
use App\Annex\JobDescription\AnnexJobDescription;
use App\Annex\Schedule\AnnexSchedule;
use App\Annex\Compensation\AnnexCompensation;
use App\Contract\Job;
use App\Contract\Project;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;
use App\Master\MasterCompany;
use App\Master\MasterContractChangePaf;
use App\Master\MasterDepartment;
use App\Master\MasterEmpStatus;
use App\Master\MasterScheduleTypePaf;
use App\Paf\PafChangeJob;
use App\Paf\PafChangeSchedule;
use App\Paf\PafChangeCompensation;
use App\Paf\PafCurrentJob;
use App\Paf\PafCurrentSchedule;
use App\Paf\PafCurrentCompensation;
use App\Paf\PafHrAssessment;
use App\Paf\PafManagement;
use App\Personnel\Info\EmpBasic;
use App\Personnel\Info\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class RequestController extends Controller
{

    public function index()
    {  
        $employee = Contract::orderBy('id')->get();
        $annex_a = AnnexJobDescription::orderBy('id')->get();
        $annex_b = AnnexSchedule::orderBy('id')->get();
        $annex_c = AnnexCompensation::orderBy('id')->get();
        $cchange = MasterContractChangePaf::all();

        //annex a
        $mjob = Job::all();
        $mdept = MasterDepartment::all();
        $mpro = Project::all();
        $memp = EmpBasic::all();
        $mtea = Team::all();
        $msta = MasterEmpStatus::all();

        //annex b
        $mcomp = MasterCompany::all();

        return view('paf.mpaf.search', compact('employee', 'annex_a', 'annex_b', 'annex_c', 'mjob', 'mdept', 'mpro', 'memp', 'mtea', 'mcomp', 'msta', 'cchange'));
        
    }

    public function store(Request $request)
    {
        $paf = $request->validate([
            'emp_id' => 'required',
            'proposed_effective_date' => 'required',
            'employment_status' => 'required',
            'cont_change' => 'nullable',
            'contract_start' => 'nullable',
            'contract_end' => 'nullable',
            'resignation_date' => 'nullable',
            'remarks' => 'required',

            'job_description' => 'nullable',
            'department' => 'nullable',
            'team' => 'nullable',
            'reporting_to' => 'nullable',
            'project' => 'nullable',
            
            'company' => 'nullable',
            'schedule_type' => 'nullable',
            
            'job_grade' => 'nullable',
            'probationary_rate' => 'nullable',
            'gross_salary' => 'nullable',
            'basic_salary' => 'nullable',
            'other_bonus_allowance' => 'nullable',
            'other_benefits' => 'nullable',

            'current_job_description' => 'nullable',
            'current_department' => 'nullable',
            'current_team' => 'nullable',
            'current_reporting_to' => 'nullable',
            'current_project' => 'nullable',

            'current_company' => 'nullable',
            'current_schedule_type' => 'nullable',

            'current_job_grade' => 'nullable',
            'current_probationary_rate' => 'nullable',
            'current_gross_salary' => 'nullable',
            'current_basic_salary' => 'nullable',
            'current_other_bonus_allowance' => 'nullable',
            'current_other_benefits' => 'nullable',
        ]);

        $user = Auth::user()->basicInfo->pluck('id')->first();

        if($paf['employment_status'] == 'eoc' || $paf['employment_status'] == 'snr'){
            $cc = 'separated';
        }else if($paf['employment_status'] == 'ttp'){
            $cc = 'project-based';
        }else if($paf['employment_status'] == 'reg' || $paf['employment_status'] == 'ptr'){
            $cc = 'regular';
        }else{
            $cc = $paf['cont_change'];
        }

        $request_id = PafManagement::create([

            'employee_company_id' => $paf['emp_id'],

            'master_key_employment_status' => $paf['employment_status'],

            'master_key_change_of_contract' => $cc,

            'requested_by_company_id' => $user,

            'remarks' => $paf['remarks'],

            'comfirmation_flag' => 0,

            'master_id_request_status' => '1',

            'master_id_sub_request_status' => '1',

            'date_effective' => $paf['proposed_effective_date'],

            'contract_start' => $paf['contract_start'],
            
            'contract_end' => $paf['contract_end'],

            'resigned_date' => $paf['resignation_date'],

            'application_flag' => 0,

        ]);

        PafChangeJob::create([

            'request_id' => $request_id->id,

            'proposed_key_job_title' => $paf['job_description'],

            'proposed_key_department' => $paf['department'],

            'proposed_key_team' => $paf['team'],

            'proposed_key_supervisor' => $paf['reporting_to'],

            'proposed_key_project_assignment' => $paf['project'],
        ]);

        PafCurrentJob::create([

            'request_id' => $request_id->id,

            'current_key_job_title' => $paf['current_job_description'],

            'current_key_department' => $paf['current_department'],

            'current_key_team' => $paf['current_team'],

            'current_key_supervisor' => $paf['current_reporting_to'],

            'current_key_project_assignment' => $paf['current_project'],
        ]);

        PafChangeSchedule::create([

            'request_id' => $request_id->id,

            'proposed_key_schedule' => $paf['schedule_type'],

            'proposed_key_work_location' => $paf['company'],
        ]);

        PafCurrentSchedule::create([

            'request_id' => $request_id->id,

            'current_key_schedule' => $paf['current_schedule_type'],

            'current_key_work_location' => $paf['current_company'],
        ]);

        PafChangeCompensation::create([

            'request_id' => $request_id->id,

            'proposed_key_job_grade' => $paf['job_grade'],

            'proposed_probi_rate' => $paf['probationary_rate'],

            'proposed_gross_salary' => $paf['gross_salary'],

            'proposed_basic_salary' => $paf['basic_salary'],

            'proposed_bonus_allowance' => $paf['other_bonus_allowance'],

            'proposed_benefits' => $paf['other_benefits'],

        ]);
        
        PafCurrentCompensation::create([

            'request_id' => $request_id->id,

            'current_key_job_grade' => $paf['current_job_grade'],

            'current_probi_rate' => $paf['current_probationary_rate'],

            'current_gross_salary' => $paf['current_gross_salary'],

            'current_basic_salary' => $paf['current_basic_salary'],

            'current_bonus_allowance' => $paf['current_other_bonus_allowance'],

            'current_benefits' => $paf['current_other_benefits'],

        ]);

        PafHrAssessment::create([

            'request_id' => $request_id->id,

        ]);

        $request_id->rq_id = $request_id->scopeLastId();

        $request_id->save();

        return ['mes' => 'PAF form requested.'];
    }
}


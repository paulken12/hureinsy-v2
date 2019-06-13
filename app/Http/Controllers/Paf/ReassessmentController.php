<?php

namespace App\Http\Controllers\Paf;

use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;
use App\Personnel\Info\EmpBasic;
use App\Master\MasterBehaviouralAssessmentPaf;
use App\Master\MasterProficiencyTestPaf;
use App\Master\MasterOverallRecommendationPaf;
use App\Master\MasterPerformanceEvaluationPaf;
use App\Master\MasterContractChangePaf;
use App\Master\MasterCompany;
use App\Master\MasterDepartment;
use App\Master\MasterEmpStatus;
use App\Master\MasterScheduleTypePaf;
use App\Paf\PafChangeCompensation;
use App\Paf\PafChangeJob;
use App\Paf\PafChangeSchedule;
use App\Paf\PafHrAssessment;
use App\Paf\PafManagement;
use App\Contract\Job;
use App\Contract\Project;
use App\Role;
use App\Status;
use App\SubStatus;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ReassessmentController extends Controller
{
    public function list()
    {
        $auth_id = Auth::user()->basicInfo->pluck('id')->first();
        $list = PafManagement::whereNotIn('master_id_sub_request_status', [1, 2])
                       ->where('requested_by_company_id', $auth_id)  
                       ->get();
        $employees = EmpBasic::all();
        $cchange = MasterContractChangePaf::all();
        $substatus = SubStatus::all();

        //annex a
        $mjob = Job::all();
        $mdept = MasterDepartment::all();
        $mpro = Project::all();
        $memp = EmpBasic::all();
        $mtea = Team::all();
        $msta = MasterEmpStatus::all();

        //annex b
        $mcomp = MasterCompany::all();
    	return view('paf.mpaf.list', compact('list', 'employees', 'cchange', 'substatus', 'mjob', 'mdept', 'mpro', 'memp', 'mtea', 'msta', 'mcomp'));
    }

    public function show($id){
        $emp = PafManagement::where('id', $id)->first();

        $response = [ 
            'data' => [
                'job_description' => !$emp->annexa->proposed_key_job_title ?
                            '' : $emp->annexa->proposed_key_job_title,  

                'department' => !$emp->annexa->proposed_key_department ?
                            '' : $emp->annexa->proposed_key_department, 
                
                'team' => !$emp->annexa->proposed_key_team ?
                            '' : $emp->annexa->proposed_key_team, 

                'reporting_to' => !$emp->annexa->proposed_key_supervisor ?
                            '' : $emp->annexa->proposed_key_supervisor,

                'project' => !$emp->annexa->proposed_key_project_assignment ?
                            '' : $emp->annexa->proposed_key_project_assignment,

                'company' => !$emp->annexb->proposed_key_work_location ?
                            '' : $emp->annexb->proposed_key_work_location,

                'schedule_type' => $emp->annexb->proposed_key_schedule,
                'job_grade' => $emp->annexc->proposed_key_job_grade,
                'probationary_rate' => $emp->annexc->proposed_probi_rate,
                'gross_salary' => $emp->annexc->proposed_gross_salary,
                'basic_salary' => $emp->annexc->proposed_basic_salary,
                'other_bonus_allowance' => $emp->annexc->proposed_bonus_allowance,
                'other_benefits' => $emp->annexc->proposed_benefits,

                'current_job_description' => !$emp->current_annexa->current_key_job_title ? 
                    'No Job' : 
                    $emp->current_annexa->masterJobTitle->job_title .' '.  $emp->current_annexa->masterJobTitle->job_description,

                'current_department' => !$emp->current_annexa->current_key_department ? 
                    'No Department' : 
                    $emp->current_annexa->masterDepartment->department,

                'current_team' => !$emp->current_annexa->current_key_team ? 
                    'No Team' : 
                    $emp->current_annexa->empTeam->display_name,
                
                'current_reporting_to' => !$emp->current_annexa->current_key_supervisor ? 
                    'No Reporting To' : 
                    $emp->current_annexa->empBasic->last_name .', '. $emp->current_annexa->empBasic->first_name,
                
                'current_project' => !$emp->current_annexa->current_key_project_assignment ? 
                    'No Project' : 
                    $emp->current_annexa->masterProjectAssignment->project_title,

                'current_company' => !$emp->current_annexb->current_key_work_location ? 
                    'No Work Location' : 
                    $emp->current_annexb->masterCompany->name,
                'current_schedule_type' => $emp->current_annexb->current_key_schedule,
                'current_job_grade' => $emp->current_annexc->current_key_job_grade,
                'current_probationary_rate' => $emp->current_annexc->current_probi_rate,
                'current_gross_salary' => $emp->current_annexc->current_gross_salary,
                'current_basic_salary' => $emp->current_annexc->current_basic_salary,
                'current_other_bonus_allowance' => $emp->current_annexc->current_bonus_allowance, 
                'current_other_benefits' => $emp->current_annexc->current_benefits,

                'beh' => !$emp->paf_hr->key_behavioural_assessment ?
                    'No Behavioural Assessment' :
                    $emp->paf_hr->masterBehavioural->behaviour,
                
                'pro' => !$emp->paf_hr->key_proficiency_test ?
                    'No Proficiency Assessment' :
                    $emp->paf_hr->masterProficiency->proficiency,
                
                'ove' => !$emp->paf_hr->key_overall_recommendation ?
                    'No Overall Assessment' :
                    $emp->paf_hr->masterOverall->overall,
                
                'per' => !$emp->paf_hr->key_performance_evaluation ?
                    'No Performance Assessment' :
                    $emp->paf_hr->masterEvaluation->evaluation,
                
                'rem' => !$emp->paf_hr->other_remarks ?
                    'No Remarks' :
                    $emp->paf_hr->other_remarks,

                'a' => !$emp->annexa->proposed_remarks_hr ?
                    'No Remarks' :
                    $emp->annexa->proposed_remarks_hr,
                
                'b' => !$emp->annexb->proposed_remarks_hr ?
                    'No Remarks' :
                    $emp->annexb->proposed_remarks_hr,
                
                'c' => !$emp->annexc->proposed_remarks_hr ?
                    'No Remarks' :
                    $emp->annexc->proposed_remarks_hr,

                'ea' => !$emp->annexa->proposed_remarks_exec ?
                    'No Remarks' :
                    $emp->annexa->proposed_remarks_exec,
                
                'eb' => !$emp->annexb->proposed_remarks_exec ?
                    'No Remarks' :
                    $emp->annexb->proposed_remarks_exec,
                
                'ec' => !$emp->annexc->proposed_remarks_exec ?
                    'No Remarks' :
                    $emp->annexc->proposed_remarks_exec,
                ]
            ];
            
        return response()->json($response);
    }

    public function store(Request $request, $id)
    {

        $paf = $validator = $request->validate([            
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

            'status' => 'required',
            'substatus' => 'required',
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

        $form_update = PafManagement::find($id);

        $form_update->master_key_employment_status = $paf['employment_status'];

        $form_update->master_key_change_of_contract = $cc;

        $form_update->remarks = $paf['remarks'];

        $form_update->master_id_request_status = $paf['status'];

        $form_update->master_id_sub_request_status = $paf['substatus'];

        $form_update->date_effective = $paf['proposed_effective_date'];
        
        $form_update->contract_start = $paf['contract_start'];
        
        $form_update->contract_end = $paf['contract_end'];
        
        $form_update->resigned_date = $paf['resignation_date'];
        
        $form_update->save();

        $job_update = PafChangeJob::where('request_id', $id)->first(); 

        $job_update->proposed_key_job_title = $paf['job_description'];

        $job_update->proposed_key_department = $paf['department'];

        $job_update->proposed_key_team = $paf['team'];

        $job_update->proposed_key_supervisor = $paf['reporting_to'];

        $job_update->proposed_key_project_assignment = $paf['project'];

        $job_update->save();

        $sched_update = PafChangeSchedule::where('request_id', $id)->first();

        $sched_update->proposed_key_schedule = $paf['schedule_type'];

        $sched_update->proposed_key_work_location = $paf['company'];

        $sched_update->save(); 

        $compensation_update = PafChangeCompensation::where('request_id', $id)->first();

        $compensation_update->proposed_key_job_grade = $paf['job_grade'];

        $compensation_update->proposed_probi_rate = $paf['probationary_rate'];

        $compensation_update->proposed_basic_salary = $paf['basic_salary'];

        $compensation_update->proposed_gross_salary = $paf['gross_salary'];
        
        $compensation_update->proposed_bonus_allowance = $paf['other_bonus_allowance'];

        $compensation_update->proposed_benefits = $paf['other_benefits'];

        $compensation_update->save();

        return ['mes' => 'PAF form updated.'];
    }
}

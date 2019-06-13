<?php

namespace App\Http\Controllers\Paf;

use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;
use App\Personnel\Info\EmpBasic;
use App\Master\MasterContractChangePaf;
use App\Paf\PafManagement;
use App\Status;
use App\SubStatus;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserPafController extends Controller
{
   public function list()
    {
        $auth_id = Auth::user()->basicInfo->pluck('id')->first();

        $list = PafManagement::where('master_id_sub_request_status', 5)
                       ->where('employee_company_id', $auth_id)
                       ->get();
        $employees = EmpBasic::all();
        $cchange = MasterContractChangePaf::all();
        $substatus = SubStatus::all();

        return view('paf.upaf.list', compact('list', 'employees', 'cchange', 'substatus'));
    }

    public function show($id){
       
        $emp = PafManagement::where('id', $id)->first();

        $response = [ 
            'data' => [
                'job_description' => !$emp->annexa->proposed_key_job_title ? 
                    'No Job' : 
                    $emp->annexa->masterJobTitle->job_title .' '.  $emp->annexa->masterJobTitle->job_description,

                'department' => !$emp->annexa->proposed_key_department ? 
                    'No Department' : 
                    $emp->annexa->masterDepartment->department,

                'team' => !$emp->annexa->proposed_key_team ? 
                    'No Team' : 
                    $emp->annexa->empTeam->display_name,

                'reporting_to' => !$emp->annexa->proposed_key_supervisor ? 
                    'No Reporting To' : 
                    $emp->annexa->empBasic->last_name .', '. $emp->annexa->empBasic->first_name,
                
                'project' => !$emp->annexa->proposed_key_project_assignment ? 
                    'No Project' : 
                    $emp->annexa->masterProjectAssignment->project_title,

                'company' => !$emp->annexb->proposed_key_work_location ? 
                    'No Work Location' : 
                    $emp->annexb->masterCompany->name,

                'schedule_type' => !$emp->annexb->proposed_key_schedule ? 
                    'No Schedule' : 
                    $emp->annexb->proposed_key_schedule,

                'job_grade' => !$emp->annexc->proposed_key_job_grade ? 
                    'No Job Grade' : 
                    $emp->annexc->proposed_key_job_grade,
                
                'probationary_rate' => !$emp->annexc->proposed_probi_rate ? 
                    'No Probationary Rate' : 
                    $emp->annexc->proposed_probi_rate,
                
                'gross_salary' => !$emp->annexc->proposed_gross_salary ? 
                    'No Gross Salary' : 
                    $emp->annexc->proposed_gross_salary,
                
                'basic_salary' => !$emp->annexc->proposed_basic_salary ? 
                    'No Basic Salary' : 
                    $emp->annexc->proposed_basic_salary,
                
                'other_bonus_allowance' => !$emp->annexc->proposed_bonus_allowance ? 
                    'No Allowance' : 
                    $emp->annexc->proposed_bonus_allowance, 
                
                'other_benefits' => !$emp->annexc->proposed_benefits ? 
                    'No Benefits' : 
                    $emp->annexc->proposed_benefits,

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
            ]
        ];
        return response()->json($response);
    }

    public function store($id){

        $get_paf_details = PafManagement::find($id);

        $get_paf_details->comfirmation_flag = 1;

        $get_paf_details->save();
        
        return ['mes' => 'PAF form confirmed.'];

    }

}

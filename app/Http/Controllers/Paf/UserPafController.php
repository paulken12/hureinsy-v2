<?php

namespace App\Http\Controllers\Paf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;
use App\Helper\Paf\PersonnelActionManagement;

class UserPafController extends Controller
{
   public function list($month, $year)
    {

        Cache::forever('call_paf_lists_user', PersonnelActionManagement::call_paf_lists_user($month, $year));

        $requestList = Cache::get('call_paf_lists_user');

        $archives =  Cache::get('call_paf_lists_archived');   

        $get_employee = Cache::get('call_emp_info');

        return view('paf.upaf.list', compact('requestList', 'archives', 'get_employee'));
    
    }

    public function show($form){

        Cache::forget('call_paf_lists_user');

        //Get Master details
        $jobTitles = PersonnelActionManagement::call_master_job_title();
        
        $department = PersonnelActionManagement::call_master_department();

        $project_assignment = PersonnelActionManagement::call_master_company();

        //Get paf details
        $get_paf_details = PersonnelActionManagement::get_paf_request($form);

        $get_job_details = PersonnelActionManagement::get_paf_job_detail($form); 

        $get_schedule_details = PersonnelActionManagement::get_paf_schedule_detail($form); 

        $get_compensation_details = PersonnelActionManagement::get_paf_compensation_detail($form); 

        //Get employee details
        $employee_name = PersonnelActionManagement::get_employee_info($get_paf_details->employee_company_id);

        $manager_name = PersonnelActionManagement::get_employee_info($get_paf_details->requested_by_company_id);

        $hr_name = PersonnelActionManagement::get_employee_info($get_paf_details->assessed_by_company_id);

        $exec_name = PersonnelActionManagement::get_employee_info($get_paf_details->approved_by_company_id);

        $employee_contract = PersonnelActionManagement::get_employee_contract($employee_name->id);
        
        //Get Status details.
        $user_role= Auth::user()->roles->first();

        $request_status = $user_role->status;

        $sub_request_status = $user_role->sub_status;

            return view('paf.upaf.readpaf',compact('jobTitles', 'department', 'project_assignment', 'employee_contract', 'form', 'employee_name', 'manager_name', 'get_job_details', 'user_role', 'get_schedule_details', 'get_compensation_details', 'get_paf_details', 'hr_name', 'employee_name', 'exec_name'));
        }
}

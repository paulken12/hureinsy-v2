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

        return view('paf.upaf.list', compact('requestList', 'archives'));
    
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

        $get_current_job_details = PersonnelActionManagement::get_current_paf_job_detail($form);

        $get_current_schedule_details = PersonnelActionManagement::get_current_paf_schedule_detail($form);

        $get_current_compensation_details = PersonnelActionManagement::get_current_paf_compensation_detail($form);

        //Get employee details
        $employee_name = PersonnelActionManagement::get_employee_info($get_paf_details->employee_company_id);

        $employee_contract = PersonnelActionManagement::get_employee_contract($employee_name->id);
        
        $employee_team = PersonnelActionManagement::get_employee_team($employee_name->myTeam());

        //Get Status details.
        $user_role= Auth::user()->roles->first();

        $request_status = $user_role->status;

        $sub_request_status = $user_role->sub_status;

            return view('paf.upaf.readpaf',compact('jobTitles', 'department', 'project_assignment', 'employee_contract', 'form', 'employee_name', 'get_job_details', 'user_role', 'get_schedule_details', 'get_compensation_details', 'get_paf_details', 'get_current_job_details', 'get_current_schedule_details', 'get_current_compensation_details', 'employee_team'));
        }

    public function store($form){

        $get_paf_details = PersonnelActionManagement::get_paf_request($form);

        $get_paf_details->comfirmation_flag = 1;

        $get_paf_details->save();

        return redirect(route('paf.myrequest.list', [date('m'), date('Y')]))->with('success', 'Your PAF reuqest is confirmed');
    }

}

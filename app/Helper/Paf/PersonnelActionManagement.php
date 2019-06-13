<?php

namespace App\Helper\Paf;
 
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Team;
use App\Attendance\SILManagement;
use App\Contract\Job;
use App\Contract\Project;
use App\Paf\PafChangeJob;
use App\Paf\PafManagement;
use App\Paf\PafHrAssessment;
use App\Personnel\Info\EmpBasic;
use App\Personnel\Info\Contract;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\RoleController;

class PersonnelActionManagement {

    public static function count_complete_user(){
        return PafManagement::where('master_id_sub_request_status', '5')
                            ->where('employee_company_id', Auth::user()->basicInfo->pluck('id')->first())
                            ->where('comfirmation_flag', '0')
                            ->count();
    }    

    public static function count_open_hr(){
        $user_id = Auth::user()->basicInfo->pluck('id')->first();
        return PafManagement::where('master_id_sub_request_status', '1')
                            ->where('assessed_by_company_id', $user_id)
                            ->orWhere('assessed_by_company_id', '')
                            ->orWhereNull('assessed_by_company_id')
                            ->count();
    }
    
    public static function count_open_exec(){
        return PafManagement::where('master_id_sub_request_status', '2')
                            ->count();
    }

    public static function count_open_man(){
        return PafManagement::where('master_id_sub_request_status', '3')
                            ->where('requested_by_company_id', Auth::user()->basicInfo->pluck('id')->first())
                            ->count();
    }

    public static function contractChange(){
        $change = PafManagement::whereDate('date_effective', '<=', date('Y-m-d'))
                              ->where('master_id_sub_request_status', 5)
                              ->where('comfirmation_flag', 1)
                              ->where('application_flag', 0)
                              ->get();  

        foreach ($change as $changes) {
            $contract = Contract::where('emp_basic_id', $changes->empBasicInfo->id)->first();

            $contract->job_date_effective = $changes->date_effective;    
            $contract->schedule_date_effective = $changes->date_effective;      
            $contract->compensation_date_effective = $changes->date_effective;     

            if(!empty($changes->master_key_change_of_contract)){
                $contract->employment_status = $changes->master_key_change_of_contract;
            }
            if(!empty($changes->contract_start)){
                $contract->contract_start = $changes->contract_start;
            }
            if(!empty($changes->contract_end)){
                $contract->contract_end = $changes->contract_end;
            }     
            if(!empty($changes->resigned_date)){
                $contract->resigned_date = $changes->resigned_date;
            }   
            if($changes->master_key_employment_status == 'reh' || $changes->master_key_employment_status == 'sfr'){
                $contract->join_date = $changes->contract_start;
            }

            $contract->save();

            if(!empty($changes->annexa->proposed_key_job_title)){
                $contract->jobDescription->job_description_id = $changes->annexa->proposed_key_job_title;
            }
            if(!empty($changes->annexa->proposed_key_department)){
                $contract->jobDescription->department_key = $changes->annexa->proposed_key_department;
            }
            if(!empty($changes->annexa->proposed_key_team)){
                $contract->jobDescription->team_id = $changes->annexa->proposed_key_team;
            }
            if(!empty($changes->annexa->proposed_key_supervisor)){
                $contract->jobDescription->reporting_to = $changes->annexa->proposed_key_supervisor;
            }
            if(!empty($changes->annexa->proposed_key_project_assignment)){
                $contract->jobDescription->project_id = $changes->annexa->proposed_key_project_assignment;
            }

            $contract->jobDescription->save();

            if(!empty($changes->annexb->proposed_key_schedule)){
                $contract->schedule->schedule_type = $changes->annexb->proposed_key_schedule;
            }
            if(!empty($changes->annexb->proposed_key_work_location)){
                $contract->schedule->work_location_key = $changes->annexb->proposed_key_work_location;
            }

            $contract->schedule->save();

            if(!empty($changes->annexc->proposed_key_job_grade)){
                $contract->compensation->job_grade = $changes->annexc->proposed_key_job_grade;
            }
            if(!empty($changes->annexc->proposed_probi_rate)){
                $contract->compensation->probationary_rate = $changes->annexc->proposed_probi_rate;
            }
            if(!empty($changes->annexc->proposed_basic_salary)){
                $contract->compensation->basic_salary = $changes->annexc->proposed_basic_salary;
            }
            if(!empty($changes->annexc->proposed_gross_salary)){
                $contract->compensation->gross_salary = $changes->annexc->proposed_gross_salary;
            }
            if(!empty($changes->annexc->proposed_bonus_allowance)){
                $contract->compensation->other_bonus_allowance = $changes->annexc->proposed_bonus_allowance;
            }
            if(!empty($changes->annexc->proposed_benefits)){
                $contract->compensation->other_benefits = $changes->annexc->proposed_benefits;
            }
            if($changes->master_key_change_of_contract == 'probationary'){
                $contract->compensation->is_probationary = '1';
            }else{
                $contract->compensation->is_probationary = '0';
            }

            $contract->compensation->save();
            
            $changes->application_flag = '1';     
            
            $changes->save();     

        }
    }

    public static function addSIL(){
        $sil = SILManagement::pluck('emp_id');
    
        $con = Contract::whereNotIn('emp_basic_id', $sil)
                       ->whereDay('join_date', '=', date('d'))
                       ->whereMonth('join_date', '=', date('m'))
                       ->get();

        foreach($con as $emp){
            SILManagement::create([
                'emp_id' => $emp->emp_basic_id,
                'man' => 24,
                'add' => 0,
                'update_flag' => 0,
                'updated_flag' => 0,
            ]);
        }
    }

    public static function updateSIL(){
        $sil = SILManagement::whereDay('created_at', '=', date('d'))
                            ->whereMonth('created_at', '=', date('m'))
                            ->where('update_flag', 0)
                            ->get();

        foreach($sil as $upd){
            $upd->update_flag = 1;
            $upd->updated_flag = 1;
            $upd->save();
        }

    }
    public static function resetSIL(){
        $sil = SILManagement::where('update_flag', 1)
                            ->where('updated_flag', 0)
                            ->get();

        foreach($sil as $upd){
            if(date('m-d',strtotime($upd->created_at)) != date('m-d')){
                $upd->update_flag = 0;
                $upd->save();
            }
        }

    }

}
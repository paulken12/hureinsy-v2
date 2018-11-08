<?php
        
namespace App\Helper\Paf;

use Illuminate\Support\Facades\Cache;
use App\Helper\Paf\PersonnelActionManagement;

class CacheHelper{
	
	public static function create_master_cache(){

                Cache::forever('call_user', PersonnelActionManagement::call_user());

                Cache::forever('call_emp_info', PersonnelActionManagement::call_emp_info());        

                Cache::forever('call_master_company', PersonnelActionManagement::call_master_company());

                Cache::forever('call_master_job_title', PersonnelActionManagement::call_master_job_title());

                Cache::forever('call_master_project_assignment', PersonnelActionManagement::call_master_project_assignment());

                Cache::forever('call_master_department', PersonnelActionManagement::call_master_department());
                
                Cache::forever('call_master_paf_behavioural_assessment', PersonnelActionManagement::call_master_paf_behavioural_assessment());

                Cache::forever('call_master_paf_overall_recommendation', PersonnelActionManagement::call_master_paf_overall_recommendation());

                Cache::forever('call_master_paf_performance_evaluation', PersonnelActionManagement::call_master_paf_performance_evaluation());

                Cache::forever('call_master_paf_proficiency_test_paf', PersonnelActionManagement::call_master_paf_proficiency_test_paf());

                Cache::forever('call_master_paf_schedule_type', PersonnelActionManagement::call_master_paf_schedule_type());

                Cache::forever('call_contract_change', PersonnelActionManagement::call_contract_change());

                Cache::forever('call_contract', PersonnelActionManagement::call_contract());

                Cache::forever('call_paf_lists_archived', PersonnelActionManagement::call_paf_archived());

                Cache::forever('call_paf', PersonnelActionManagement::call_paf());

	}

}
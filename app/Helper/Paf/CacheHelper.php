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

        Cache::forever('call_master_department', PersonnelActionManagement::call_master_department());
        
        Cache::forever('call_master_paf_schedule_type', PersonnelActionManagement::call_master_paf_schedule_type());
        
        Cache::forever('call_master_employment_status', PersonnelActionManagement::call_master_employment_status());

        Cache::forever('call_contract', PersonnelActionManagement::call_contract());

        Cache::forever('call_paf_lists_archived', PersonnelActionManagement::call_paf_archived());

	}

}
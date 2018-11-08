<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;
use App\Master\MasterDepartment;
use App\Master\MasterJobTitle;
use App\Contract\Job;
use App\Contract\Project;
use App\User;

class PafChangeJob extends Model
{
    protected $table = 'paf_change_jobs';
    protected $guarded = [];
    
 	function natureOfAction() 
 	{
        return $this->belongsTo(PafManagement::class, 'request_id');
    }
    public function masterDepartment()
    {
        return $this->belongsTo(MasterDepartment::class, 'proposed_key_department');
    } 
    public function user() 
    {
        return $this->belongsTo(User::class,'proposed_reports_to');
    }
    public function masterJobTitle()
    {
        return $this->belongsTo(Job::class, 'proposed_key_job_title');
    }
    public function masterProjectAssignment()
    {
        return $this->belongsTo(Project::class, 'proposed_key_project_assignment');
    }	
}

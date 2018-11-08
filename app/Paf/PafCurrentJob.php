<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;
use App\Master\MasterDepartment;
use App\Master\MasterJobTitle;
use App\Contract\Job;
use App\Contract\Project;
use App\User;       

class PafCurrentJob extends Model
{
    protected $table = 'paf_current_jobs';
    protected $guarded = [];
    
 	function natureOfAction() 
 	{
        return $this->belongsTo(PafManagement::class, 'request_id');
    }
    public function masterDepartment()
    {
        return $this->belongsTo(MasterDepartment::class, 'current_key_department');
    } 
    public function user() 
    {
        return $this->belongsTo(User::class,'current_key_supervisor');
    }
    public function masterJobTitle()
    {
        return $this->belongsTo(Job::class, 'current_key_job_title');
    }
    public function masterProjectAssignment()
    {
        return $this->belongsTo(Project::class, 'current_key_project_assignment');
    }   
}

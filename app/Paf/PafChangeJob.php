<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;
use App\Master\MasterDepartment;
use App\Master\MasterJobTitle;
use App\Contract\Job;
use App\Contract\Project;
use App\Personnel\Info\EmpBasic;
use App\User;
use App\Team;

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
    public function empBasic() 
    {
        return $this->belongsTo(EmpBasic::class,'proposed_key_supervisor');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'proposed_key_supervisor');
    }
    public function masterJobTitle()
    {
        return $this->belongsTo(Job::class, 'proposed_key_job_title');
    }
    public function masterProjectAssignment()
    {
        return $this->belongsTo(Project::class, 'proposed_key_project_assignment');
    }   
    public function empTeam()
    {
        return $this->belongsTo(Team::class, 'proposed_key_team');
    }   
}

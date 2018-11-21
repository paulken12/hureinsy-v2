<?php

namespace App\Annex\JobDescription;
use App\Contract\Job;
use App\Contract\Project;
use App\Master\MasterDepartment;
use App\Personnel\Info\EmpBasic;
use App\Team;
use Illuminate\Database\Eloquent\Model;

class AnnexJobDescription extends Model
{
   protected $guarded = [];

    public function department() {
        return $this->belongsTo(MasterDepartment::class, 'department_key');
	}

    public function job(){
    	return $this->belongsTo(Job::class, 'job_description_id');
    }

    public function project(){
    	return $this->belongsTo(Project::class, 'project_id');
    }

    public function reportingTo(){
    	return $this->belongsTo(EmpBasic::class, 'reporting_to');
    }

    public function team(){
    	return $this->belongsTo(Team::class, 'team_id');
    }
}

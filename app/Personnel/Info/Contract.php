<?php

namespace App\Personnel\Info;

use App\Annex\JobDescription\AnnexJobDescription;
use App\Annex\Schedule\AnnexSchedule;
use App\Annex\Compensation\AnnexCompensation;
use App\Contract\Job;
use App\Contract\Project;
use App\Master\MasterCompany;
use App\Master\MasterDepartment;
use App\Master\MasterEmpStatus;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $guarded = [];

    public function basicInfo()
    {
        return $this->belongsTo(EmpBasic::class, 'emp_basic_id');
    }

    public function jobDescription() {
        return $this->belongsTo(AnnexJobDescription::class, 'job_id');
    }

    public function schedule() {
        return $this->belongsTo(AnnexSchedule::class, 'schedule_id');
    }

    public function compensation() {
        return $this->belongsTo(AnnexCompensation::class, 'compensation_id');
    }

    public function jobs() {
        return $this->belongsTo(Job::class,'job_id');
    }

    public function job() {
        return $this->belongsToMany(Job::class)->withPivot('job_id', 'project_id');
    }

    public function project() {
        return $this->jobs->projects->where('id',$this->basicInfo->id)->first();
    }

    public function status() {
        return $this->belongsTo(MasterEmpStatus::class,'employment_status');
    }

    public function updateProject($project)
    {
        return $this->jobs->projects()->attach($this->id,['project_id' => $project ]);
    }
    
    public function attachProject($job, $project) {
        $job_desc = Job::find($job);
        return $job_desc->projects()->attach($project);
    }

    public function empStatus() {
        return $this->employment_status->first();
    }

    public function scopeActiveEmp() {
        return Contract::where('employment_status','!=' ,'separated')->get()->count();
    }

    public function scopeResignedEmp() {
        return Contract::where('employment_status', 'separated')->get()->count();
    }

    public function scopeRegularEmp() {
        return Contract::where('employment_status', 'regular')->get()->count();
    }

    public function scopeProjectBasedEmp() {
        return Contract::where('employment_status', 'project-based')->get()->count();
    }

    public function scopeProbationaryEmp() {
        return Contract::where('employment_status', 'probationary')->get()->count();
    }

}

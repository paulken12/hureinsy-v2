<?php

namespace App\Personnel\Info;

use App\Annex\JobDescription\AnnexJobDescription;
use App\Contract\Job;
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

    public function jobs() {
        return $this->belongsTo(Job::class,'job_id');
    }

    public function project() {
        return $this->jobs->projects->where('id',$this->basicInfo->id)->first();
    }

    public function status() {
        return $this->belongsTo(MasterEmpStatus::class,'employment_status');
    }

}

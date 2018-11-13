<?php

namespace App\Contract;

use App\Master\MasterCompany;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $dates = ['project_start','project_end'];

    public function jobs()
    {
        return $this->belongsToMany(Job::class)->withPivot('job_id', 'project_id');
    }

    public function company() {
        return $this->belongsTo(MasterCompany::class,'master_company_key');
    }
}

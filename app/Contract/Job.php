<?php

namespace App\Contract;

use App\Master\MasterDepartment;
use App\Personnel\Info\EmpBasic;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    public function basicInfo()
    {
        return $this->belongsToMany(EmpBasic::class);
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('job_id', 'project_id');
    }

    public function department()
    {
        return $this->belongsTo(MasterDepartment::class, 'master_department_key');
    }

}

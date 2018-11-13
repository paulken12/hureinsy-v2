<?php

namespace App\Contract;

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
}

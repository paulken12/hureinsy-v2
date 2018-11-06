<?php

namespace App\Contract;

use App\Master\MasterDepartment;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function department()
    {
        return $this->belongsTo(MasterDepartment::class, 'master_department_key');
    }

}

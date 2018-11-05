<?php

namespace App\Annex\JobDescription;

use App\Master\MasterDepartment;
use Illuminate\Database\Eloquent\Model;

class AnnexJobDescription extends Model
{
   protected $guarded = [];

    public function jobDepartment() {
        return $this->belongsTo(MasterDepartment::class, 'master_department_key');
    }
}

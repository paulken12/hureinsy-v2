<?php

namespace App\Personnel\Info;

use App\Master\MasterJobTitle;
use Illuminate\Database\Eloquent\Model;

class EmpExperience extends Model
{
    protected $guarded = [];

    public function basicInfo()
    {
        return $this->belongsTo(EmpBasic::class);
    }

    public function title() {
        return $this->belongsTo(MasterJobTitle::class, 'master_job_title_key');
    }
}

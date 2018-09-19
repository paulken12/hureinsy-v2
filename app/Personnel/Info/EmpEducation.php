<?php

namespace App\Personnel\Info;

use App\Master\MasterEducationType;
use Illuminate\Database\Eloquent\Model;

class EmpEducation extends Model
{
    protected $guarded = [];

    public function basicInfo()
    {
        return $this->belongsTo(EmpBasic::class);
    }

    public function background() {
        return $this->belongsTo(MasterEducationType::class, 'master_education_key');
    }

    public function getBackgroundAttribute() {
        return  $this->background()->pluck('educational_level')->first();
    }
}

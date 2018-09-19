<?php

namespace App\Personnel\Info;

use App\Master\MasterBloodType;
use Illuminate\Database\Eloquent\Model;

class EmpMedical extends Model
{
    protected $guarded = [];

    public function basicInfo()
    {
        return $this->belongsTo(EmpBasic::class);
    }

    public function bloodType() {
        return $this->belongsTo(MasterBloodType::class, 'master_blood_key');
    }

    public function getBloodTypeAttribute() {
        return  $this->bloodType()->pluck('blood_type')->first();
    }
}

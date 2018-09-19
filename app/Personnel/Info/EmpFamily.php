<?php

namespace App\Personnel\Info;

use App\Master\MasterFamilyType;
use App\Master\MasterGender;
use Illuminate\Database\Eloquent\Model;

class EmpFamily extends Model
{
    protected $guarded = [];

    public function basicInfo()
    {
        return $this->belongsTo(EmpBasic::class);
    }

    public function gender() {
        return $this->belongsTo(MasterGender::class, 'master_gender_key');
    }

    public function getGenderAttribute() {
        return  $this->gender()->pluck('gender')->first();
    }

    public function family() {
        return $this->belongsTo(MasterFamilyType::class, 'master_family_key');
    }

    public function getFamilyAttribute() {
        return  $this->family()->pluck('family_type')->first();
    }

}

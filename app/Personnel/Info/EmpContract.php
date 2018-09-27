<?php

namespace App\Personnel\Info;

use Illuminate\Database\Eloquent\Model;

class EmpContract extends Model
{
    protected $guarded = [];

    public function basicInfo()
    {
        return $this->belongsTo(EmpBasic::class);
    }

    public function scopeActiveEmp() {
        return EmpContract::where('employment_status','!=' ,'resigned')->get()->count();
    }

    public function scopeResignedEmp() {
        return EmpContract::where('employment_status', 'resigned')->get()->count();
    }

    public function scopeRegularEmp() {
        return EmpContract::where('employment_status', 'regular')->get()->count();
    }

    public function scopeProjectBasedEmp() {
        return EmpContract::where('employment_status', 'project-based')->get()->count();
    }
}

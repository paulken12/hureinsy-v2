<?php

namespace App\Personnel\Info;

use App\Master\MasterCompany;
use App\Master\MasterEmpStatus;
use App\Master\MasterJobTitle;
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



//    public function position() {
//        return  MasterJobTitle::findOrFail($this->master_job_title_id)->get()->pluck('job_titles')->first();
//
//    }

    public function position() {
        return $this->belongsTo(MasterJobTitle::class, 'master_job_title_id');
    }

    public function status() {
        return $this->belongsTo(MasterEmpStatus::class, 'employment_status');
    }

    public function assignment() {
        return $this->belongsTo(MasterCompany::class, 'master_company_key');
    }

    public function getPositionAttribute() {
        return  $this->position()->pluck('job_titles')->first();
    }

    public function getFullPositionAttribute() {
        return "{$this->position()->pluck('job_titles')->first()} {$this->position()->pluck('description')->first()}";
    }

    public function getAssignmentAttribute() {
        return  $this->assignment()->pluck('name')->first();
    }

    public function getStatusAttribute() {
        return  $this->status()->pluck('employee_status')->first();
    }
}

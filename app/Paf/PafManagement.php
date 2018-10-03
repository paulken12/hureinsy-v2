<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Master\MasterEmpStatus;
use App\Personnel\Info\EmpBasic;
use App\Status;
use App\SubStatus;

class PafManagement extends Model
{
    protected $table = 'paf_managements';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'employee_company_id';
    }
    public function basicInfo()
    {
        return $this->belongsTo(EmpBasic::class, 'employee_company_id');
    } 
    function proposedChangeJobDetail() 
    {
        return $this->hasMany(PafChangeJob::class);
    }
    function proposedChangeCompensationDetail() 
    {
        return $this->hasMany(PafChangeCompensation::class);
    }
    function proposedChangeScheduleDetail() 
    {
        return $this->hasMany(PafChangeSchedule::class);
    }
    public function masterPafStatus()
    {
        return $this->belongsTo(Status::class, 'master_id_request_status');
    } 
    public function masterPafSubStatus()
    {
        return $this->belongsTo(SubStatus::class, 'master_id_sub_request_status');
    } 
    public function employmentStatus() 
    {
        return $this->belongsTo(MasterEmpStatus::class, 'master_key_employment_status');
    }
    public function scopeRequest(){
        return $this->where('requested_by_company_id', Auth::user()->basicInfo->pluck('company_id')->first())->paginate(10);
    } 

}

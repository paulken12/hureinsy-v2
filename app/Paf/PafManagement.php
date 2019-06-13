<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Master\MasterContractChangePaf;
use App\Master\MasterEmpStatus;
use App\Personnel\Info\EmpBasic;
use App\Paf\PafHrAssessment;
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

    public function empBasicInfo()
    {
        return $this->belongsTo(EmpBasic::class, 'employee_company_id');
    }

    public function manBasicInfo()
    {
        return $this->belongsTo(EmpBasic::class, 'requested_by_company_id');
    }

    public function humBasicInfo()
    {
        return $this->belongsTo(EmpBasic::class, 'assessed_by_company_id');
    }

    public function exeBasicInfo()
    {
        return $this->belongsTo(EmpBasic::class, 'approved_by_company_id');
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

    public function contractChange() 
    {
        return $this->belongsTo(MasterContractChangePaf::class, 'master_key_employment_status');
    }

    public function cc() 
    {
        return $this->belongsTo(MasterEmpStatus::class, 'master_key_change_of_contract');
    }

    public function annexa()
    {
        return $this->belongsTo(PafChangeJob::class, 'id');
    }
    
    public function annexb()
    {
        return $this->belongsTo(PafChangeSchedule::class, 'id');
    }
    
    public function annexc()
    {
        return $this->belongsTo(PafChangeCompensation::class, 'id');
    }

    public function current_annexa()
    {
        return $this->belongsTo(PafCurrentJob::class, 'id');
    }
    
    public function current_annexb()
    {
        return $this->belongsTo(PafCurrentSchedule::class, 'id');
    }
    
    public function current_annexc()
    {
        return $this->belongsTo(PafCurrentCompensation::class, 'id');
    }

    public function paf_hr()
    {
        return $this->belongsTo(PafHrAssessment::class, 'id');
    }

    public function scopeLastId() {

        $req_id = PafManagement::orderBy('rq_id','desc')->first();
        return $req_id->rq_id + 1;
    
    }
}

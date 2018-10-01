<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;
use App\Master\MasterDepartment;
use App\Master\MasterJobTitle;
use App\Master\MasterCompany;
use App\User;

class PafChangeJob extends Model
{
    protected $table = 'paf_change_jobs';
    protected $guarded = [];
    
 	function natureOfAction() 
 	{
        return $this->belongsTo(PafManagement::class, 'request_id');
    }
    public function masterDepartment()
    {
        return $this->belongsTo(MasterDepartment::class, 'proposed_key_department');
    } 
    public function user() 
    {
        return $this->belongsTo(User::class,'proposed_reports_to');
    }
    public function masterJobTitle()
    {
        return $this->belongsTo(MasterJobTitle::class, 'proposed_key_position_title');
    }
    public function masterCompany()
    {
        return $this->belongsTo(MasterCompany::class, 'proposed_key_project_assignment');
    }	
}

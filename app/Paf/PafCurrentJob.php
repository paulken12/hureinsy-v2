<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;
use App\Master\MasterDepartment;
use App\Master\MasterJobTitle;
use App\User;

class PafCurrentJob extends Model
{
    protected $table = 'paf_current_jobs';
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
        return $this->belongsTo(MasterJobTitle::class, 'proposed_key_job_title');
    }	
}

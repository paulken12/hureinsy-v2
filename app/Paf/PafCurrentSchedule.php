<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;
use App\Master\MasterScheduleTypePaf;
use App\Master\MasterCompany;

class PafCurrentSchedule extends Model
{
    protected $table = 'paf_current_schedules';
    protected $guarded = [];
    
 	function natureOfAction() 
 	{
        return $this->belongsTo(PafManagement::class, 'request_id');
    }    
 	function schedType() 
 	{
        return $this->belongsTo(MasterScheduleTypePaf::class, 'current_key_schedule');
    }
    public function masterCompany()
    {
        return $this->belongsTo(MasterCompany::class, 'current_key_work_location');
    }
}

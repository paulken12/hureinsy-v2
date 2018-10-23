<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PafHrAssessment extends Model
{
    protected $table = 'paf_hr_assessments';
    protected $guarded = [];
    
 	function natureOfAction() 
 	{
        return $this->belongsTo(PafManagement::class);
    }
}
<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;

class PafChangeCompensation extends Model
{ 
	protected $table = 'paf_change_compensations';
    protected $guarded = [];
    
 	function natureOfAction() 
 	{
        return $this->belongsTo(PafManagement::class);
    }
}

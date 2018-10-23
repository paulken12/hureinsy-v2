<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;

class PafCurrentCompensation extends Model
{
	protected $table = 'paf_current_compensations';
    protected $guarded = [];

 	function natureOfAction() 
 	{
        return $this->belongsTo(PafManagement::class);
    }
}

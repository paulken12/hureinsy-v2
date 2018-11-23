<?php

namespace App\Annex\Schedule;

use App\Master\MasterCompany;
use Illuminate\Database\Eloquent\Model;

class AnnexSchedule extends Model
{
   protected $guarded = [];

   public function company()
   {
       return $this->belongsTo(MasterCompany::class, 'work_location_key');
   }
}

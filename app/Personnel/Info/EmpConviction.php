<?php

namespace App\Personnel\Info;

use Illuminate\Database\Eloquent\Model;

class EmpConviction extends Model
{
    protected $guarded = [];

    public function basicInfo()
    {
        return $this->belongsTo(EmpBasic::class);
    }
}

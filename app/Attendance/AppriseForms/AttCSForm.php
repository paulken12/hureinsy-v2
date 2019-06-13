<?php

namespace App\Attendance\AppriseForms;

use Illuminate\Database\Eloquent\Model;
use App\Personnel\Info\EmpBasic;

class AttCSForm extends Model
{
    protected $table = 'att_c_s_forms';
    protected $guarded = [];

    public function empName()
    {
        return $this->belongsTo(EmpBasic::class, 'employee_id');
    }
}

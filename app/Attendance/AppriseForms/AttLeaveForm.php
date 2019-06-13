<?php

namespace App\Attendance\AppriseForms;

use App\Personnel\Info\EmpBasic;
use Illuminate\Database\Eloquent\Model;

class AttLeaveForm extends Model
{
    protected $table = 'att_leave_forms';
    protected $guarded = [];

    public function empBasicInfo()
    {
        return $this->belongsTo(EmpBasic::class, 'employee_id');
    }
}

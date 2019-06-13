<?php

namespace App\Attendance\AppriseForms;

use Illuminate\Database\Eloquent\Model;
use App\Personnel\Info\EmpBasic;

class AttTVForm extends Model
{
    protected $table = 'att_t_v_forms';
    protected $guarded = [];

    public function empName()
    {
        return $this->belongsTo(EmpBasic::class, 'employee_id');
    }
}

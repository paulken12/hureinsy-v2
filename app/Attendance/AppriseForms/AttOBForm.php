<?php

namespace App\Attendance\AppriseForms;

use Illuminate\Database\Eloquent\Model;
use App\Personnel\Info\EmpBasic;

class AttOBForm extends Model
{
    protected $table = 'att_o_b_forms';
    protected $guarded = [];

    public function empName()
    {
        return $this->belongsTo(EmpBasic::class, 'employee_id');
    }
}

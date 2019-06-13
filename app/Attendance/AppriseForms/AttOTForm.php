<?php

namespace App\Attendance\AppriseForms;

use Illuminate\Database\Eloquent\Model;
use App\Personnel\Info\EmpBasic;

class AttOTForm extends Model
{
    protected $table = 'att_o_t_forms';
    protected $guarded = [];

    public function empName()
    {
        return $this->belongsTo(EmpBasic::class, 'employee_id');
    }
}

<?php

namespace App\Attendance;

use Illuminate\Database\Eloquent\Model;
use App\Personnel\Info\EmpBasic;

class SILManagement extends Model
{
    protected $table = 's_i_l_managements';
    protected $guarded = [];

    public function empBasicInfo()
    {
        return $this->belongsTo(EmpBasic::class, 'employee_company_id');
    }
}

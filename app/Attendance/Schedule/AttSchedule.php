<?php

namespace App\Attendance\Schedule;

use Illuminate\Database\Eloquent\Model;
use App\Attendance\Schedule\AttShift;
use App\Personnel\Info\EmpBasic;

class AttSchedule extends Model
{
    protected $guarded = [];

    public function attShift() {
        return $this->belongsTo(AttShift::class, 'att_shift_key');
    }
    public function empBasic() {
        return $this->belongsTo(EmpBasic::class, 'emp_basic_id');
    }
}

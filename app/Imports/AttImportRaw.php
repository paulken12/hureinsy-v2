<?php

namespace App\Imports;

use App\Attendance\Schedule\AttAttendance;
use Maatwebsite\Excel\Concerns\ToModel;

class AttImportRaw implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AttAttendance([
            
        ]);
    }
}
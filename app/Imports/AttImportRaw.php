<?php

namespace App\Imports;

use App\Attendance\Schedule\AttAttendance;
use App\Personnel\Info\EmpBasic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttImportRaw implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        return new AttAttendance([
            'dtr_id' => date('ymd'),
            'emp_basic_id' => $this->emp_id($row['ac_no']),
            'date' => date('Y-m-d', strtotime($row['date'])),
            'time_table' => $row['timetable'],
            'required_time_in' => $row['on_duty'],
            'time_in' => $row['clock_in'],
            'is_late' => $this->if_late($row['late']),
            'required_time_out' => $row['off_duty'],
            'time_out' => $row['clock_out'],
            'is_under_time' => $this->if_undertime($row['early']),
            'total_hours' =>  $this->time_diff($row['clock_in'], $row['clock_out']),
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    function time_diff($x, $y){
        if(empty($x)){
            return '0';
        }
        if(empty($y)){
            return '0';
        }else{
            $h =date('H', strtotime($x));
            $m =date('i', strtotime($x));
            return date('H.i', strtotime('-'.$h.'hour -'.$m.'minutes' , strtotime($y)));
        }
    }
    function if_late($t){
        if($t){
            return '1';
        }else{
            return '0';
        }
    }
    function if_undertime($t){
        if($t){
            return '1';
        }else{
            return '0';
        }
    }
    function emp_id($i){
        return EmpBasic::where('company_id', $i)->pluck('id')->first();        
    }

}

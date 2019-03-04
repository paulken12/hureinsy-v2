<?php

namespace App\Http\Controllers\Attendance\Raw;

use function Couchbase\defaultDecoder;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance\Schedule\AttAttendance;
use SplFileObject;
use Illuminate\Support\Facades\Cache;

class ImportRawController extends Controller
{
    public function index()
    {
        return view('admin.attendance-management.dtr.raw-data.index');
    }

    public function store(Request $request)
    {
        $file = $request->file('import_file');
        
        $t_in = '';
        $t_out = ''; 
        $raw_file = array();
        $attendance = array();
        $time_in = array();
        $time_out = array();
        $start =  $request->input('date_start');
        $end = $request->input('date_end');
        $dtr_id = explode('-', $start .'-'. $end);
        $dtr_id = $dtr_id[0] .''. $dtr_id[1] .''. $dtr_id[2] .''. $dtr_id[3] .''. $dtr_id[4] .''. $dtr_id[5];

        foreach ($this->readTheFile($file) as $line)
        {
           $parts = explode('.', preg_replace('/\s+/','.' ,trim($line)));

           //dd($parts[4] .''. $parts[5]);
           $type = ($parts[4] === '0' &&  $parts[5] === '1') ? 'IN' : 'OUT';
           $date = date('Y-m-d', strtotime($parts[1]));

           //$type = ($parts[3] === '1' && $parts[4] === '0' && $parts[5] === '1' && $parts[6] === '0') ?   'IN' : 'OUT';
           //$type = ($parts[3] === '103' || $parts[3] === '1'  && $parts[4] === '0' && $parts[5] === '1' && $parts[6] === '0') ?   'IN' : 'OUT';
//            $key = array_search($request->input('start_date'), $parts[2]);
//
//            dd($key);
/*
           $raw_file[] = array(
               'unique_key'=> $parts[0] .'.'. $parts[1] .'.'. $type,
               'time'=> $parts[2],
               'type'=> $type,
               'start'=> $request->input('start_date'),
               'end'=> $request->input('end_date'),
           );*/

           //if (($date >= $start) && ($date <= $end)) {
                if($type === 'IN'){
                    $time_in[] = array(
                       'unique_key'=> $parts[0] .'.'. $date .'.'. $type,
                       'dtr_id' => $dtr_id,
                       'emp_basic_id' => $parts[0],
                       'date' => $date,
                       'time_in' => date('H:i:s', strtotime($parts[2])),
                       'is_late' => null,
                       'time_out' => null,
                       'is_under_time'=> null,
                       'type' => $type,
                    );
                }else{
                    $time_out[] =array(
                       'unique_key'=> $parts[0] .'.'. $date .'.'. $type,
                       'dtr_id' => $dtr_id,
                       'emp_basic_id' => $parts[0],
                       'date' => $date,
                       'time_in' => null,
                       'is_late' => null,
                       'time_out' => date('H:i:s', strtotime($parts[2])),
                       'is_under_time'=> null,
                       'type' => $type,
                   );
                }
            // }

        }

        array_multisort($time_out, SORT_DESC);
        array_multisort($time_in, SORT_ASC);

        $Ttime_out = array_unique(array_column($time_out, 'unique_key'));
        $Ttime_in = array_unique(array_column($time_in, 'unique_key'));
        $time_out = array_intersect_key($time_out, $Ttime_out);
        $time_in = array_intersect_key($time_in, $Ttime_in);

        $raw_file = array_merge($time_in, $time_out);
        array_multisort($raw_file);

        foreach ($raw_file as $key => $prune) {
            unset($raw_file[$key]['type']);
            unset($raw_file[$key]['unique_key']);
        }

        foreach (array_chunk($raw_file, 1000) as $dtr) {
            DB::table('att_attendances')->insert($dtr);
        }


/*
        foreach ($time_in as $dtr) {
            set_time_limit(0);
            $attendance = AttAttendance::create([
                'emp_basic_id' => $dtr['id'],
                'date'         => $dtr['date'],
                'time_in'      => $dtr['time_in'],
                'time_out'     => $dtr['time_out'],
            ]);
        }*/



/*        foreach ($raw_file as $dtr) {

            if($dtr['type'] === "IN"){
                $dtr['time_out'] = "";
            }else{
                $dtr['time_in'] = "";
            }

            set_time_limit(0);
            $attendance = AttAttendance::updateOrCreate([
                'time_in'      => $dtr['time_in'],
                'time_out'     => $dtr['time_out'],
                'emp_basic_id' => $dtr['id'],
                'date'         => $dtr['date'],
            ],[ 
                'emp_basic_id' => $dtr['id'],
                'date'         => $dtr['date'],
            ]);


            
            //clear output 

        }
            dd($attendance);*/

/*        foreach ($this->readTheFile($file) as $line) {
            $parts = explode('.', preg_replace('/\s+/', '.', trim($line)));
            $start = strtotime($request->input('start_date'));
            $end = strtotime($request->input('end_date'));
            $date = strtotime(isset($parts[1]) ? $parts[1] : null);
            $time = strtotime(isset($parts[2]) ? $parts[2] : null);

//            dd($start ." ".$end." ".$date);
//            if (($date >= $start) && ($date <= $end)) {

                $raw_file[] = array(
                    'emp_id' => $parts[0],
                    'date' => $parts[1],
                    'time' => $parts[2]);

            }*/
//        }


//
//
//        $t = -microtime(1);
//        $spl = new SplFileObject($file);
//        $spl->seek(999999);
//
//        foreach ($spl as $item) {
//            dd($item);
//        }
//
//        dd($spl);
//         dd($spl->current()
//            ."\n".(memory_get_peak_usage(1)/1024/1024)
//            ."\n".($t+microtime(1)));

        return view('admin.attendance-management.dtr.raw-data-table.index', compact('raw_file'));

    }


    function readTheFile($path)
    {
        $lines = [];
        $handle = fopen($path, "r");

        while (!feof($handle)) {
            $lines[] = trim(fgets($handle));
        }

        fclose($handle);
        return $lines;
    }
}

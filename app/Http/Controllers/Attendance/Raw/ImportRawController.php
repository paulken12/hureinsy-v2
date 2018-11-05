<?php

namespace App\Http\Controllers\Attendance\Raw;

use function Couchbase\defaultDecoder;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SplFileObject;

class ImportRawController extends Controller
{
    public function index()
    {
        return view('admin.attendance-management.dtr.raw-data.index');
    }

    public function store(Request $request)
    {
        $file = $request->file('import_file');
//        dd($this->readTheFile($file));

        $raw_file = array();
//        foreach (file($file) as $line)
//        {
//            $parts = explode('.', preg_replace('/\s+/','.' ,trim($line)));
//
//            //$type = ($parts[3] === '1' && $parts[4] === '0' && $parts[5] === '1' && $parts[6] === '0') ?   'IN' : 'OUT';
//            //$type = ($parts[3] === '103' || $parts[3] === '1'  && $parts[4] === '0' && $parts[5] === '1' && $parts[6] === '0') ?   'IN' : 'OUT';
////            $key = array_search($request->input('start_date'), $parts[2]);
////
////            dd($key);
//            $raw_file[] = array(
//                'emp_id'=> $parts[0],
//                'date'=> $parts[1],
//                'time'=> $parts[2],
//                'start'=> $request->input('start_date'),
//                'end'=> $request->input('end_date'),
//            );
//        }

        foreach ($this->readTheFile($file) as $line) {
            $parts = explode('.', preg_replace('/\s+/', '.', trim($line)));

            $start = strtotime($request->input('start_date'));
            $end = strtotime($request->input('end_date'));
            $date = strtotime(isset($parts[1]) ? $parts[1] : null);
            $time = strtotime(isset($parts[2]) ? $parts[2] : null);

//            dd($start ." ".$end." ".$date);
            if (($date >= $start) && ($date <= $end)) {

                $raw_file[] = array(
                    'emp_id' => $parts[0],
                    'date' => $parts[1],
                    'time' => $parts[2]);

            }
        }

        dd($raw_file);

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

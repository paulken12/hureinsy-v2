<?php

namespace App\Http\Controllers\Personnel\Report;


use App\Personnel\Info\EmpBasic;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;

class ReportController extends Controller
{
    public function index() {

//        $timezone    = 'America/New_York';
//        $startDate   = new DateTime('2013-06-12 20:00:00', new DateTimeZone($timezone));
//        $endDate     = new DateTime('2013-06-14 20:00:00', new DateTimeZone($timezone)); // Optional
//
//        $rule = (new Rule)
//            ->setStartDate($startDate)
//            ->setTimezone($timezone)
//            ->setFreq('DAILY')
//            ->setByDay(['MO', 'TU'])
//            ->setUntil(new \DateTime('2017-12-31'))
//        ;
//        dd($rule);

        $employees = EmpBasic::orderBy('last_name','asc')->get();
        return view('admin.employee-management.report.index',compact('employees','collection'));
    }

    public function report(Request $request) {

        $values = array_except($request->all(), ['_token','employee']);
        $all = $request->input('employee');
        $file_name = date('Y-m-d');

        if($all === 'all')
        {
            $employee = DB::table('emp_basics')
                ->join('users', 'emp_basics.user_id', '=', 'users.id')
                ->join('emp_benefits', 'emp_basics.id', '=', 'emp_benefits.emp_basic_id')
                ->join('emp_addresses', 'emp_basics.id', '=', 'emp_addresses.emp_basic_id')
                ->where('emp_addresses.master_address_key','ra')
//            ->join('emp_educations', 'emp_basics.id', '=', 'emp_educations.emp_basic_id')
//            ->join('emp_experiences', 'emp_basics.id', '=', 'emp_experiences.emp_basic_id')
//            ->join('emp_trainings', 'emp_basics.id', '=', 'emp_trainings.emp_basic_id')
//            ->join('emp_contracts', 'emp_basics.id', '=', 'emp_contracts.emp_basic_id')
                ->join('emp_contacts', 'emp_basics.id', '=', 'emp_contacts.emp_basic_id')
                ->select($values)
                ->get();
        }

        else{
            $employee = DB::table('emp_basics')->where('emp_basics.id', $all)
                ->join('users', 'emp_basics.user_id', '=', 'users.id')
                ->join('emp_benefits', 'emp_basics.id', '=', 'emp_benefits.emp_basic_id')
                ->join('emp_addresses', 'emp_basics.id', '=', 'emp_addresses.emp_basic_id')
                ->where('emp_addresses.master_address_key','ra')
//            ->join('emp_educations', 'emp_basics.id', '=', 'emp_educations.emp_basic_id')
//            ->join('emp_experiences', 'emp_basics.id', '=', 'emp_experiences.emp_basic_id')
//            ->join('emp_trainings', 'emp_basics.id', '=', 'emp_trainings.emp_basic_id')
//            ->join('emp_contracts', 'emp_basics.id', '=', 'emp_contracts.emp_basic_id')
                ->join('emp_contacts', 'emp_basics.id', '=', 'emp_contacts.emp_basic_id')
                ->select($values)
                ->get();
        }

        return Excel::download(new \App\Exports\ReportExport($employee), $file_name.'.xlsx');

    }

    public function export(Excel $excel, $export)
    {
        return $excel->download($export, 'invoices.xlsx');
    }
}

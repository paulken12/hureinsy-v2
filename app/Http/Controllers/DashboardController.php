<?php

namespace App\Http\Controllers;

use App\Personnel\Info\Contract;
use App\Personnel\Info\EmpContract;
use App\Personnel\Info\EmpBasic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regular_employees = EmpContract::regularEmp();
        $active_employees = EmpContract::activeEmp();
        $resigned_employees = EmpContract::resignedEmp();
        $project_employees = EmpContract::projectBasedEmp();

        $end_of_contracts = Contract::whereDate('contract_end', date('Y-m-d'))->count();    
        $birthdays = EmpBasic::whereMonth('date_of_birth', date('m'))->whereDay('date_of_birth', date('d'))->count();


        return view('dashboard',compact('regular_employees','active_employees','resigned_employees','project_employees','end_of_contracts','birthdays'));
    }
}

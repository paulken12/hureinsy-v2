<?php

namespace App\Http\Controllers;

use App\Personnel\Info\Contract;
use App\Personnel\Info\EmpContract;
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
        $regular_employees = Contract::regularEmp();
        $active_employees = Contract::activeEmp();
        $resigned_employees = Contract::resignedEmp();
        $project_employees = Contract::projectBasedEmp();
        $probe_employees = Contract::probationaryEmp();

        return view('dashboard',compact('regular_employees','active_employees','resigned_employees','project_employees','probe_employees'));
    }
}

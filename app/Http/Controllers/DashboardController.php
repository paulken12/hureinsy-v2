<?php

namespace App\Http\Controllers;

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
        $regular_employees = EmpContract::regularEmp();
        $active_employees = EmpContract::activeEmp();
        $resigned_employees = EmpContract::resignedEmp();
        $project_employees = EmpContract::projectBasedEmp();

        return view('dashboard',compact('regular_employees','active_employees','resigned_employees','project_employees'));
    }
}

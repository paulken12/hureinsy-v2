<?php

namespace App\Http\Controllers\Recruit;

use App\Annex\JobDescription\AnnexJobDescription;
use App\Contract\Job;
use App\Contract\Project;
use App\Helper\Slug;
use App\Mail\ConfirmEmail;
use App\Master\MasterEmpStatus;
use App\Master\MasterDepartment;
use App\Personnel\Info\Contract;
use App\Personnel\Info\EmpBasic;
use App\Personnel\Info\EmpBenefit;
use App\Role;
use App\Team;
use App\User;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RecruitController extends Controller
{
    public function create() {

        $company_id = EmpBasic::lastId();
        $roles = Role::orderBy('display_name','asc')->get()->except(1);
        $admins = Role::orderBy('display_name','asc')->get()->except([1,7]);

        $users = User::all();

        $emp = EmpBasic::with('user')->orderBy('last_name','asc')->get();

        $jobs = Job::all();
        $projects = Project::all();
        $statuses = MasterEmpStatus::all()->except(['separated']);

        $teams = Team::all();
        $depts = MasterDepartment::all();

        return view('admin.employee-management.recruit.create',compact('company_id','roles','admins','users','jobs','projects','statuses','emp', 'teams', 'depts'));
    }

    public function store(Request $request) {

        $slug = new Slug();
        $request->validate([

            'first_name'=>'required|string|max:255',

            'middle_name'=>'required|string|max:255',

            'last_name'=>'required|string|max:255',

            'email'=>'required|string|email|max:255|unique:users',

            'role_key'=>'required',
        ]);

        $benefit = $request->validate([
            'ben_sss' => 'nullable',
            'ben_pag_ibig' => 'nullable',
            'ben_philhealth' => 'nullable',
            'ben_tin' => 'nullable',
            'payroll_account' => 'nullable',
        ]);


        $job = $request->validate([
            'job_description'=>'nullable',
            'project_assignment'=>'nullable',
            'job_date_effective'=>'nullable',
            'department'=>'nullable',
        ]);

        $contract = $request->validate([
            'contract_start'=>'nullable',
            'contract_end'=>'nullable',
            'employment_status'=>'nullable',
        ]);


        //generate temporary password
        $password = str_random(8);

        //insert new user account
        $user = User::forceCreate([

            'name' => $request->input('first_name'),

            'email' => $request->input('email'),

            'password' => Hash::make($password),

            'master_emp_status_key' => 1,

            'verification_token' => str_random(25)
        ]);

        //attach the given role
        $user->attachRole($request->input('role_key'));

        $user_slug = $slug->createSlug($request->input('first_name').' '.$request->input('middle_name').' '.$request->input('last_name'));

        //insert the basic include provided by management
        $emp = EmpBasic::create([

            'company_id' => EmpBasic::lastId(),

            'user_id' => $user->id,

            'first_name' =>$request->input('first_name'),

            'middle_name' =>$request->input('middle_name'),

            'last_name' =>$request->input('last_name'),

            'slug' => $user_slug,

            'reporting_to' =>$request->input('report_to'),
        ]);

        EmpBenefit::create([
            'emp_basic_id' => $emp->id,
            'sss_num' => $benefit['ben_sss'],
            'pagibig_num' => $benefit['ben_pag_ibig'],
            'philhealth_num' => $benefit['ben_philhealth'],
            'tin_num' => $benefit['ben_tin'],
            'payroll_account' => $benefit['payroll_account'],
        ]);

        $annex_a = AnnexJobDescription::create([
            'job_description_id' => $job['job_description'],
            'department_key' => $job['department'],
            'Project_id' => $job['project_assignment'],
            'Reporting_to' => $request->input('report_to'),
            'Team_id' => '',
        ]);

        $con  = Contract::create([
            'emp_basic_id'=>$emp->id,
            'job_id'=> $annex_a->id,
            'schedule_id'=>0,
            'compensation_id'=>0,
            'contract_start'=> $contract['contract_start'],
            'contract_end'=> $contract['contract_end'],
            'employment_status'=> $contract['employment_status'],
            'resigned_date'=>'',
            'job_description_effective'=> $job['job_date_effective'],
        ]);


        $con->attachProject($job['job_description'],$job['project_assignment']);

        // send the verification to the new employee
        Mail::to($user)->send(new ConfirmEmail($user,$password));

        return back()->with('flash', 'Account Created successfully!');

    }
}

<?php

namespace App\Http\Controllers\Recruit;

use App\Mail\ConfirmEmail;
use App\Personnel\Info\EmpBasic;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RecruitController extends Controller
{
    public function create() {

        $company_id = EmpBasic::lastId();
        $roles = Role::orderBy('id','desc')->get();
        $admins = Role::all()->except(7);
        $users = User::all();

        return view('admin.employee-management.recruit.create',compact('company_id','roles','admins','users'));
    }

    public function store(Request $request) {

        $request->validate([

            'first_name'=>'required|string|max:255',

            'middle_name'=>'required|string|max:255',

            'last_name'=>'required|string|max:255',

            'email'=>'required|string|email|max:255|unique:users',

            'role_key'=>'required',
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

        //insert the basic include provided by management
        EmpBasic::create([

            'company_id' => EmpBasic::lastId(),

            'user_id' => $user->id,

            'first_name' =>$request->input('first_name'),

            'middle_name' =>$request->input('middle_name'),

            'last_name' =>$request->input('last_name'),

            'reporting_to' =>$request->input('report_to'),
        ]);

        // send the verification to the new employee
        Mail::to($user)->send(new ConfirmEmail($user,$password));

        return back()->with('flash', 'Account Created successfully!');

    }
}

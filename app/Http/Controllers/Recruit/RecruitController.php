<?php

namespace App\Http\Controllers\Recruit;

use App\Personnel\Info\EmpBasic;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RecruitController extends Controller
{
    public function create() {

        $company_id = EmpBasic::lastId();
        $roles = Role::orderBy('id','desc')->get();

        return view('admin.employee-management.recruit.create',compact('company_id','roles'));
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

        //insert the basic info provided by management
        EmpBasic::create([

            'company_id' => EmpBasic::lastId(),

            'user_id' => $user->id,

            'first_name' =>$request->input('first_name'),

            'middle_name' =>$request->input('middle_name'),

            'last_name' =>$request->input('last_name'),
        ]);

        return back()->with('flash', 'Account Created successfully!');

    }
}

<?php

namespace App\Http\Controllers\Personnel\Profile;

use App\Personnel\Info\EmpBasic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show(EmpBasic $profile) {

        return view('personnel.profile.show',compact('profile'));

    }
}

<?php

namespace App\Http\Controllers\Personnel\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index() {
        return view('personnel.profile.show');
    }
}

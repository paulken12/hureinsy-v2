<?php

namespace App\Http\Controllers\Personnel\Record;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonnelController extends Controller
{
    //
    public function index() {

        $users = User::paginate(14);

        return view('personnel.list.index', compact('users'));

    }
}

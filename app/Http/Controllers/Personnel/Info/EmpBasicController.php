<?php

namespace App\Http\Controllers\Personnel\Info;

use App\Personnel\Info\EmpBasic;
use App\User;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpBasicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * get all employees and paginate to 15 data
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $employees = EmpBasic::all();
//        foreach ($employees->user() as $item) {
//            dd($item);
//        }

        return view('personnel.list.index',compact('employees','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personnel\Info\EmpBasic  $empBasic
     * @return \Illuminate\Http\Response
     */
    public function show(EmpBasic $empBasic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personnel\Info\EmpBasic  $empBasic
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpBasic $empBasic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personnel\Info\EmpBasic  $empBasic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpBasic $empBasic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personnel\Info\EmpBasic  $empBasic
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpBasic $empBasic)
    {
        //
    }
}

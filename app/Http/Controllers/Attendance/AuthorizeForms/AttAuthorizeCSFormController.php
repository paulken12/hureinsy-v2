<?php

namespace App\Http\Controllers\Attendance\AuthorizeForms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance\AppriseForms\AttCSForm;
use App\Personnel\Info\EmpBasic;

class AttAuthorizeCSFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AttCSForm::where('status', 'For Authorization')
                         ->where('reporting_to', Auth::user()->basicInfo->pluck('id')->first())
                         ->groupBy('status', 'id')->get();
        $employees = EmpBasic::all();

        return view('admin.attendance-management.authorize.forms.cs.index', compact('list', 'employees'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttCSForm $id)
    {
        $flag = $request->input('oth');
        if($flag == 1){
             $aut = 'Authorized';
        }else{
             $aut = 'Unauthorized';
        }

        $id->status = $aut;
        $id->remarks = $request->input('remarks');
        $id->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

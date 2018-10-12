<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterEmpStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterEmpStatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterEmpStatus::paginate(7);

        return view('admin.master.empstatus.index', compact('master'));
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
    public function store(MasterEmpStatus $MasterEmpStatus, Request $request)
    {
        $validator = $request->validate([
            'key' => 'unique:master_emp_statuses,key|string|max:255|required',
            'employee_status' => 'unique:master_emp_statuses,employee_status|string|max:255|required',
        ]);

        $MasterEmpStatus->create([

            'key' => $request->input('key'),

            'employee_status' => $request->input('employee_status'),

        ]);

        return redirect(route('setting.masters.employeestatuses'))->with('success', 'Data successfully created.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterEmpStatus  $masterEmpStatus
     * @return \Illuminate\Http\Response
     */
    public function show(MasterEmpStatus $masterEmpStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterEmpStatus  $masterEmpStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterEmpStatus $MasterEmpStatus, $id)
    {
        $master = $MasterEmpStatus->where('id', $id)->first();

        return view('admin.master.empstatus.edit', compact('id', 'master', 'masterEmpStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterEmpStatus  $masterEmpStatus
     * @return \Illuminate\Http\Response
     */
    public function update(MasterEmpStatus $MasterEmpStatus, Request $request, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'employee_status' => 'string|max:255|required',
        ]);
        
        $master_update = $MasterEmpStatus->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->employee_status = $request->input('employee_status');

        $master_update->save();
        
        return redirect(route('setting.masters.employeestatuses'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterEmpStatus  $masterEmpStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterEmpStatus $MasterEmpStatus, $id)
    {
        $master = $MasterEmpStatus->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.employeestatuses'))->with('success', 'Data successfully deleted.');
    }
}

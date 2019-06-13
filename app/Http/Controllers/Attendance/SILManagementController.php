<?php

namespace App\Http\Controllers\Attendance;

use Illuminate\Http\Request;
use App\Personnel\Info\EmpBasic;
use App\Attendance\SILManagement;
use App\Http\Controllers\Controller;

class SILManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sil = SILManagement::all();

        $emp = EmpBasic::all();
    
        return view('admin.attendance-management.sil.index', compact('sil', 'emp'));
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
    public function update(Request $request, $id)
    {
        $s = $request->validate([
            'man' => 'required',
            'add' => 'required',
        ]);

        $sil = SILManagement::find($id);

        $sil->man = abs(round($s['man'] * 8, 1));
        $sil->add = abs(round($s['add'] * 8, 1));
        $sil->updated_flag = 0;
        $sil->save();

        return ['mes' => 'SIL updated.'];
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

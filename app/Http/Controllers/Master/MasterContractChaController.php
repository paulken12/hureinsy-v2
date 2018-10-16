<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterContractChangePaf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterContractChaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterContractChangePaf::paginate(7);

        return view('admin.master.contract.index', compact('master'));
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
    public function store(MasterContractChangePaf $MasterContractChangePaf, Request $request)
    {
        $validator = $request->validate([
            'key' => 'unique:master_contract_change_pafs,key|string|max:255|required',
            'change_type' => 'unique:master_contract_change_pafs,change_type|string|max:255|required',
        ]);

        $MasterContractChangePaf->create([

            'key' => $request->input('key'),

            'change_type' => $request->input('change_type'),

        ]);

        return redirect(route('setting.masters.contract'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MasterContractChangePaf $masterContractChangePaf, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterContractChangePaf $masterContractChangePaf, $id)
    {
        $master = $masterContractChangePaf->where('id', $id)->first();

        return view('admin.master.contract.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterContractChangePaf $masterContractChangePaf, Request $request, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'change_type' => 'string|max:255|required',
        ]);
        
        $master_update = $masterContractChangePaf->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->change_type = $request->input('change_type');

        $master_update->save();
        
        return redirect(route('setting.masters.contract'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterContractChangePaf $masterContractChangePaf, $id)
    {
        $master = $masterContractChangePaf->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.contract'))->with('success', 'Data successfully deleted.');
    }
}

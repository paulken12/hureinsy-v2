<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterAddressType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterAddressTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterAddressType::paginate(7);

        return view('admin.master.address.index', compact('master'));
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
    public function store(MasterAddressType $MasterAddressType, Request $request)
    {   
        $validator = $request->validate([
            'key' => 'unique:master_address_types,key|string|max:255|required',
            'address_type' => 'unique:master_address_types,address_type|string|max:255|required',
        ]);

        $MasterAddressType->create([

            'key' => $request->input('key'),

            'address_type' => $request->input('address_type'),

        ]);

        return redirect(route('setting.masters.address'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterAddressType  $masterAddressType
     * @return \Illuminate\Http\Response
     */
    public function show(MasterAddressType $masterAddressType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterAddressType  $masterAddressType
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterAddressType $masterAddressType, $id)
    {
        $master = $masterAddressType->where('id', $id)->first();

        return view('admin.master.address.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterAddressType  $masterAddressType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterAddressType $masterAddressType, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'address_type' => 'string|max:255|required',
        ]);
        
        $master_update = $masterAddressType->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->address_type = $request->input('address_type');

        $master_update->save();
        
        return redirect(route('setting.masters.address'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterAddressType  $masterAddressType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterAddressType $masterAddressType, $id)
    {
        $master = $masterAddressType->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.address'))->with('success', 'Data successfully deleted.');
    }
}

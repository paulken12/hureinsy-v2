<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterExtension;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterExtensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterExtension::paginate(7);

        return view('admin.master.extension.index', compact('master'));
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
    public function store(MasterExtension $MasterExtension, Request $request)
    {
        $validator = $request->validate([
            'key' => 'unique:master_extensions,key|string|max:255|required',
            'name_extension' => 'unique:master_extensions,name_extension|string|max:255|required',
        ]);

        $MasterExtension->create([

            'key' => $request->input('key'),

            'name_extension' => $request->input('name_extension'),

        ]);

        return redirect(route('setting.masters.extension'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterExtension  $masterExtension
     * @return \Illuminate\Http\Response
     */
    public function show(MasterExtension $masterExtension)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterExtension  $masterExtension
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterExtension $masterExtension, $id)
    {
        $master = $masterExtension->where('id', $id)->first();

        return view('admin.master.extension.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterExtension  $masterExtension
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterExtension $masterExtension, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'name_extension' => 'string|max:255|required',
        ]);
        
        $master_update = $masterExtension->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->name_extension = $request->input('name_extension');

        $master_update->save();
        
        return redirect(route('setting.masters.extension'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterExtension  $masterExtension
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterExtension $masterExtension, $id)
    {
        $master = $masterExtension->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.extension'))->with('success', 'Data successfully deleted.');
    }
}

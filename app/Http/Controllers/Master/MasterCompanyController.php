<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterCompany::paginate(7);

        return view('admin.master.company.index', compact('master'));
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
    public function store(MasterCompany $MasterCompany, Request $request)
    {
        $validator = $request->validate([
            'key' => 'unique:master_companies,key|string|max:255|required',
            'company' => 'unique:master_companies,name|string|max:255|required',
        ]);

        $MasterCompany->create([

            'key' => $request->input('key'),

            'name' => $request->input('company'),

        ]);

        return redirect(route('setting.masters.companies'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterCompany  $masterCompany
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCompany $masterCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterCompany  $masterCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCompany $MasterCompany, $id)
    {
        $master = $MasterCompany->where('id', $id)->first();

        return view('admin.master.company.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterCompany  $masterCompany
     * @return \Illuminate\Http\Response
     */
    public function update(MasterCompany $MasterCompany, Request $request, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'company' => 'string|max:255|required',
        ]);
        
        $master_update = $MasterCompany->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->name = $request->input('company');

        $master_update->save();
        
        return redirect(route('setting.masters.companies'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterCompany  $masterCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterCompany $MasterCompany, $id)
    {
        $master = $MasterCompany->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.companies'))->with('success', 'Data successfully deleted.');
    }
}

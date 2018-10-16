<?php

namespace App\Http\Controllers\Master;

use App\Master\MasterCitizenship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterCitizenshiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = MasterCitizenship::paginate(7);

        return view('admin.master.citizenship.index', compact('master'));
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
    public function store(MasterCitizenship $MasterCitizenship, Request $request)
    {
        $validator = $request->validate([
            'key' => 'unique:master_citizenship,key|string|max:255|required',
            'citizenship' => 'unique:master_citizenship,citizenship|string|max:255|required',
        ]);

        $MasterCitizenship->create([

            'key' => $request->input('key'),

            'citizenship' => $request->input('citizenship'),

        ]);

        return redirect(route('setting.masters.citizenship'))->with('success', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master\MasterCitizenship  $masterCitizenship
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCitizenship $masterCitizenship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master\MasterCitizenship  $masterCitizenship
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCitizenship $masterCitizenship, $id)
    {
        $master = $masterCitizenship->where('id', $id)->first();

        return view('admin.master.citizenship.edit', compact('id', 'master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master\MasterCitizenship  $masterCitizenship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterCitizenship $masterCitizenship, $id)
    {
        $validator = $request->validate([
            'key' => 'string|max:255|required',
            'citizenship' => 'string|max:255|required',
        ]);
        
        $master_update = $masterCitizenship->where('id', $id)->first();

        $master_update->key = $request->input('key');

        $master_update->citizenship = $request->input('citizenship');

        $master_update->save();
        
        return redirect(route('setting.masters.citizenship'))->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master\MasterCitizenship  $masterCitizenship
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterCitizenship $masterCitizenship, $id)
    {
        $master = $masterCitizenship->where('id', $id)->first();

        $master->delete();

        return redirect(route('setting.masters.citizenship'))->with('success', 'Data successfully deleted.');
    }
}

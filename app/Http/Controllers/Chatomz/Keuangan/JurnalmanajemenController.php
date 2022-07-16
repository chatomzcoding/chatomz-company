<?php

namespace App\Http\Controllers\Chatomz\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Jurnalmanajemen;
use Illuminate\Http\Request;

class JurnalmanajemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Jurnalmanajemen::create($request->all());
        return back()->with('ds','Jurnal Manajemen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurnalmanajemen  $jurnalmanajemen
     * @return \Illuminate\Http\Response
     */
    public function show(Jurnalmanajemen $jurnalmanajemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurnalmanajemen  $jurnalmanajemen
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurnalmanajemen $jurnalmanajemen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurnalmanajemen  $jurnalmanajemen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Jurnalmanajemen::where('id',$request->id)->update([
            'nominal' => $request->nominal,
            'manajemenkeuangan_id' => $request->manajemenkeuangan_id,
        ]);

        return back()->with('du','Jurnal Manajemen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurnalmanajemen  $jurnalmanajemen
     * @return \Illuminate\Http\Response
     */
    public function destroy($jurnalmanajemen)
    {
        Jurnalmanajemen::find($jurnalmanajemen)->delete();
        return back()->with('dd','Jurnal Manajemen');
    }
}

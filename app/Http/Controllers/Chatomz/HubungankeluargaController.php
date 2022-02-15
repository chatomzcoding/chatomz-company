<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Keluargahubungan;
use Illuminate\Http\Request;

class HubungankeluargaController extends Controller
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
        Keluargahubungan::create($request->all());

        return redirect()->back()->with('ds','Hubungan Keluarga');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluargahubungan  $keluargahubungan
     * @return \Illuminate\Http\Response
     */
    public function show(Keluargahubungan $keluargahubungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluargahubungan  $keluargahubungan
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluargahubungan $keluargahubungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluargahubungan  $keluargahubungan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Keluargahubungan::where('id',$request->id)->update([
            'urutan' => $request->urutan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('ds','Hubungan Keluarga');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluargahubungan  $keluargahubungan
     * @return \Illuminate\Http\Response
     */
    public function destroy($keluargahubungan)
    {
        Keluargahubungan::find($keluargahubungan)->delete();

        return redirect()->back()->with('dd','Hubungan Keluarga');
    }
}

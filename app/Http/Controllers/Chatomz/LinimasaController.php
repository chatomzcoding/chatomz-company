<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Linimasa;
use Illuminate\Http\Request;

class LinimasaController extends Controller
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
        Linimasa::create([
            'orang_id' => $request->orang_id,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'icon' => strtolower($request->icon),
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'tag' => $request->tag,
        ]);
        return back()->with('ds','Linimasa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function show(Linimasa $linimasa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function edit(Linimasa $linimasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Linimasa::where('id',$request->id)->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'icon' => strtolower($request->icon),
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'tag' => $request->tag,
        ]);

        return back()->with('du','Linimasa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Linimasa $linimasa)
    {
        $linimasa->delete();

        return back()->with('dd','Linimasa');
    }
}

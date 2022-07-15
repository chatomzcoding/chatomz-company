<?php

namespace App\Http\Controllers\Chatomz\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Manajemenkeuangan;
use Illuminate\Http\Request;

class ManajemenkeuanganController extends Controller
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
        Manajemenkeuangan::create([
            'judul' => $request->judul,
            'alokasi' => $request->alokasi,
            'nominal' => default_nilai($request->nominal),
            'waktu' => $request->waktu,
            'subkategori_id' => $request->subkategori_id,
        ]);

        return back()->with('ds','Manajemen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manajemenkeuangan  $manajemenkeuangan
     * @return \Illuminate\Http\Response
     */
    public function show(Manajemenkeuangan $manajemenkeuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manajemenkeuangan  $manajemenkeuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Manajemenkeuangan $manajemenkeuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manajemenkeuangan  $manajemenkeuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Manajemenkeuangan::where('id',$request->id)->update([
            'judul' => $request->judul,
            'nominal' => default_nilai($request->nominal),
            'waktu' => $request->waktu,
            'subkategori_id' => $request->subkategori_id,
        ]);

        return back()->with('du','Kebutuhan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manajemenkeuangan  $manajemenkeuangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manajemenkeuangan $manajemenkeuangan)
    {
        $manajemenkeuangan->delete();

        return back()->with('dd','Kebutuhan');
    }
}

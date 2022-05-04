<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Subkategori;
use Illuminate\Http\Request;

class SubkategoriController extends Controller
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
        Subkategori::create([
            'kategori_id' => $request->kategori_id,
            'nama_sub' => $request->nama_sub,
            'keterangan_sub' => $request->keterangan_sub,
        ]);

        return back()->with('ds','Sub Kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function show(Subkategori $subkategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Subkategori $subkategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subkategori $subkategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subkategori $subkategori)
    {
        //
    }
}

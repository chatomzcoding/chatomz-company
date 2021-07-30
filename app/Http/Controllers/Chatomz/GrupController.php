<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Grup;
use App\Models\Orang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class GrupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grup   = Grup::all();

        return view('chatomz.kingdom.grup.index', compact('grup'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grup  $grup
     * @return \Illuminate\Http\Response
     */
    public function show($grup)
    {
        $grup       = Grup::find(Crypt::decryptString($grup));
        $anggota    = DB::table('grup_anggota')
                        ->join('orang','grup_anggota.orang_id','=','orang.id')
                        ->select('grup_anggota.*','orang.first_name','orang.last_name','orang.gender','orang.photo','orang.death')
                        ->where('grup_anggota.grup_id',$grup->id)
                        ->orderByDesc('grup_anggota.id')
                        ->get();
        $orang      = Orang::where('status_group','available')->orderBy('first_name','ASC')->get();
        return view('chatomz.kingdom.grup.show', compact('grup','anggota','orang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grup  $grup
     * @return \Illuminate\Http\Response
     */
    public function edit(Grup $grup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grup  $grup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grup $grup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grup  $grup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grup $grup)
    {
        //
    }
}

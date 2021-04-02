<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\Keluargahubungan;
use App\Models\Orang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keluarga       = Keluarga::all();
        $kepalakeluarga = Orang::where('gender','male')->where('marital_status','married')->get();
        return view('chatomz.keluarga.index', compact('keluarga','kepalakeluarga'));
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
        Keluarga::create($request->all());

        return redirect()->back()->with('ds','Keluarga');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function show($keluarga)
    {
        $keluarga           = Keluarga::find(Crypt::decryptString($keluarga));
        $keluargahubungan   = DB::table('keluarga_hubungan')
                                ->join('orang','keluarga_hubungan.orang_id','=','orang.id')
                                ->select('keluarga_hubungan.*','orang.first_name','orang.last_name')
                                ->where('keluarga_hubungan.keluarga_id',$keluarga->id)
                                ->get();
        return view('chatomz.keluarga.show', compact('keluarga','keluargahubungan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluarga $keluarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Keluarga::where('id',$request->id)->update([
            'orang_id' => $request->orang_id,
            'nama_keluarga' => $request->nama_keluarga,
            'no_kk' => $request->no_kk,
            'keterangan' => $request->keterangan,
            'tgl_pernikahan' => $request->tgl_pernikahan,
            'status_keluarga' => $request->status_keluarga,
        ]);

        return redirect()->back()->with('du','Keluarga');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keluarga $keluarga)
    {
        //
    }
}

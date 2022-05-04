<?php

namespace App\Http\Controllers\Chatomz\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekening   = Rekening::all();

        return view('chatomz.kingdom.keuangan.index', compact('rekening'));
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
        $detail = [
            'tentang' => $request->tentang,
            'warna' => $request->warna,
            'icon' => $request->icon,
        ];

        Rekening::create([
            'nama_rekening' => $request->nama_rekening,
            'saldo_awal' => default_nilai($request->saldo_awal),
            'jenis' => $request->jenis,
            'detail' => json_encode($detail)
        ]);

        return back()->with('ds','Rekening');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */

    public function show(Rekening $rekening)
    {
        $kategori   = Kategori::where('label','keuangan')->get();
        $saldoawal  = $rekening->saldo_awal;
        $bulan = (isset($_GET['bulan'])) ? $_GET['bulan'] : 'semua' ;
        $jurnaltotal = Jurnal::where('rekening_id',$rekening->id)->get(['nominal','arus']);
        if ($bulan == 'semua') {
            $jurnal = Jurnal::where('rekening_id',$rekening->id)->latest()->get();
        } else {
            $jurnal = Jurnal::where('rekening_id',$rekening->id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',ambil_tahun())->latest()->get();
        }
        
        
        $perhitungan    = PerhitunganDompet($jurnal,$saldoawal);
        $main   = [
            'total' => PerhitunganDompet($jurnaltotal,$saldoawal)
        ];
        return view('chatomz.kingdom.keuangan.show', compact('main','rekening','kategori','jurnal','bulan','perhitungan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekening $rekening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $detail = [
            'tentang' => $request->tentang,
            'warna' => $request->warna,
            'icon' => $request->icon,
        ];

        Rekening::where('id',$request->id)->update([
            'nama_rekening' => $request->nama_rekening,
            'saldo_awal' => default_nilai($request->saldo_awal),
            'jenis' => $request->jenis,
            'detail' => json_encode($detail)
        ]);

        return back()->with('du','Rekening');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekening $rekening)
    {
        //
    }
}

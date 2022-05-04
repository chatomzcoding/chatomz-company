<?php

namespace App\Http\Controllers\Chatomz\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $total      = 0;
        $data       = [];
        foreach ($rekening as $item) {
            $saldo  = PerhitunganDompet($item->jurnal,$item->saldo_awal);
            $data[] = [
                'row' => $item,
                'sisa' => $saldo['total'],
            ];
            $total = $total + $saldo['total'];
        }

        return view('chatomz.kingdom.keuangan.index', compact('data','total'));
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
            'warna' => strtolower($request->warna),
            'icon' => strtolower($request->icon),
        ];

        Rekening::create([
            'nama_rekening' => $request->nama_rekening,
            'saldo_awal' => default_nilai($request->saldo_awal),
            'saldo_minimum' => default_nilai($request->saldo_minimum),
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
        // kategori
        $dkategori  = [];
        foreach ($kategori as $key) {
            $djurnal    = DB::table('jurnal')
                            ->join('sub_kategori','jurnal.subkategori_id','=','sub_kategori.id')
                            ->join('kategori','sub_kategori.kategori_id','=','kategori.id')
                            ->select('jurnal.arus','jurnal.nominal')
                            ->where('jurnal.rekening_id',$rekening->id)
                            ->where('kategori.id',$key->id)
                            ->get();
            if (count($djurnal) > 0) {
                $dkategori[] = [
                    'data' => PerhitunganDompet($djurnal,0),
                    'kategori' => $key
                ];
            }
        }
        $main   = [
            'total' => PerhitunganDompet($jurnaltotal,$saldoawal),
            'kategori' => $dkategori
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
            'warna' => strtolower($request->warna),
            'icon' => strtolower($request->icon),
        ];

        Rekening::where('id',$request->id)->update([
            'nama_rekening' => $request->nama_rekening,
            'saldo_awal' => default_nilai($request->saldo_awal),
            'saldo_minimum' => default_nilai($request->saldo_minimum),
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

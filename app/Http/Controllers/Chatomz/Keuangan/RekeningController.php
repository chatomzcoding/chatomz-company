<?php

namespace App\Http\Controllers\Chatomz\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\Manajemenkeuangan;
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
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'index' ;
        switch ($s) {
            case 'dashboard':
                $total      = 0;
                $bank       = 0;
                $emoney     = 0;
                $cash       = 0;
                $kategori   = [];
                foreach ($rekening as $item) {
                    $saldo  = PerhitunganDompet($item->jurnal,$item->saldo_awal);
                    $saldo  = $saldo['total'];
                    $total = $total + $saldo;
                    switch ($item->jenis) {
                        case 'bank':
                            $bank = $bank + $saldo;
                            break;
                        case 'e-money':
                            $emoney = $emoney + $saldo;
                            break;
                        default:
                            $cash = $cash + $saldo;
                            break;
                    }

                    // berdasarkan kategori
                    foreach ($item->jurnal as $key) {
                        $nama_kategori = $key->subkategori->kategori->nama_kategori;
                        $kategori[$nama_kategori][$key->subkategori->nama_sub][] = $key;
                    }
                }
                // manajemen keuangan
                $totalkebutuhanbulanan  = Manajemenkeuangan::where([['alokasi','kebutuhan'],['waktu','bulanan']])->sum('nominal');
                $statistik = [
                    'total' => $total,
                    'cash' => $cash,
                    'bank' => $bank,
                    'e-money' => $emoney,
                    'kebutuhanbulanan' => $totalkebutuhanbulanan
                ];
                return view('chatomz.kingdom.keuangan.dashboard', compact('statistik','kategori'));
                break;
            case 'manajemen':
                $kategori   = Kategori::where('label','keuangan')->get();
                $kebutuhan  = Manajemenkeuangan::where('alokasi','kebutuhan')->get();
                return view('chatomz.kingdom.keuangan.manajemen', compact('kategori','kebutuhan'));
                break;
            
            default:
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

                $jurnal     = Jurnal::limit(20)->orderBy('tanggal','DESC')->get();
                return view('chatomz.kingdom.keuangan.index', compact('data','total','jurnal'));
                break;
        }
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
        $bulan = (isset($_GET['bulan'])) ? $_GET['bulan'] : ambil_bulan() ;
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'show' ;
        $arus = (isset($_GET['arus'])) ? $_GET['arus'] : 'semua' ;
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
      
        switch ($s) {
            case 'kategori':
                $jurnal    = DB::table('jurnal')
                ->join('sub_kategori','jurnal.subkategori_id','=','sub_kategori.id')
                ->join('kategori','sub_kategori.kategori_id','=','kategori.id')
                ->select('jurnal.*','sub_kategori.nama_sub')
                ->where('jurnal.rekening_id',$rekening->id)
                ->where('kategori.id',$_GET['id'])
                ->get();

                $main   = [
                    'sesi' => PerhitunganDompet($jurnal),
                    'kategori' => $dkategori,
                ];
                return view('chatomz.kingdom.keuangan.kategori', compact('rekening','main','jurnal'));
                break;
            
            default:
                # code...
                    $jurnaltotal = Jurnal::where('rekening_id',$rekening->id)->get(['nominal','arus']);
                    if ($bulan == 'semua') {
                        $jurnal = Jurnal::where('rekening_id',$rekening->id)->latest()->get();
                    } else {
                        if ($arus == 'semua') {
                            $jurnal = Jurnal::where('rekening_id',$rekening->id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',ambil_tahun())->latest()->get();
                        } else {
                            $jurnal = Jurnal::where('rekening_id',$rekening->id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',ambil_tahun())->where('arus',$arus)->latest()->get();
                        }
                        
                    }
                    
                    $perhitungan    = PerhitunganDompet($jurnal,$saldoawal);

                    $rekenings  = Rekening::all();
                    $main   = [
                        'total' => PerhitunganDompet($jurnaltotal,$saldoawal),
                        'sesi' => PerhitunganDompet($jurnal),
                        'kategori' => $dkategori,
                    ];
            
                    return view('chatomz.kingdom.keuangan.show', compact('main','rekening','kategori','jurnal','bulan','perhitungan','rekenings','arus'));
                break;
        }
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

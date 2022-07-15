<?php

namespace App\Http\Controllers\Chatomz\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Jurnalmanajemen;
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
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'index' ;
        $akses = (isset($_GET['akses'])) ? $_GET['akses'] : 'pribadi' ;
        $rekening   = Rekening::where('akses',$akses)->get();
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
                $rekening_id = (isset($_GET['rekening'])) ? $_GET['rekening'] : 'semua' ;
                $bulan = (isset($_GET['bulan'])) ? $_GET['bulan'] : ambil_bulan() ;
                if ($rekening_id == 'semua') {
                    $jurnal     = DB::table('jurnal')
                                    ->join('rekening','jurnal.rekening_id','=','rekening.id')
                                    ->where('rekening.akses',$akses)
                                    ->whereMonth('jurnal.tanggal',$bulan)
                                    ->whereYear('jurnal.tanggal',ambil_tahun())
                                    ->select('jurnal.tanggal','jurnal.nominal','jurnal.arus')
                                    ->get();
                } else {
                    $jurnal     = DB::table('jurnal')
                                    ->join('rekening','jurnal.rekening_id','=','rekening.id')
                                    ->where('rekening.akses',$akses)
                                    ->where('rekening.id',$rekening_id)
                                    ->whereMonth('jurnal.tanggal',$bulan)
                                    ->whereYear('jurnal.tanggal',ambil_tahun())
                                    ->select('jurnal.tanggal','jurnal.nominal','jurnal.arus')
                                    ->get();
                }
                
                
                $label = [];
                $nilai_masuk = [];
                $nilai_keluar = [];
                for ($i=1; $i <= 31; $i++) { 
                    $label[] = $i;
                    $tgl    = $i;
                    if ($i <= 9) {
                        $tgl = '0'.$i;
                    }
                    // cari nominal
                    $masuk = 0;
                    $keluar = 0;
                    $tanggal = ambil_tahun().'-'.$bulan.'-'.$tgl;
                    foreach ($jurnal as $key) {
                        if ($key->tanggal == $tanggal) {
                            if ($key->arus == 'pemasukan') {
                                $masuk = $masuk + $key->nominal;                            
                            } else {
                                $keluar = $keluar + $key->nominal;                            
                            }
                        }
                    }
                    $nilai_masuk[] = $masuk;
                    $nilai_keluar[] = $keluar;
                }
                $chart = [
                    'label' => $label,
                    'nilai_masuk' => $nilai_masuk,
                    'nilai_keluar' => $nilai_keluar
                ];
                return view('chatomz.kingdom.keuangan.dashboard', compact('statistik','kategori','chart','rekening','bulan','rekening_id'));
                break;
            case 'manajemen':
                $kategori   = Kategori::where('label','keuangan')->get();
                $manajemen  = Manajemenkeuangan::all();
                $kewajiban = Manajemenkeuangan::where('alokasi','kewajiban')->sum('nominal');
                $dperencanaan = Manajemenkeuangan::where('alokasi','perencanaan')->get();
                // perencanaan
                $jurnalmanajemen    = Jurnalmanajemen::whereMonth('created_at',ambil_bulan())->get();
                $pemasukan          = 0;
                $perencanaan        = 0;
                $dataperencanaan        = [];
                foreach ($jurnalmanajemen as $key) {
                    $nominal    = $key->jurnal->nominal;
                    // pemasukan
                    switch ($key->manajemenkeuangan->alokasi) {
                        case 'pemasukan':
                            $pemasukan = $pemasukan + $nominal; 
                            break;
                        case 'perencanaan':
                            $dataperencanaan[$key->manajemenkeuangan->judul]['nominal'][] = $nominal;
                            $dataperencanaan[$key->manajemenkeuangan->judul]['persen'] = $key->manajemenkeuangan->nominal;
                            $perencanaan = $perencanaan + $nominal;
                            break;
                        default:
                            # code...
                            break;
                    }
                }
                // cek perencanaan
                foreach ($dperencanaan as $key) {
                    if (!isset($dataperencanaan[$key->judul])) {
                        $dataperencanaan[$key->judul]['nominal'][] = 0;
                        $dataperencanaan[$key->judul]['persen'] = $key->nominal;
                    }
                }
                $perencanaan    = [
                    'pemasukan' => $pemasukan,
                    'kewajiban' => $kewajiban,
                    'perencanaan' => [
                        'data' => $dataperencanaan,
                        'total' => $perencanaan
                    ]
                ];

                return view('chatomz.kingdom.keuangan.manajemen', compact('kategori','manajemen','perencanaan'));
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
                $jurnal     = [];
                if ($akses == 'pribadi') {
                    $jurnal     = Jurnal::limit(20)->orderBy('tanggal','DESC')->get();
                }
                
                return view('chatomz.kingdom.keuangan.index', compact('data','total','jurnal','akses'));
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
            'akses' => $request->akses,
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
        $waktu = (isset($_GET['waktu'])) ? $_GET['waktu'] : 'harian' ;
        $bulan = (isset($_GET['bulan'])) ? $_GET['bulan'] : ambil_bulan() ;
        $tanggal = (isset($_GET['tanggal'])) ? $_GET['tanggal'] : tgl_sekarang() ;
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
                $jurnaltotal = Jurnal::where('rekening_id',$rekening->id)->get(['nominal','arus']);
                // sesi waktu

                switch ($waktu) {
                    case 'bulanan':
                        if ($bulan == 'semua') {
                            $jurnal = Jurnal::where('rekening_id',$rekening->id)->latest()->get();
                        } else {
                            if ($arus == 'semua') {
                                $jurnal = Jurnal::where('rekening_id',$rekening->id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',ambil_tahun())->latest()->get();
                            } else {
                                $jurnal = Jurnal::where('rekening_id',$rekening->id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',ambil_tahun())->where('arus',$arus)->latest()->get();
                            }
                        }
                        break;

                    default:
                        if ($arus == 'semua') {
                            $jurnal = Jurnal::where('rekening_id',$rekening->id)->whereDate('tanggal',$tanggal)->latest()->get();
                        } else {
                            $jurnal = Jurnal::where('rekening_id',$rekening->id)->whereDate('tanggal',$tanggal)->where('arus',$arus)->latest()->get();
                        }
                        break;
                }
                    
                    $perhitungan    = PerhitunganDompet($jurnal,$saldoawal);

                    $rekenings  = Rekening::where('akses','pribadi')->get();
                    $main   = [
                        'total' => PerhitunganDompet($jurnaltotal,$saldoawal),
                        'sesi' => PerhitunganDompet($jurnal),
                        'kategori' => $dkategori,
                        'waktu' => $waktu,
                        'tanggal' => $tanggal,
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
            'akses' => $request->akses,
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

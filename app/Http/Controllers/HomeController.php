<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Informasi;
use App\Models\Informasisub;
use App\Models\Jejak;
use App\Models\Jurnal;
use App\Models\Keluarga;
use App\Models\Linimasa;
use App\Models\Orang;
use App\Models\Pendidikan;
use App\Models\Riwayat;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('visitorhits');
    // }
    public function index()
    {
        $dashboard  = TRUE;
        $user       = Auth::user();
        switch ($user->level) {
            case 'admin':
                $orang          = Orang::count();
                $grup           = Grup::count();
                $keluarga       = Keluarga::count();
                $jejak          = Jejak::count();
                $total      = [
                    'orang' => $orang,
                    'grup' => $grup,
                    'keluarga' => $keluarga,
                    'jejak' => $jejak,
                ];

                // kebutuhan info
                $ulangtahunbulanini     = Orang::whereMonth('date_birth',ambil_bulan())->orderBy('first_name','ASC')->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                $ulangtahuntanggalini     = Orang::whereMonth('date_birth',ambil_bulan())->whereDay('date_birth',ambil_tgl())->orderBy('first_name','ASC')->limit(3)->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                $info = [
                    'ulangtahunbulanini' => $ulangtahunbulanini,
                    'ulangtahuntanggalini' => $ulangtahuntanggalini
                ];
                $jumlahlakilaki     = Orang::where('gender','laki-laki')->count();
                $meninggal              = Orang::where('death','alm')->count();
                $jumlahperempuan    = $orang - $jumlahlakilaki;
                $hidup    = $orang - $meninggal;
                $gender = [$jumlahlakilaki,$jumlahperempuan];
                $kematian = [$hidup,$meninggal];
                $data       = [
                    'riwayatlihatorang' => Riwayat::where('kode','lihatorang')->limit(4)->latest()->get(),
                    'orangbaru' => Orang::limit(4)->latest()->get()
                ];
                $chart = [
                    'visitor' => self::chartvisitor()
                ];
                $jurnal         = Jurnal::where('tanggal',tgl_sekarang())->get();
                $jurnalkeuangan = PerhitunganDompet($jurnal);
                $main   = [
                    'jurnalkeuangan' => $jurnalkeuangan
                ];
                return view('chatomz.admin.dashboard', compact('main','total','dashboard','info','gender','kematian','data','chart'));
                break;
            default:
                return view('dashboard', compact('dashboard'));
                break;
        }
    }

    public static function chartvisitor()
    {
        $label  = [];
        $nilai  = [];
        for ($i=1; $i <= ambil_tgl() ; $i++) { 
            $label[]    = $i;
            $hits    = Visitor::whereYear('tgl_visitor',ambil_tahun())
                            ->whereMonth('tgl_visitor',ambil_bulan())
                            ->whereDay('tgl_visitor',$i)->sum('hits');
            $nilai[] = $hits;
        }
        $result = [
            'label' => $label,
            'nilai' => $nilai
        ];
        return $result;
    }

    public function statistik()
    {
        // data orang yang baru ditambahkan ditampilkan 8 data
        $orangbaru      = Orang::limit(8)->orderByDesc('id')->get();
        $data = [
            'orangbaru' => $orangbaru
        ];

        return view('sistem.statistik', compact('data'));
    }

    public function cari()
    {
        $s = (isset($_GET['s'])) ? $_GET['s'] : NULL ;
        $film   = [];
        $informasi   = [];
        $phone  = [];
        switch ($s) {
            case 'carinama':
                $cari   = $_GET['nama'];
                // cari orang
                $dnama  = explode(' ',$cari);
                $first_name = $dnama[0];
                if (count($dnama) == 1) {
                    $last_name = $dnama[0];
                    $orang  = Orang::where('first_name','LIKE','%'.$first_name.'%')->Orwhere('last_name','LIKE','%'.$last_name.'%')->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                } else {
                    $last_name = $dnama[1];
                    $orang  = Orang::where('first_name','LIKE','%'.$first_name.'%')->where('last_name','LIKE','%'.$last_name.'%')->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                }

                // cari film
                $informasi   = Informasi::where('nama','LIKE','%'.$cari.'%')->get();

                // cari phone
                $phone          = Informasisub::where('nama_sub','LIKE','%'.$cari.'%')->get();
                $judul  = 'Pencarian key : "'.$cari.'"';
                break;
            
            case 'ulangtahuntanggalini':
                $judul  = 'Ulang tahun tanggal '.ambil_tgl().' bulan '.bulan_indo();
                $orang     = Orang::whereMonth('date_birth',ambil_bulan())->whereDay('date_birth',ambil_tgl())->orderBy('first_name','ASC')->limit(3)->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                break;
            
            case 'statistik':
                $orang  = Orang::all();
                break;

            default:
                return redirect('dashboard')->with('danger','tidak ada apa apa');
                break;
        }
        $data   = [
            'orang' => $orang,
            'informasi' => $informasi,
            'phone' => $phone,
        ];
        return view('sistem.list', compact('data','judul'));
    }

    // kalendar
    public function kalender()
    {
        // referensi
        // "id" => "required-id-2",
        // "name" => "Firman Day", 
        // "date" => ["2022-05-10","2022-05-13"] | "2022-05-12"
        // "type" => "event" | "holiday" | "birthday 
        // "everyYear" => false,
        // "description" =>"ini adalah hari yang spesial",
        // "color" => "#222"

        $data   = [];
        $linimasa   = Linimasa::orderBy('tanggal','desc')->get();
        foreach ($linimasa as $key) {
            $data[] = [
                "id" => $key->id,
                "name" => $key->nama, 
                "date" => $key->tanggal,
                "type" => "event", 
                "everyYear" => false,
                "description" => $key->keterangan,
                // "color" => "#222"
            ];
        }
        
        return view('chatomz.sistem.calendar', compact('data'));
    }
}

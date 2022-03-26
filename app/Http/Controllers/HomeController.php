<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Jejak;
use App\Models\Keluarga;
use App\Models\Orang;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('visitorhits');
    }
    public function index()
    {
        $dashboard  = TRUE;
        Session::put('menu','dashboard');
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
                return view('chatomz.admin.dashboard', compact('total','dashboard','info','gender','kematian'));
                break;
            default:
                return view('dashboard', compact('dashboard'));
                break;
        }
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
}

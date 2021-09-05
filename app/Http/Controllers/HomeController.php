<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Keluarga;
use App\Models\Orang;
use App\Models\Pemesanan;
use App\Models\Pendidikan;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        switch ($user->level) {

            case 'admin':
                $orang    = Orang::count();
                $grup      = Grup::count();
                $keluarga      = Keluarga::count();
                $pendidikan = Pendidikan::count();
                $total      = [
                    'orang' => $orang,
                    'grup' => $grup,
                    'keluarga' => $keluarga,
                    'pendidikan' => $pendidikan,
                ];
                return view('chatomz.admin.dashboard', compact('total'));
                break;

            default:
                return view('dashboard');
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

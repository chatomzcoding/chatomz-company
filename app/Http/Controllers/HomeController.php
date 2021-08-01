<?php

namespace App\Http\Controllers;

use App\Models\Orang;
use App\Models\Pemesanan;
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
                $totalproduk    = Produk::count();
                $totaltoko      = Toko::count();
                $totalhits      = Visitor::sum('hits');
                $totalpemesanan = Pemesanan::count();
                $total      = [
                    'produk' => $totalproduk,
                    'toko' => $totaltoko,
                    'hits' => $totalhits,
                    'pemesanan' => $totalpemesanan,
                ];
                return view('chatomz.admin.dashboard', compact('total'));
                break;

            case 'seller':
                $toko           = Toko::where('user_id',$user->id)->first();
                $totalproduk    = Produk::where('toko_id',$toko->id)->count();
                $totalpemesanan = DB::table('pemesanan')
                                    ->join('produk','pemesanan.produk_id','=','produk.id')
                                    ->where('produk.toko_id',$toko->id)
                                    ->count();
                $totalview      = Produk::where('toko_id',$toko->id)->sum('dilihat');
                $total      = [
                    'produk' => $totalproduk,
                    'pemesanan' => $totalpemesanan,
                    'view' => $totalview,
                ];
                return view('chatomz.seller.dashboard', compact('total'));
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

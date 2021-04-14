<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        switch ($user->level) {

            case 'admin':
                $totalproduk    = Produk::count();
                $total      = [
                    'produk' => $totalproduk,
                ];
                return view('chatomz.admin.dashboard', compact('total'));
                break;

            case 'seller':
                $toko           = Toko::where('user_id',$user->id)->first();
                $totalproduk    = Produk::where('toko_id',$toko->id)->count();
                $total      = [
                    'produk' => $totalproduk,
                ];
                return view('chatomz.seller.dashboard', compact('total'));
                break;

            default:
                return view('dashboard');
                break;
        }
    }
}

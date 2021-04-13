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
        if ($user->level == 'admin') {
            $toko           = NULL;
            $totalproduk    = Produk::count();
        } else {
            $toko           = Toko::where('user_id',$user->id)->first();
            $totalproduk    = Produk::where('toko_id',$toko->id)->count();
        }
        
        $total      = [
            'produk' => $totalproduk,
        ];
        
        return view('dashboard', compact('total'));
    }
}

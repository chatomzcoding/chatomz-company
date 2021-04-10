<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Infowebsite;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function show($slug)
    {
        $toko       = Toko::where('slug',$slug)->first();
        $info       = Infowebsite::first();
        $produk     = Produk::where('toko_id',$toko->id)->get();
        if ($toko) {
            return view('homepage.toko.show', compact('toko','info','produk'));
        } else {
            // jika toko tidak ada maka dialihkan ke halaman homepage
            return redirect('/');
        }
        
    }
}

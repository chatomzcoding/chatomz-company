<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Kategoriproduk;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function detail($slug)
    {
        $produk         = Produk::where('slug',$slug)->first();
        $kategori       = Kategoriproduk::find($produk->kategoriproduk_id);
        $produksama     = Produk::where('kategoriproduk_id',$kategori->id)->get();

        $view           = $produk->dilihat + 1;
        // tambahkan view saat masuk kehalaman ini
        Produk::where('id',$produk->id)->update([
            'dilihat' => $view,
        ]);
        return view('homepage.produk.show', compact('produk','kategori','produksama'));
    }

    public function kategori($slug)
    {
        $kategori       = Kategoriproduk::where('slug',$slug)->first();
        $listkategori   = Kategoriproduk::where('status','aktif')->get();
        $produk         = Produk::where('kategoriproduk_id',$kategori->id)->get();
        return view('homepage.produk.kategori', compact('kategori','listkategori','produk'));
    }
}

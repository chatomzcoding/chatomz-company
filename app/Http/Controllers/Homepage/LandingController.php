<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\Kategoriartikel;
use App\Models\Kategoriproduk;
use App\Models\Produk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $kategoriproduk     = Kategoriproduk::where('status','aktif')->orderBy('nama_kategori','ASC')->get();
        $produk             = Produk::limit(20);
        $iklan              = Iklan::where('posisi','market-atas')->first();
        $iklanbawah         = Iklan::where('posisi','market-bawah')->get();
        $artikel            = Artikel::limit(3)->get();
        $produkbaru         = Produk::limit(5)->orderBy('id','DESC')->get();
        $produksering       = Produk::limit(5)->orderBy('dilihat','ASC')->get();
        $slideproduk        = ['baru' => $produkbaru,'view'=>$produksering];
        return view('homepage.index', compact('kategoriproduk','produk','iklan','iklanbawah','artikel','slideproduk'));
    }

    public function view($file)
    {
        return view('homepage.'.$file);
    }

    public function blog()
    {
        $blog = Artikel::all();

        return view('homepage.blog', compact('blog'));
    }

    public function blogdetail($slug)
    {
        $kategori   = Kategoriartikel::all();
        $blog       = Artikel::where('slug',$slug)->first();
        $blogrecent = Artikel::where('id','<>',$blog->id)->orderBy('id','DESC')->limit(3)->get();
        return view('homepage.blog-detail', compact('blog','blogrecent','kategori'));
    }
}

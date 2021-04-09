<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\Kategoriartikel;
use App\Models\Kategoriproduk;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $kategoriproduk     = Kategoriproduk::where('status','aktif')->orderBy('nama_kategori','ASC')->get();
        $produk             = Produk::limit(20)->get();
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
        $blog = Artikel::paginate(4);
        $kategori   = Kategoriartikel::all();
        $blogrecent = Artikel::orderBy('id','DESC')->limit(3)->get();
        return view('homepage.blog.index', compact('blog','kategori','blogrecent'));
    }

    public function blogdetail($slug)
    {
        $kategori   = Kategoriartikel::all();
        $blog       = Artikel::where('slug',$slug)->first();
        $user       = User::find($blog->user_id);
        $blogrecent = Artikel::where('id','<>',$blog->id)->orderBy('id','DESC')->limit(3)->get();
        return view('homepage.blog.show', compact('blog','blogrecent','kategori','user'));
    }

    public function blogkategori($slug)
    {
        $kategori       = Kategoriartikel::all();
        $kategorifirst  = Kategoriartikel::where('slug',$slug)->first();
        $blog       = Artikel::where('kategoriartikel_id',$kategorifirst->id)->paginate(4);
        $blogrecent = Artikel::orderBy('id','DESC')->limit(3)->get();
        return view('homepage.blog.kategori', compact('blog','kategori','kategorifirst','blogrecent'));
    }
}

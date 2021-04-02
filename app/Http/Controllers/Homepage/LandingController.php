<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Kategoriartikel;
use App\Models\Kategoriproduk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $kategoriproduk     = Kategoriproduk::where('status','aktif')->get();
        return view('homepage.index', compact('kategoriproduk'));
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

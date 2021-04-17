<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\Kategoriartikel;
use App\Models\Kategoriproduk;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class LandingController extends Controller
{
    public function __construct()
    {
        $this->middleware('visitorhits');
    }

    public function index()
    {
        $kategoriproduk     = Kategoriproduk::where('status','aktif')->orderBy('nama_kategori','ASC')->get();
        $produk             = Produk::limit(20)->orderBy('id','DESC')->get();
        $iklan              = Iklan::where('posisi','market-atas')->first();
        $iklanbawah         = Iklan::where('posisi','market-bawah')->get();
        $artikel            = Artikel::limit(3)->get();
        $produkbaru         = Produk::limit(5)->orderBy('id','DESC')->get();
        $produksering       = Produk::limit(5)->orderBy('dilihat','ASC')->get();
        $slideproduk        = ['baru' => $produkbaru,'view'=>$produksering];
        return view('homepage.index', compact('kategoriproduk','produk','iklan','iklanbawah','artikel','slideproduk'));
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

    public function daftar()
    {
        return view('homepage.daftar');
    }
    
    public function simpandaftar(Request $request)
    {
        $request->validate([
            'logo_toko' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            'name' => ['required', 'string', 'max:255'],
            'profile_photo_path' => 'required|file|image|mimes:jpeg,png,jpg|max:1000',
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('profile_photo_path');
        
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'img/user';
        // isi dengan nama folder tempat kemana file diupload
        $file->move($tujuan_upload,$nama_file);


        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('logo_toko');
        
        $logo_toko = time()."_".$file->getClientOriginalName();
        $tujuan_uploadlogo = 'img/market/toko';
        // isi dengan nama folder tempat kemana file diupload
        $file->move($tujuan_uploadlogo,$logo_toko);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path' => $nama_file,
            'level' => 'seller',
        ]);

        User::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'profile_photo_path' => $nama_file,
        ]);

        $user   = User::where('email',$request->email)->first();
        
        Toko::create([
            'nama_toko'  => $request->nama_toko,
            'slug' => Str::slug($request->nama_toko),
            'user_id'  => $user->id,
            'keterangan_toko'  => $request->keterangan_toko,
            'no_hp'  => $request->no_hp,
            'alamat_toko'  => $request->alamat_toko,
            'logo_toko' => $logo_toko,
        ]);

        return redirect('/login')->with('status','Berhasil. Silahkan login untuk melanjutkan');
    }
}

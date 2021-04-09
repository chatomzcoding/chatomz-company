<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Infowebsite;
use App\Models\Kategoriproduk;
use App\Models\Produk;
use App\Models\Produkdiskon;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function detail($slug)
    {
        $produk         = Produk::where('slug',$slug)->first();
        $kategori       = Kategoriproduk::find($produk->kategoriproduk_id);
        $produksama     = Produk::where('kategoriproduk_id',$kategori->id)->where('id','<>',$produk->id)->get();
        $diskon         = Produkdiskon::where('produk_id',$produk->id)->first();
        $toko           = Toko::find($produk->toko_id);

        $view           = $produk->dilihat + 1;
        // tambahkan view saat masuk kehalaman ini
        Produk::where('id',$produk->id)->update([
            'dilihat' => $view,
        ]);
        $info           = Infowebsite::first();
        return view('homepage.produk.show', compact('produk','kategori','produksama','diskon','toko','info'));
    }

    public function kategori($slug)
    {
        $kategori       = Kategoriproduk::where('slug',$slug)->first();
        $listkategori   = Kategoriproduk::where('status','aktif')->orderBy('nama_kategori','ASC')->get();
        $produk         = Produk::where('kategoriproduk_id',$kategori->id)->paginate(9);
        $diskon         = DB::table('produk_diskon')
                            ->join('produk','produk_diskon.produk_id','=','produk.id')
                            ->join('kategori_produk','produk.kategoriproduk_id','=','kategori_produk.id')
                            ->select('produk.nama_produk','produk.slug','produk.poto_produk','produk.harga_produk','produk_diskon.nilai_diskon','kategori_produk.nama_kategori')
                            ->where('produk_diskon.tgl_awal','<=',tgl_sekarang())
                            ->where('produk_diskon.tgl_akhir','>=',tgl_sekarang())
                            ->get();
        $info           = Infowebsite::first();
        return view('homepage.produk.kategori', compact('kategori','listkategori','produk','diskon','info'));
    }

    public function cariproduk(Request $request)
    {
        $cari  = $request->nama_produk;
        
        return redirect('/h/produk/pencarian/'.$cari);
    }
    
    public function hasilpencarian($cari)
    {
        $produk      = Produk::where('nama_produk','LiKE','%'.$cari.'%')->paginate();
        $info        = Infowebsite::first();
        $kategori    = Kategoriproduk::where('status','aktif')->orderBy('nama_kategori','ASC')->get();
        return view('homepage.produk.cari', compact('produk','info','kategori','cari'));
    }
}

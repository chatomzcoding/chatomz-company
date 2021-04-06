<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Kategoriproduk;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = DB::table('produk')
                    ->join('kategori_produk','produk.kategoriproduk_id','=','kategori_produk.id')
                    ->select('produk.*','kategori_produk.nama_kategori')
                    ->get();
        return view('chatomz.market.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $toko       = Toko::all();
        $kategori   = Kategoriproduk::where('status','aktif')->get();
        return view('chatomz.market.produk.create', compact('toko','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'poto_produk' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
        ]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('poto_produk');
        
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'img/market/produk';
        // isi dengan nama folder tempat kemana file diupload
        $file->move($tujuan_upload,$nama_file);

        // sisa photo tambahan
        $nama_file1     = NULL;
        $nama_file2     = NULL;
        $nama_file3     = NULL;
        
        if (isset($request->poto_1)) {
            $request->validate([
                'poto_1' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('poto_1');
            
            $nama_file1 = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/market/produk';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file1);
        }
        if (isset($request->poto_2)) {
            $request->validate([
                'poto_2' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('poto_2');
            
            $nama_file2 = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/market/produk';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file2);
        }
        if (isset($request->poto_3)) {
            $request->validate([
                'poto_3' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('poto_3');
            
            $nama_file3 = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/market/produk';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file3);
        }

        Produk::create([
            'user_id'  => $request->user_id,
            'kategoriproduk_id'  => $request->kategoriproduk_id,
            'nama_produk'  => $request->nama_produk,
            'stok'  => $request->stok,
            'slug' => Str::slug($request->nama_produk),
            'harga_produk'  => default_nilai($request->harga_produk),
            'keterangan_produk'  => $request->keterangan_produk,
            'poto_produk' => $nama_file,
            'poto_1' => $nama_file1,
            'poto_2' => $nama_file2,
            'poto_3' => $nama_file3,
            'dilihat' => 0,
        ]);

        return redirect('/produk')->with('ds','Produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($produk)
    {
        $produk     = Produk::find(Crypt::decryptString($produk));
        return view('chatomz.market.produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($produk)
    {
        $produk     = Produk::find(Crypt::decryptString($produk));
        $kategori   = Kategoriproduk::where('status','aktif')->get();
        return view('chatomz.market.produk.edit', compact('produk','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $nama_file      = $produk->poto_produk;
        $nama_file1     = $produk->poto_1;
        $nama_file2     = $produk->poto_2;
        $nama_file3     = $produk->poto_3;
        if (isset($request->poto_produk)) {
            $request->validate([
                'poto_produk' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('poto_produk');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/market/produk';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
            deletefile($tujuan_upload.'/'.$produk->poto_produk);
        }

        
        if (isset($request->poto_1)) {
            $request->validate([
                'poto_1' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('poto_1');
            
            $nama_file1 = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/market/produk';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file1);
            deletefile($tujuan_upload.'/'.$produk->poto_1);

        }
        if (isset($request->poto_2)) {
            $request->validate([
                'poto_2' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('poto_2');
            
            $nama_file2 = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/market/produk';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file2);
            deletefile($tujuan_upload.'/'.$produk->poto_2);
        }
        if (isset($request->poto_3)) {
            $request->validate([
                'poto_3' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('poto_3');
            
            $nama_file3 = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/market/produk';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file3);
            deletefile($tujuan_upload.'/'.$produk->poto_3);
        }

        Produk::where('id',$produk->id)->update([
            'kategoriproduk_id'  => $request->kategoriproduk_id,
            'nama_produk'  => $request->nama_produk,
            'stok'  => $request->stok,
            'slug' => Str::slug($request->nama_produk),
            'harga_produk'  => default_nilai($request->harga_produk),
            'keterangan_produk'  => $request->keterangan_produk,
            'poto_produk' => $nama_file,
            'poto_1' => $nama_file1,
            'poto_2' => $nama_file2,
            'poto_3' => $nama_file3,
        ]);

        return redirect('/produk/'.Crypt::encryptString($produk->id))->with('du','Produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $tujuan_upload = 'img/market/produk';
        deletefile($tujuan_upload.'/'.$produk->poto_produk);
        deletefile($tujuan_upload.'/'.$produk->poto_1);
        deletefile($tujuan_upload.'/'.$produk->poto_2);
        deletefile($tujuan_upload.'/'.$produk->poto_3);
        $produk->delete();

        return redirect('/produk')->with('dd','Produk');
    }
}
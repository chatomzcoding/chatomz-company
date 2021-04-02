<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Kategoriproduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;


class KategoriprodukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategoriproduk::all();
        return view('chatomz.market.kategoriproduk.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation form
    //     $request->validate([
    //         'first_name' => 'required',
    //    ]);
        // validation form icon
        $request->validate([
            'icon' => 'required|file|image|mimes:jpeg,png,jpg|max:1000',
        ]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('icon');
        
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'img/market/kategoriproduk';
        // isi dengan nama folder tempat kemana file diupload
        $file->move($tujuan_upload,$nama_file);
        Kategoriproduk::create([
            'nama_kategori'  => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
            'keterangan'  => $request->keterangan,
            'icon' => $nama_file,
        ]);
        return redirect()->back()->with('ds','Kategori Produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategoriproduk  $kategoriproduk
     * @return \Illuminate\Http\Response
     */
    public function show(Kategoriproduk $kategoriproduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategoriproduk  $kategoriproduk
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategoriproduk $kategoriproduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategoriproduk  $kategoriproduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $kategoriproduk = Kategoriproduk::find($request->id);
        if (isset($request->icon)) {
            $request->validate([
                'icon' => 'required|file|image|mimes:jpeg,png,jpg|max:1000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('icon');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/market/kategoriproduk';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
            deletefile('img/market/kategoriproduk/'.$kategoriproduk->icon);

        } else {
            $nama_file = $kategoriproduk->icon;
        }
        
        Kategoriproduk::where('id',$request->id)->update([
            'nama_kategori'  => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
            'keterangan'  => $request->keterangan,
            'status'  => $request->status,
            'icon' => $nama_file,
        ]);
        return redirect()->back()->with('du','Kategori Produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategoriproduk  $kategoriproduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategoriproduk $kategoriproduk)
    {
        deletefile('img/market/kategoriproduk/'.$kategoriproduk->icon);
        $kategoriproduk->delete();

        return redirect()->back()->with('dd','Kategori Produk');
    }
}

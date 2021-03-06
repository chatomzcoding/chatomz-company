<?php

namespace App\Http\Controllers\Bisnis;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'poto_produk' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
        ]);
        $tujuan_upload = 'public/img/company/bisnis';
        $file = $request->file('poto_produk');
        $nama_file = time()."_".$file->getClientOriginalName();
        $file->move($tujuan_upload,$nama_file);

        Produk::create([
            'usaha_id' => $request->usaha_id,
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => default_nilai($request->harga),
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'aplikasi' => $request->aplikasi,
            'poto_produk' => $nama_file,
        ]);

        return redirect()->back()->with('ds','Produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $produk     = Produk::find($request->id);
        if (isset($request->poto_produk)) {
            $request->validate([
                'poto_produk' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            $tujuan_upload = 'public/img/company/bisnis';
            $file = $request->file('poto_produk');
            $nama_file = time()."_".$file->getClientOriginalName();
            $file->move($tujuan_upload,$nama_file);
            deletefile($tujuan_upload.'/'.$produk->poto_produk);
        } else {
            $nama_file  = $produk->poto_produk;
        }

        Produk::where('id',$produk->id)->update([
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => default_nilai($request->harga),
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'poto_produk' => $nama_file,
        ]);

        return back()->with('du','Produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $tujuan_upload = 'public/img/company/bisnis';
        deletefile($tujuan_upload.'/'.$produk->poto_produk);
        $produk->delete();

        return redirect()->back()->with('dd','Produk');
    }
}

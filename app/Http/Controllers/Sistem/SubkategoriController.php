<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Subkategori;
use Illuminate\Http\Request;

class SubkategoriController extends Controller
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
        if (isset($request->gambar_sub)) {
            $request->validate([
                'gambar_sub' => 'required|file|image|mimes:jpeg,png,jpg,webp|max:5000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar_sub');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'public/img/kategori/sub';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
            // deletefile($tujuan_upload.'/'.$user->photo);
        } else {
            $nama_file = NULL;
        }
        Subkategori::create([
            'kategori_id' => $request->kategori_id,
            'nama_sub' => $request->nama_sub,
            'keterangan_sub' => $request->keterangan_sub,
            'gambar_sub' => $nama_file,
        ]);

        return back()->with('ds','Sub Kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function show(Subkategori $subkategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Subkategori $subkategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $subkategori = Subkategori::find($request->id);
        if (isset($request->gambar_sub)) {
            $request->validate([
                'gambar_sub' => 'required|file|image|mimes:jpeg,png,jpg,webp|max:5000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar_sub');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'public/img/kategori/sub';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
            deletefile($tujuan_upload.'/'.$subkategori->gambar_sub);
        } else {
            $nama_file = $subkategori->gambar_sub;
        }
        Subkategori::where('id',$request->id)->update([
            'nama_sub' => $request->nama_sub,
            'keterangan_sub' => $request->keterangan_sub,
            'gambar_sub' => $nama_file,
        ]);

        return back()->with('du','Sub Kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subkategori $subkategori)
    {
        deletefile('public/img/kategori/sub/'.$subkategori->gambar_sub);
        $subkategori->delete();

        return back()->with('dd','Sub Kategori');
    }
}

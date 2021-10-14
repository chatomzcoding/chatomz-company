<?php

namespace App\Http\Controllers\Company\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Hewanjenis;
use Illuminate\Http\Request;

class HewanjenisController extends Controller
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
         // validation form photo
         $request->validate([
            'gambar_jenis' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            'nama_jenis' => 'unique:hewan_jenis'
        ]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('gambar_jenis');
        
        $tujuan_upload = 'public/img/company/informasi/hewan/';

        $nama_file = kompres($file,$tujuan_upload,400);
            
       Hewanjenis::create([
           'hewan_id' => $request->hewan_id,
           'nama_jenis' => strtolower($request->nama_jenis),
           'nama_latin_jenis' => strtolower($request->nama_latin_jenis),
           'tentang_jenis' => $request->tentang_jenis,
           'pemakan' => $request->pemakan,
           'lama_hidup' => $request->lama_hidup,
           'klasifikasi' => $request->klasifikasi,
           'gambar_jenis' => $nama_file,
       ]);

        return redirect()->back()->with('dsc','Jenis '.$request->nama_jenis.' telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hewanjenis  $hewanjenis
     * @return \Illuminate\Http\Response
     */
    public function show(Hewanjenis $hewanjenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hewanjenis  $hewanjenis
     * @return \Illuminate\Http\Response
     */
    public function edit(Hewanjenis $hewanjenis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hewanjenis  $hewanjenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $hewan = Hewanjenis::find($request->id);
        if (isset($request->gambar_jenis)) {
            // validation form photo
            $request->validate([
                'gambar_jenis' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
                'nama' => 'unique:hewan'
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar_jenis');
            
            $tujuan_upload = 'public/img/company/informasi/hewan/';
    
            $nama_file = kompres($file,$tujuan_upload,400);
            
            deletefile($tujuan_upload.$hewan->gambar_jenis);
        } else {
            $nama_file = $hewan->gambar_jenis;
        }
        
            
       Hewanjenis::where('id',$request->id)->update([
            'nama_jenis' => strtolower($request->nama_jenis),
            'nama_latin_jenis' => strtolower($request->nama_latin_jenis),
            'tentang_jenis' => $request->tentang_jenis,
            'pemakan' => $request->pemakan,
            'lama_hidup' => $request->lama_hidup,
            'klasifikasi' => $request->klasifikasi,
            'gambar_jenis' => $nama_file,
       ]);

        return redirect()->back()->with('du','Jenis Hewan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hewanjenis  $hewanjenis
     * @return \Illuminate\Http\Response
     */
    public function destroy($hewanjenis)
    {
        $hewanjenis  = Hewanjenis::find($hewanjenis);

        deletefile('public/img/company/informasi/hewan/'.$hewanjenis->gambar_jenis);

        $hewanjenis->delete();

        return redirect()->back()->with('dd','Jenis Hewan');
    }
}

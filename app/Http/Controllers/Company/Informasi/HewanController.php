<?php

namespace App\Http\Controllers\Company\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Hewan;
use App\Models\Hewanjenis;
use App\Models\Informasi;
use App\Models\Informasisub;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rules\Unique;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori   = Kategori::where('nama_kategori','hewan')->first();
        $hewan  = Informasi::where('kategori_id',$kategori->id)->get();
        return view('company.informasi.hewan.index', compact('hewan'));
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
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            'nama' => 'unique:hewan'
        ]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('gambar');
        
        $tujuan_upload = 'public/img/company/informasi/hewan/';

        $nama_file = kompres($file,$tujuan_upload,400);
            
       Hewan::create([
           'nama' => strtolower($request->nama),
           'nama_latin' => strtolower($request->nama_latin),
           'tentang' => $request->tentang,
           'gambar' => $nama_file,
       ]);

        return redirect()->back()->with('ds','Hewan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hewan  $hewan
     * @return \Illuminate\Http\Response
     */
    public function show($hewan)
    {
        // $hewan  = Hewan::find(Crypt::decryptString($hewan));
        $hewan  = Informasi::find(Crypt::decryptString($hewan));
        // $jenis  = Hewanjenis::where('hewan_id',$hewan->id)->get();
        $jenis  = Informasisub::where('informasi_id',$hewan->id)->get();

        return view('company.informasi.hewan.show', compact('hewan','jenis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hewan  $hewan
     * @return \Illuminate\Http\Response
     */
    public function edit(Hewan $hewan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hewan  $hewan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $hewan = Hewan::find($request->id);
        if (isset($request->gambar)) {
            // validation form photo
            $request->validate([
                'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
                'nama' => 'unique:hewan'
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar');
            
            $tujuan_upload = 'public/img/company/informasi/hewan/';
    
            $nama_file = kompres($file,$tujuan_upload,400);
            
            deletefile($tujuan_upload.$hewan->gambar);
        } else {
            $nama_file = $hewan->gambar;
        }
        
            
       Hewan::where('id',$request->id)->update([
           'nama' => strtolower($request->nama),
           'nama_latin' => strtolower($request->nama_latin),
           'tentang' => $request->tentang,
           'gambar' => $nama_file,
       ]);

        return redirect()->back()->with('du','Hewan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hewan  $hewan
     * @return \Illuminate\Http\Response
     */
    public function destroy($hewan)
    {
        $hewan  = Hewan::find($hewan);

        deletefile('public/img/company/informasi/hewan/'.$hewan->gambar);

        $hewan->delete();

        return redirect()->back()->with('dd','Hewan');
    }
}

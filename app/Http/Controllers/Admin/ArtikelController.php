<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Kategoriartikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder = 'img/admin/artikel';


    public function index()
    {
          $artikel    = DB::table('artikel')
                        ->join('kategori_artikel','artikel.kategoriartikel_id','=','kategori_artikel.id')
                        ->select('artikel.*','kategori_artikel.nama_kategori')
                        ->orderByDesc('artikel.id')
                        ->get();
        $kategori   = Kategoriartikel::all();

        return view('chatomz.admin.artikel.index', compact('artikel','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori   = Kategoriartikel::all();

        return view('chatomz.admin.artikel.create', compact('kategori'));
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
            'gambar_artikel' => 'required|file|image|mimes:jpeg,png,jpg|max:4000',
        ]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('gambar_artikel');
        
        $nama_file = time()."_".$file->getClientOriginalName();
        
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = $this->folder;
        $file->move($tujuan_upload,$nama_file);

        Artikel::create([
            'user_id' => Auth::user()->id,
            'judul_artikel' => $request->judul_artikel,
            'slug' => Str::slug($request->judul_artikel),
            'isi_artikel' => $request->isi_artikel,
            'kategoriartikel_id' => $request->kategoriartikel_id,
            'view' => 0,
            'gambar_artikel' => $nama_file,
        ]);

        return redirect('/artikel')->with('ds', 'Artikel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show($artikel)
    {
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit($artikel)
    {
        $artikel = Artikel::find(Crypt::decryptString($artikel));
        $kategori   = Kategoriartikel::all();
        return view('chatomz.admin.artikel.edit', compact('kategori','artikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        if (isset($request->gambar_artikel)) {
            $request->validate([
                'gambar_artikel' => 'required|file|image|mimes:jpeg,png,jpg|max:4000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar_artikel');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = $this->folder;
            $file->move($tujuan_upload,$nama_file);

            deletefile($tujuan_upload.'/'.$artikel->gambar_artikel);
        } else {
            $nama_file = $artikel->gambar_artikel;
        }
        

        Artikel::where('id',$artikel->id)->update([
            'judul_artikel' => $request->judul_artikel,
            'slug' => Str::slug($request->judul_artikel),
            'isi_artikel' => $request->isi_artikel,
            'kategoriartikel_id' => $request->kategoriartikel_id,
            'gambar_artikel' => $nama_file,
        ]);

        return redirect('/artikel')->with('du', 'Artikel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        //
    }
}

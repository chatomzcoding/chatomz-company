<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $label = (isset($_GET['label'])) ? $_GET['label'] : 'semua' ;
        if ($label == 'semua') {
            $kategori   = Kategori::all();
        } else {
            $kategori   = Kategori::where('label',$label)->get();
        }
        $main   = [
            'filter' => [
                'label' => $label
            ]
        ];

        return view('chatomz.admin.kategori.index', compact('main','kategori'));
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
        if (isset($request->gambar)) {
            $request->validate([
                'gambar' => 'required|file|image|mimes:jpeg,png,jpg,webp|max:5000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'public/img/kategori';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
            // deletefile($tujuan_upload.'/'.$user->photo);
        } else {
            $nama_file = NULL;
        }
        Kategori::create([
            'nama_kategori' => strtolower($request->nama_kategori),
            'label' => strtolower($request->label),
            'keterangan_kategori' => $request->keterangan_kategori,
            'gambar' => $nama_file,
        ]);

        return redirect()->back()->with('ds','Kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $kategori   = Kategori::find($request->id);
        if (isset($request->gambar)) {
            $request->validate([
                'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'public/img/kategori';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
            deletefile($tujuan_upload.'/'.$kategori->gambar);
        } else {
            $nama_file = $kategori->gambar;
        }
        Kategori::where('id',$request->id)->update([
            'nama_kategori' => strtolower($request->nama_kategori),
            'label' => strtolower($request->label),
            'keterangan_kategori' => $request->keterangan_kategori,
            'gambar' => $nama_file,
        ]);

        return redirect()->back()->with('du','Kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $tujuan_upload = 'public/img/kategori';
        deletefile($tujuan_upload.'/'.$kategori->gambar);
        $kategori->delete();

        return back()->with('dd','Kategori');
    }
}

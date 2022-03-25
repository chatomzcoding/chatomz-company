<?php

namespace App\Http\Controllers\Bisnis;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Orang;
use App\Models\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usaha  = Usaha::with('orang')->latest()->get();
        $orang  = Orang::orderBy('first_name')->get(['id','first_name','last_name','death']);
        return view('company.bisnis.usaha.index', compact('usaha','orang'));
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
        if (isset($request->gambar_lokasi)) {
            $request->validate([
                'gambar_lokasi' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            ]);
            $tujuan_upload = 'public/img/company/bisnis/usaha';
            $file = $request->file('gambar_lokasi');
            $nama_file = time()."_".$file->getClientOriginalName();
            $file->move($tujuan_upload,$nama_file);
        } else {
            $nama_file  = NULL;
        }

        Usaha::create([
            'nama_usaha' => $request->nama_usaha,
            'lokasi' => $request->lokasi,
            'orang_id' => $request->orang_id,
            'bidang' => $request->bidang,
            'gambar_lokasi' => $nama_file,
        ]);

        return back()->with('ds','Usaha');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function show($usaha)
    {
        $usaha  = Usaha::with('orang','produk')->find(Crypt::decryptString($usaha));
        $kategori = Kategori::where('label','produk')->get();
        $orang  = Orang::orderBy('first_name')->get(['id','first_name','last_name','death']);
        return view('company.bisnis.usaha.show', compact('usaha','kategori','orang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function edit(Usaha $usaha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $usaha  = Usaha::find($request->id);
        if (isset($request->gambar_lokasi)) {
            $request->validate([
                'gambar_lokasi' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            ]);
            $tujuan_upload = 'public/img/company/bisnis/usaha';
            $file = $request->file('gambar_lokasi');
            $nama_file = time()."_".$file->getClientOriginalName();
            $file->move($tujuan_upload,$nama_file);
            deletefile($tujuan_upload.'/'.$usaha->gambar_lokasi);
        } else {
            $nama_file  = $usaha->gambar_lokasi;
        }

        Usaha::where('id',$usaha->id)->update([
            'nama_usaha' => $request->nama_usaha,
            'lokasi' => $request->lokasi,
            'orang_id' => $request->orang_id,
            'bidang' => $request->bidang,
            'status' => $request->status,
            'gambar_lokasi' => $nama_file,
        ]);

        return back()->with('du','Usaha');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usaha $usaha)
    {
        $tujuan_upload = 'public/img/company/bisnis/usaha';
        deletefile($tujuan_upload.'/'.$usaha->gambar_lokasi);
        $usaha->delete();

        return back()->with('dd','Usaha');
    }
}

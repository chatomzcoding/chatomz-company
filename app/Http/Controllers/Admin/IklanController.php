<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iklan;
use Illuminate\Http\Request;

class IklanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iklan  = Iklan::all();

        return view('chatomz.admin.iklan.index', compact('iklan'));
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
            'gambar_iklan' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('gambar_iklan');
        
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'img/admin/iklan';
        // isi dengan nama folder tempat kemana file diupload
        $file->move($tujuan_upload,$nama_file);
        Iklan::create([
            'nama_iklan'  => $request->nama_iklan,
            'deskripsi'  => $request->deskripsi,
            'posisi'  => $request->posisi,
            'link'  => $request->link,
            'teks_kecil'  => $request->teks_kecil,
            'teks_penting'  => $request->teks_penting,
            'nama_link'  => $request->nama_link,
            'gambar_iklan' => $nama_file,
        ]);
        return redirect()->back()->with('ds','Iklan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Iklan  $iklan
     * @return \Illuminate\Http\Response
     */
    public function show(Iklan $iklan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Iklan  $iklan
     * @return \Illuminate\Http\Response
     */
    public function edit(Iklan $iklan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Iklan  $iklan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $iklan  = Iklan::find($request->id);
        if (isset($request->gambar_iklan)) {
            $request->validate([
                'gambar_iklan' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar_iklan');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/admin/iklan';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
            deletefile($tujuan_upload.'/'.$iklan->gambar_iklan);
        } else {
            $nama_file  = $iklan->gambar_iklan;
        }
        
        Iklan::where('id',$request->id)->update([
            'nama_iklan'  => $request->nama_iklan,
            'deskripsi'  => $request->deskripsi,
            'posisi'  => $request->posisi,
            'link'  => $request->link,
            'teks_kecil'  => $request->teks_kecil,
            'teks_penting'  => $request->teks_penting,
            'nama_link'  => $request->nama_link,
            'status'  => $request->status,
            'gambar_iklan' => $nama_file,
        ]);
        return redirect()->back()->with('du','Iklan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Iklan  $iklan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Iklan $iklan)
    {
        $tujuan_upload = 'img/admin/iklan';
        deletefile($tujuan_upload.'/'.$iklan->gambar_iklan);

        $iklan->delete();
        return redirect()->back()->with('dd','Iklan');
    }
}

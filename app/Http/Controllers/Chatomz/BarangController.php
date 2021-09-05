<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang     = Barang::all();

        return view('chatomz.kingdom.barang.index', compact('barang'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $barang     = Barang::find($request->id);
        if (isset($request->photo_barang)) {
            // validation form photo
            $request->validate([
                'photo_barang' => 'required|file|image|mimes:jpeg,png,jpg|max:3000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('photo_barang');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'public/img/chatomz/barang';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);

            // $nama_file1 = kompres($file,$tujuan_upload);
            
        } else {
            $nama_file =$barang->photo_barang;
        }
       Barang::where('id',$request->id)->update([
           'nama_barang' => $request->nama_barang,
           'photo_barang' => $nama_file,
       ]);

        return redirect()->back()->with('du','Barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        //
    }
}

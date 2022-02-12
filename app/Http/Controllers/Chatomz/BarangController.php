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
            $request->validate([
                'photo_barang' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            ]);
            $tujuan_upload = 'public/img/chatomz/barang';
            $file = $request->file('photo_barang');
            $mini = $request->file('photo_barang');
            $mg_barang = kompres($mini,$tujuan_upload,150,'mini');
            $nama_file = time()."_".$file->getClientOriginalName();
            $file->move($tujuan_upload,$nama_file);

            deletefile($tujuan_upload.'/'.$barang->photo_barang);
            deletefile($tujuan_upload.'/'.$barang->mg_barang);
        } else {
            $nama_file =$barang->photo_barang;
            $mg_barang =$barang->mg_barang;
        }

        Barang::where('id',$request->id)->update([
            'nama_barang' => $request->nama_barang,
            'photo_barang' => $nama_file,
            'mg_barang' => $mg_barang,
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
        $tujuan_upload = 'public/img/chatomz/barang';
        deletefile($tujuan_upload.'/'.$barang->photo_barang);
        deletefile($tujuan_upload.'/'.$barang->mg_barang);
        $barang->delete();
        return back()->with('dd','Barang');
    }
}

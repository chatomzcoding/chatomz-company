<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;


class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko   = Toko::all();
        $user   = User::where('level','seller')->get();
        return view('chatomz.market.toko.index', compact('toko','user'));
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
            'logo_toko' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
        ]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('logo_toko');
        
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'img/market/toko';
        // isi dengan nama folder tempat kemana file diupload
        $file->move($tujuan_upload,$nama_file);
        Toko::create([
            'nama_toko'  => $request->nama_toko,
            'slug' => Str::slug($request->nama_toko),
            'user_id'  => $request->user_id,
            'keterangan_toko'  => $request->keterangan_toko,
            'no_hp'  => $request->no_hp,
            'alamat_toko'  => $request->alamat_toko,
            'logo_toko' => $nama_file,
        ]);
        return redirect()->back()->with('ds','Toko');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function show($toko)
    {
        $toko   = Toko::find(Crypt::decryptString($toko));

        return view('chatomz.seller.toko.show', compact('toko'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function edit(Toko $toko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $toko   = Toko::find($request->id);
        if (isset($request->logo_toko)) {
            $request->validate([
                'logo_toko' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('logo_toko');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/market/toko';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
            deletefile($tujuan_upload.'/'.$toko->logo_toko);
        } else {
            $nama_file  = $toko->logo_toko;
        }
        
        Toko::where('id',$request->id)->update([
            'nama_toko'  => $request->nama_toko,
            'slug' => Str::slug($request->nama_toko),
            'user_id'  => $request->user_id,
            'keterangan_toko'  => $request->keterangan_toko,
            'no_hp'  => $request->no_hp,
            'alamat_toko'  => $request->alamat_toko,
            'logo_toko' => $nama_file,
        ]);

        return redirect()->back()->with('du','Toko');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toko $toko)
    {
        $tujuan_upload = 'img/market/toko';
        deletefile($tujuan_upload.'/'.$toko->logo_toko);
        $toko->delete();
        return redirect()->back()->with('du','Toko');
    }
}

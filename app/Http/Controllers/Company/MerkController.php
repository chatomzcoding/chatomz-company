<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merk   = Merk::all();
        return view('company.merk.index', compact('merk'));
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
            'logo' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('logo');
        
        $tujuan_upload = 'public/img/company/merk/';

        $nama_file = kompres($file,$tujuan_upload,600);
            
       Merk::create([
           'nama' => strtolower($request->nama),
           'tentang' => $request->tentang,
           'logo' => $nama_file,
       ]);

        return redirect()->back()->with('ds','Merk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function show(Merk $merk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function edit(Merk $merk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $hewan = Merk::find($request->id);
        if (isset($request->logo)) {
            // validation form photo
            $request->validate([
                'logo' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('logo');
            
            $tujuan_upload = 'public/img/company/merk/';
    
            $nama_file = kompres($file,$tujuan_upload,600);
            
            deletefile($tujuan_upload.$hewan->logo);
        } else {
            $nama_file = $hewan->logo;
        }
        
            
       Merk::where('id',$request->id)->update([
           'nama' => strtolower($request->nama),
           'tentang' => $request->tentang,
           'logo' => $nama_file,
       ]);

        return redirect()->back()->with('du','Merk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function destroy($merk)
    {
        $merk  = Merk::find($merk);

        deletefile('public/img/company/merk/'.$merk->logo);

        $merk->delete();

        return redirect()->back()->with('dd','Merk');
    }
}

<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Jejakpoto;
use Illuminate\Http\Request;

class JejakpotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $folder = 'public/img/chatomz/jejak';

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
            // validation form gambar_jejak
            $request->validate([
                'poto' => 'required|file|image|mimes:jpeg,png,jpg|max:10000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('poto');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($this->folder,$nama_file);

            // $nama_file = kompres($file,$tujuan_upload,1200);
            
        Jejakpoto::create([
            'jejak_id'  => $request->jejak_id,
            'poto' => $nama_file,
            'ket_poto' => $request->ket_poto,
        ]);

        return redirect()->back()->with('ds','Jejak');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jejakpoto  $jejakpoto
     * @return \Illuminate\Http\Response
     */
    public function show(Jejakpoto $jejakpoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jejakpoto  $jejakpoto
     * @return \Illuminate\Http\Response
     */
    public function edit(Jejakpoto $jejakpoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jejakpoto  $jejakpoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jejakpoto $jejakpoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jejakpoto  $jejakpoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jejakpoto $jejakpoto)
    {
        //
    }
}

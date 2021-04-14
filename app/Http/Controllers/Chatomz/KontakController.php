<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\Orang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function show(Kontak $kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function edit($kontak)
    {
        $kontak     = Kontak::find(Crypt::decryptString($kontak));
        $orang      = Orang::find($kontak->id);
        return view('chatomz.kingdom.kontak.edit', compact('kontak','orang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontak $kontak)
    {
        Kontak::where('id',$kontak->id)->update([
            'no_hp' => $request->no_hp,
            'no_tel' => $request->no_tel,
            'no_wa' => $request->no_wa,
            'no_office' => $request->no_office,
            'email' => $request->email,
            'office_email' => $request->office_email,
            'fb' => $request->fb,
            'tw' => $request->tw,
            'web' => $request->web,
            'ig' => $request->ig,
            'line' => $request->line,
            
        ]);

        return redirect('/orang/'.Crypt::encryptString($kontak->orang_id))->with('du','Kontak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontak $kontak)
    {
        //
    }
}

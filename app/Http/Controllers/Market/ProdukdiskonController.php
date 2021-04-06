<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Produkdiskon;
use Illuminate\Http\Request;

class ProdukdiskonController extends Controller
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
        Produkdiskon::create($request->all());

        return redirect()->back()->with('ds','Diskon');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produkdiskon  $produkdiskon
     * @return \Illuminate\Http\Response
     */
    public function show(Produkdiskon $produkdiskon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produkdiskon  $produkdiskon
     * @return \Illuminate\Http\Response
     */
    public function edit(Produkdiskon $produkdiskon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produkdiskon  $produkdiskon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $produkdiskon)
    {
        Produkdiskon::where('id',$produkdiskon)->update([
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
            'nilai_diskon' => $request->nilai_diskon,
            'nama_diskon' => $request->nama_diskon,
        ]);
        
        return redirect()->back()->with('du','Diskon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produkdiskon  $produkdiskon
     * @return \Illuminate\Http\Response
     */
    public function destroy($produkdiskon)
    {
        $produkdiskon   = Produkdiskon::find($produkdiskon);
        $produkdiskon->delete();

        return redirect()->back()->with('dd','Diskon');
    }
}

<?php

namespace App\Http\Controllers\Api\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Hewan;
use App\Models\Hewanjenis;
use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori   = Kategori::where('nama_kategori','hewan')->first();
        if ($kategori) {
            return Informasi::where('kategori_id',$kategori->id)->orderBy('nama','ASC')->get();
        } else {
            return NULL;
        }
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
     * @param  \App\Models\Hewan  $hewan
     * @return \Illuminate\Http\Response
     */
    public function show($hewan)
    {
        $hewan  = Hewan::find($hewan);
        if ($hewan) {
            $jenis  = Hewanjenis::where('hewan_id',$hewan->id)->get();
            $data   = [
                'hewan' => $hewan,
                'jenis' => $jenis,
            ];
            return $data;
        } else {
            return response()->json('Hewan Tidak ada');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hewan  $hewan
     * @return \Illuminate\Http\Response
     */
    public function edit(Hewan $hewan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hewan  $hewan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hewan $hewan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hewan  $hewan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hewan $hewan)
    {
        //
    }
}

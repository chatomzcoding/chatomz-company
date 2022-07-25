<?php

namespace App\Http\Controllers\Api\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MasakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result     = [];
        if (chatomz_token()) {
            $kategori   = Kategori::where('nama_kategori','masakan')->where('label','informasi')->first();
            if ($kategori) {
                // sesi get
                $sesi = (isset($_GET['sesi'])) ? $_GET['sesi'] : 'index' ;
                switch ($sesi) {
                    case 'cari':
                        $query = (isset($_GET['query'])) ? $_GET['query'] : ' ' ;
                        $query = str_replace('-',' ',$query);
                        $result = Informasi::where('kategori_id',$kategori->id)->where('nama','LIKE','%'.$query.'%')->get();
                        break;
                    
                    default:
                        $result = Informasi::where('kategori_id',$kategori->id)->get();
                        break;
                }
            }
        }
        return $result;
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
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function show(Informasi $informasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Informasi $informasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Informasi $informasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informasi $informasi)
    {
        //
    }
}

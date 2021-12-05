<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Gadgethandphone;
use App\Models\Informasi;
use App\Models\Informasisub;
use App\Models\Kategori;
use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merk       = Merk::all();
        $kategori   = Kategori::where('nama_kategori','gadget')->first();
        if ($kategori) {
            foreach ($merk as $item) {
                $detail     = [
                    'tentang' => $item->tentang
                ];
                Informasi::create([
                    'kategori_id' => $kategori->id,
                    'nama' => $item->nama,
                    'gambar' => $item->logo,
                    'detail' => json_encode($detail),
                ]);
            }
        }else{
            echo 'belum ada kategori';
        }
        die();
        $id         = Crypt::decrypt($_GET['k']);
        $kategori   = Kategori::find($id);
        $data       = Informasi::where('kategori_id',$id)->get();
        switch ($kategori->nama_kategori) {
            case 'otomotif':
                return view('company.informasi.otomotif.index', compact('kategori','data'));
                break;

            case 'hewan':
                return view('company.informasi.hewan.index', compact('kategori','data'));
                break;
            
            default:
                # code...
                break;
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
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function show(Informasi $informasi)
    {
        $kategori   = Kategori::find($informasi->kategori_id);
        $sub        = Informasisub::where('informasi_id',$informasi->id)->get();
        switch ($kategori->nama_kategori) {
            case 'hewan':
                return view('company.informasi.hewan.show', compact('informasi','sub'));
                break;
            
            default:
                # code...
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Informasi $informasi)
    {
        
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

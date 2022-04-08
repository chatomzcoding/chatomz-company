<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Informasisub;
use App\Models\Kategori;
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
        $kategori_id = (isset($_GET['id'])) ? $_GET['id'] : 'semua' ;
        if ($kategori_id == 'semua') {
            $kategori   = Kategori::where('label','informasi')->get();
            return view('company.informasi.index', compact('kategori'));
        } else {
            $kategori   = Kategori::find($kategori_id);
            $data       = Informasi::where('kategori_id',$kategori->id)->get();
            switch ($kategori->nama_kategori) {
                case 'hewan':
                    return view('company.informasi.hewan.index', compact('kategori','data'));
                    break;
                case 'otomotif':
                    return view('company.informasi.otomotif.index', compact('kategori','data'));
                    break;
                case 'gadget':
                    return view('company.informasi.gadget.index', compact('kategori','data'));
                    break;
                
                default:
                    return redirect('informasi');
                    break;
            }
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
            case 'gadget':
                return view('company.informasi.gadget.show', compact('informasi','sub'));
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

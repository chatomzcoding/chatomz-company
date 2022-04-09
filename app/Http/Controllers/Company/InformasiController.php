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
        switch ($kategori->nama_kategori) {
            case 'hewan':
                return view('company.informasi.hewan.show', compact('informasi'));
                break;
            case 'gadget':
                return view('company.informasi.gadget.show', compact('informasi'));
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
    public function update(Request $request)
    {
        $informasi = Informasi::find($request->id);
        switch ($request->sesi) {
            case 'hewan':
                $tujuan_upload = 'public/img/company/informasi/hewan';
                $detail     = [
                    'nama_latin' => $request->nama_latin,
                    'tentang' => $request->tentang,
                ];
                break;
                
            default:
                return back();
                break;
        }

        if (isset($request->gambar)) {
            $request->validate([
                'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            $file = $request->file('gambar');
            $gambar = time()."_".$file->getClientOriginalName();
            $file->move($tujuan_upload,$gambar);
            deletefile($tujuan_upload.'/'.$informasi->gambar);
        } else {
            $gambar = $informasi->gambar;
        }
        Informasi::where('id',$request->id)->update([
            'nama' => $request->nama,
            'gambar' => $gambar,
            'detail' => json_encode($detail)
        ]);

        return back()->with('du','Hewan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informasi $informasi)
    {
        switch ($informasi->kategori->namakategori) {
            case 'hewan':
                $tujuan_upload = 'public/img/company/informasi/hewan';
                deletefile($tujuan_upload.'/'.$informasi->gambar);
                break;
        }

        $informasi->delete();

        return back()->with('dd','Hewan');
    }
}

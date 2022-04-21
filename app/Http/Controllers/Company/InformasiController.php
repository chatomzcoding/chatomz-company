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
            $data       = Informasi::where('kategori_id',$kategori->id)->orderBy('nama','ASC')->get();
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
                case 'film':
                    return view('company.informasi.film.index', compact('kategori','data'));
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
        switch ($request->sesi) {
            case 'hewan':
                $tujuan_upload = 'public/img/company/informasi/hewan';
                $detail     = [
                    'nama_latin' => $request->nama_latin,
                    'tentang' => $request->tentang,
                ];
                $kategori   = Kategori::where('nama_kategori','hewan')->first();
                $notif  = 'Infomasi Hewan';
                break;
            case 'film':
                $notif = 'Informasi Film';
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://www.omdbapi.com/?apikey=d7039757&s='.$request->cari,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $data = json_decode($response);

                $kategori   = Kategori::where('nama_kategori','film')->first();

                foreach ($data->Search as $key) {
                    $judul = $key->Title;
                    $gambar = $key->Poster;
                    $tahun = $key->Year;
                    $id = $key->imdbID;
                    $type = $key->Type;

                    // cek apakah sudah ada di server atau belum
                    $cekinformasi = Informasi::where('nama',$judul)->where('gambar',$gambar)->first();
                    if (!$cekinformasi) {
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://www.omdbapi.com/?apikey=d7039757&i='.$id,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        ));
        
                        $response = curl_exec($curl);
        
                        curl_close($curl);

                        Informasi::create([
                            'kategori_id' => $kategori->id,
                            'nama' => $judul,
                            'gambar' => $gambar,
                            'detail' => $response
                        ]);
                    }

                }
                return back()->with('ds',$notif);
                
                break;
                
            default:
                return back();
                break;
        }
        if ($kategori) {
            $request->validate([
                'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            $file = $request->file('gambar');
            $gambar = time()."_".$file->getClientOriginalName();
            $file->move($tujuan_upload,$gambar);
    
            Informasi::create([
                'kategori_id' => $kategori->id,
                'nama' => $request->nama,
                'gambar' => $gambar,
                'detail' => json_encode($detail)
            ]);
    
            return back()->with('ds',$notif);
        }
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
            case 'film':
                return view('company.informasi.film.show', compact('informasi'));
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
                $notif = 'Informasi Hewan';
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

        return back()->with('du',$notif);
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

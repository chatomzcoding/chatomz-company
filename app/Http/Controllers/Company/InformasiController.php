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
            // hapus semua
            if (isset($_GET['hapus'])) {
                Informasi::where('kategori_id',$kategori->id)->delete();
                return redirect('informasi?id='.$kategori->id)->with('dd','Daftar '.$kategori->nama_kategori);
            }
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
                    $data       = Informasi::where('kategori_id',$kategori->id)->orderBy('id','DESC')->get();
                    return view('company.informasi.film.index', compact('kategori','data'));
                    break;
                case 'masakan':
                    $data       = Informasi::where('kategori_id',$kategori->id)->orderBy('id','DESC')->get();
                    return view('company.informasi.masakan.index', compact('kategori','data'));
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
                $link = 'http://www.omdbapi.com/?apikey=d7039757&s='.$request->cari.'&page='.$request->page;
                $response = datajson($link);
                $data = json_decode($response);

                $kategori   = Kategori::where('nama_kategori','film')->first();

                foreach ($data->Search as $key) {
                    $judul = $key->Title;
                    $gambar = $key->Poster;
                    $id = $key->imdbID;

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
                        $namafile  = unduhgambar('company/informasi/film',$judul.'-'.$id,$gambar);
                        Informasi::create([
                            'kategori_id' => $kategori->id,
                            'nama' => $judul,
                            'gambar' => $namafile,
                            'detail' => $response
                        ]);
                    }
                }
                return redirect('informasi?id='.$kategori->id.'&total='.$data->totalResults)->with('ds',$notif);
                break;
            case 'masakan':
                $notif      = 'Masakan';
                $kategori   = Kategori::where('nama_kategori','masakan')->first();
                $link       = 'https://masak-apa.tomorisakura.vercel.app/api/search/?q='.$request->cari;
                $response   = datajson($link);
                $data       = json_decode($response);
                // dd($data);
                foreach ($data->results as $key) {
                    // "title": "Resep Sushi Roll Isi Ayam Mayones, Camilan Favorit Baru",
                    // "thumb": "https://www.masakapahariini.com/wp-content/uploads/2019/06/sushi-roll-ayam-mayones-400x240.jpg",
                    // "key": "resep-sushi-roll-isi-ayam-mayones-pedas",
                    // "times": "30mnt",
                    // "serving": "4 Porsi",
                    // "difficulty": "Cukup Rumit"
                    $link = 'https://masak-apa.tomorisakura.vercel.app/api/recipe/'.$key->key;
                    $response   = datajson($link);
                    $namafile   = unduhgambar('company/informasi/masakan',$key->key,$key->thumb);
                    Informasi::create([
                        'kategori_id' => $kategori->id,
                        'nama' => $key->title,
                        'gambar' => $namafile,
                        'detail' => $response
                    ]);
                }
                return redirect('informasi?id='.$kategori->id)->with('ds',$notif);
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

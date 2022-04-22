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
    public function index(Request $request)
    {
        $kategori_id = (isset($_GET['id'])) ? $_GET['id'] : 'semua' ;
        $page = (isset($_GET['page'])) ? $_GET['page'] : 'index' ;
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
                case 'gadget':
                    return view('company.informasi.gadget.index', compact('kategori','data'));
                    break;
                case 'film':
                    if ($page == 'index') {
                        $data       = Informasi::where('kategori_id',$kategori->id)->orderBy('id','DESC')->get();
                        return view('company.informasi.film.index', compact('kategori','data'));
                    } else {
                        // cek apakah session sesuai dengan key
                        if($request->session()->has('listfilm')){
                            $response = $request->session()->get('listfilm');
                            if ($response['key'] <> $_GET['cari'] AND $response['page'] == $page) {
                                $response = $request->session()->forget('listfilm');
                            }
                        }
                        // jika session ada dipanggil, jika tidak ada maka buat sessio baru
                        if($request->session()->has('listfilm')){
                            $response   = $response['data'];
                        }else{
                            $link = 'http://www.omdbapi.com/?apikey=d7039757&s='.$request->cari.'&page='.$request->page;
                            $response   = datajson($link);
                            $simpanresep= ['key' => $_GET['cari'],'page'=>  $request->page, 'data' => $response];
                            $request->session()->put('listfilm',$simpanresep);
                        }
                        $result       = json_decode($response);
                        $data       = [];
                        $simpan     = [];
                        if ($result->Response == 'True') {
                            // cek data yang sudah disimpan dan belum
                            foreach ($result->Search as $key) {
                                $judul = $key->Title;
                                $id = $key->imdbID;
                                $gambar     = $judul.'-'.$id.'.png';
                                // cek apakah sudah ada di server atau belum
                                $cekdata = Informasi::where('nama',$judul)->where('gambar',$gambar)->first();
                                if ($cekdata) {
                                    $simpan[] = $key;
                                } else {
                                    $data[] = $key;
                                }
                            }
                        }
                        $key    = $_GET['cari'];
                        return view('company.informasi.film.create', compact('kategori','data','simpan','key'));
                    }
                    break;
                case 'masakan':
                    if ($page == 'index') {
                        $data       = Informasi::where('kategori_id',$kategori->id)->orderBy('id','DESC')->get();
                        return view('company.informasi.masakan.index', compact('kategori','data'));
                    } else {
                        // cek apakah session sesuai dengan key
                        if($request->session()->has('listresep')){
                            $response = $request->session()->get('listresep');
                            if ($response['key'] <> $_GET['cari']) {
                                $response = $request->session()->forget('listresep');
                            }
                        }
                        // jika session ada dipanggil, jika tidak ada maka buat sessio baru
                        if($request->session()->has('listresep')){
                            $response   = $response['data'];
                        }else{
                            $link       = 'https://masak-apa.tomorisakura.vercel.app/api/search/?q='.$_GET['cari'];
                            $response   = datajson($link);
                            $simpanresep= ['key' => $_GET['cari'],'data' => $response];
                            $request->session()->put('listresep',$simpanresep);
                        }
                        $result       = json_decode($response);
                        // cek data yang sudah disimpan dan belum
                        $data   = [];
                        $simpan   = [];
                        foreach ($result->results as $key) {
                            $cekdata = Informasi::where('nama',$key->title)->where('gambar',$key->key.'.png')->first();
                            if ($cekdata) {
                                $simpan[] = $key;
                            } else {
                                $data[] = $key;
                            }
                        }
                        $key    = $_GET['cari'];
                        return view('company.informasi.masakan.create', compact('kategori','data','simpan','key'));
                    }
                    
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
                $kategori   = Kategori::where('nama_kategori','film')->first();
                if (isset($request->page)) {
                    $link       = 'http://www.omdbapi.com/?apikey=d7039757&i='.$request->id;
                    $response   = datajson($link);
                    $namafile   = unduhgambar('company/informasi/film',$request->title.'-'.$request->id,$request->gambar);
                    Informasi::create([
                        'kategori_id' => $kategori->id,
                        'nama' => $request->title,
                        'gambar' => $namafile,
                        'detail' => $response
                    ]);
                    return back()->with('ds',$request->title);
                } else {
                    $response = $request->session()->get('listfilm');
                    $data = json_decode($response['data']);
                    foreach ($data->Search as $key) {
                        $judul = $key->Title;
                        $id = $key->imdbID;
                        $linkgambar = $key->Poster;
                        // cek apakah sudah ada di server atau belum
                        $gambar         = $judul.'-'.$id.'.png';
                        $cekinformasi = Informasi::where('nama',$judul)->where('gambar',$gambar)->first();
                        if (!$cekinformasi) {
                            $link       = 'http://www.omdbapi.com/?apikey=d7039757&i='.$id;
                            $response   = datajson($link);
                            $namafile   = unduhgambar('company/informasi/film',$judul.'-'.$id,$linkgambar);
                            Informasi::create([
                                'kategori_id' => $request->kategori_id,
                                'nama' => $judul,
                                'gambar' => $namafile,
                                'detail' => $response
                            ]);
                        }
                    }
                }
                
                return redirect('informasi?id='.$kategori->id.'&total='.$data->totalResults)->with('ds',$notif);
                break;
            case 'masakan':
                $notif      = 'Masakan';
                $kategori   = Kategori::where('nama_kategori','masakan')->first();
                if (isset($request->page)) {
                    $link = 'https://masak-apa.tomorisakura.vercel.app/api/recipe/'.$request->key;
                    $response   = datajson($link);
                    $response   = json_decode($response);
                    $namafile   = unduhgambar('company/informasi/masakan',$request->key,$request->thumb);
                    Informasi::create([
                        'kategori_id' => $kategori->id,
                        'nama' => $request->title,
                        'gambar' => $namafile,
                        'detail' => json_encode($response->results)
                    ]);
                    return back()->with('ds','resep '.$request->title);
                } else {
                    $response = $request->session()->get('listresep');
                    $data       = json_decode($response['data']);
                    if (count($data->results) > 0) {
                        foreach ($data->results as $key) {
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
                    } else {
                        return redirect('informasi?id='.$kategori->id)->with('danger','Informasi dengan key "'.$request->cari.'" tidak ditemukan!');
                    }
                }
                
                
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
            case 'masakan':
                $detail     = json_decode($informasi->detail);
                return view('company.informasi.masakan.show', compact('informasi','detail'));
                break;
            
            default:
                echo 'halaman belum ada';
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
        $filegambar = 'public/img/company/informasi/'.$informasi->kategori->nama_kategori.'/'.$informasi->gambar;
        deletefile($filegambar);

        $informasi->delete();

        return back()->with('dd',$informasi->kategori->namakategori);
    }
}

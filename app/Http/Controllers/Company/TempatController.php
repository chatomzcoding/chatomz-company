<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Tempat;
use Illuminate\Http\Request;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempat     = Tempat::all();
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'index' ;
        switch ($s) {
            case 'map':
                $data = [];
                foreach ($tempat as $key) {
                    $img    = asset('img/company/tempat/'.$key->gambar);
                    $data[] = [
                        'type' => 'Feature',
                        'properties' => [
                            'message' => ucwords($key->nama),
                            'poto'  => asset('img/kategori/'.$key->kategori->gambar),
                            'description' =>
                            '<img src="'.$img.'" width="100%"><strong>'.$key->nama.'</strong>
                            <p>'.$key->keterangan.'</p>',
                        ],
                        'geometry' => [
                            'type' => 'Point',
                            'coordinates' => [$key->nilai_long, $key->nilai_lat]
                        ]
                    ];
                }

                return view('company.tempat.map', compact('data'));
                break;
            
            default:
            return view('company.tempat.index', compact('tempat'));
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
        $kategori   = Kategori::where('label','tempat')->get();
        return view('company.tempat.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gambar     = NULL;
        if (isset($request->gambar)) {
            $request->validate([
                'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            $lokasi     = 'public/img/company/tempat';
            $file = $request->file('gambar');
            $gambar = kompres($file,$lokasi);
        }

        Tempat::create([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'keterangan' => $request->keterangan,
            'nilai_lat' => $request->nilai_lat,
            'nilai_long' => $request->nilai_long,
            'gambar' => $gambar,
        ]);
        return redirect('tempat')->with('ds','tempat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function show(Tempat $tempat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function edit(Tempat $tempat)
    {
        $longlat    = [$tempat->nilai_long,$tempat->nilai_lat];
        $kategori   = Kategori::where('label','tempat')->get();
        return view('company.tempat.edit', compact('tempat','longlat','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tempat $tempat)
    {
        $gambar     = $tempat->gambar;
        if (isset($request->gambar)) {
            $request->validate([
                'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            ]);
            $lokasi     = 'public/img/company/tempat';
            deletefile($lokasi.'/'.$gambar);
            $file = $request->file('gambar');
            $gambar = kompres($file,$lokasi);
        }

        Tempat::where('id',$tempat->id)->update([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'keterangan' => $request->keterangan,
            'nilai_lat' => $request->nilai_lat,
            'nilai_long' => $request->nilai_long,
            'gambar' => $gambar,
        ]);
        return redirect('tempat')->with('du','tempat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tempat $tempat)
    {
        $lokasi     = 'public/img/company/tempat';
        deletefile($lokasi.'/'.$tempat->gambar);
        $tempat->delete();

        return back()->with('dd','Tempat');
    }
}

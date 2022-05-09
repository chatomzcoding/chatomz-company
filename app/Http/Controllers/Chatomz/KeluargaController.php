<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\Keluargahubungan;
use App\Models\Orang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keluarga       = Keluarga::orderBy('nama_keluarga','ASC')->get();
        $kepalakeluarga = Orang::where('gender','laki-laki')->where('marital_status','sudah')->orderBy('first_name','ASC')->get();
        return view('chatomz.kingdom.keluarga.index', compact('keluarga','kepalakeluarga'));
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
        Keluarga::create($request->all());

        return redirect()->back()->with('ds','Keluarga');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function show($keluarga)
    {
        $keluarga           = Keluarga::find(Crypt::decryptString($keluarga));
        // data pohon keluarga
        $daftaristri        = Orang::where('gender','perempuan')->where('marital_status','sudah')->orderBy('orang.first_name','ASC')->get();
        $suami              = Orang::find($keluarga->orang_id);
        $istri              = $keluarga->istri;
        $anggotakeluarga    = Orang::select('id','first_name','last_name')->orderBy('first_name','ASC')->get();
        $ortusuami          = Keluargahubungan::where('orang_id',$suami->id)->where('status','anak')->first();
        // jika istri ada
        if ($istri) {
            $ortuistri          = Keluargahubungan::where('orang_id',$istri->orang->id)->where('status','anak')->first();
        } else {
            $ortuistri          = NULL;
        }
        $pohon = [
            'istri' => $istri,
            'suami' => $suami,
            'ortusuami' => $ortusuami,
            'ortuistri' => $ortuistri
        ];

        $jumlahanak     = count($keluarga->anakketurunan);

        $s = (isset($_GET['s'])) ? $_GET['s'] : 'show' ;
        switch ($s) {
            case 'silsilah':
                return view('chatomz.kingdom.keluarga.silsilah', compact('keluarga','pohon','daftaristri','anggotakeluarga','jumlahanak'));
                break;
            case 'diagram':
                $pohonkeluarga = [];
                // add suami
                $istri          = $keluarga->istri->orang;
                $suami          = $keluarga->orang;
                $pohonkeluarga[] = ["id" => $istri->id, "pids" => [$suami->id], "name" => fullname($istri), "gender" => kingdom_genderenglish($istri->gender), 'photo' => kingdom_orangpotourl($istri->photo)];
                $pohonkeluarga[] = ["id" => $suami->id, "pids" => [$istri->id], "name" => fullname($suami), "gender" => kingdom_genderenglish($suami->gender), 'photo' => kingdom_orangpotourl($suami->photo)];
                
                // anak keturunan pertama

                foreach ($keluarga->anakketurunan as $i) {
                    // cek pasangan
                    if ($i->orang->gender == 'laki-laki') {
                        $mid = '';
                        if (isset($i->orang->kepalakeluarga->istri)) {
                            $dataistri  = $i->orang->kepalakeluarga->istri;
                            $mid = $dataistri->id;
                            $pohonkeluarga[] = ["id" => $dataistri->orang->id, "pids" => [$i->orang->id], "name" => fullname($dataistri->orang), "gender" => kingdom_genderenglish($dataistri->orang->gender),'photo' => kingdom_orangpotourl($dataistri->photo)];
                            $pohonkeluarga[] = ["id" => $i->orang->id, "mid" => $istri->id, "fid" => $suami->id, "pids" => [$dataistri->orang->id],"name" => fullname($i->orang), "gender" => kingdom_genderenglish($i->orang->gender),'photo' => kingdom_orangpotourl($i->orang->photo)];
                        } else {
                            $pohonkeluarga[] = ["id" => $i->orang->id, "mid" => $istri->id, "fid" => $suami->id, "name" => fullname($i->orang), "gender" => kingdom_genderenglish($i->orang->gender),'photo' => kingdom_orangpotourl($i->orang->photo)];

                        }
                        $fid = $i->orang->id;
                        
                    } else {
                        $fid = '';
                        if (isset($i->orang->istri->keluarga->orang)) {
                            $datasuami = $i->orang->istri->keluarga->orang;
                            $fid = $datasuami->id;
                            $pohonkeluarga[] = ["id" => $i->orang->id, "mid" => $istri->id, "fid" => $suami->id, "pids" => [$datasuami->id],"name" => fullname($i->orang), "gender" => kingdom_genderenglish($i->orang->gender),'photo' => kingdom_orangpotourl($i->orang->photo)];
                            $pohonkeluarga[] = ["id" => $datasuami->id, "pids" => [$i->orang->id],"name" => fullname($datasuami), "gender" => kingdom_genderenglish($datasuami->gender),'photo' => kingdom_orangpotourl($datasuami->photo)];
                        } else {
                            $pohonkeluarga[] = ["id" => $i->orang->id, "mid" => $istri->id, "fid" => $suami->id, "name" => fullname($i->orang), "gender" => kingdom_genderenglish($i->orang->gender),'photo' => kingdom_orangpotourl($i->orang->photo)];
                        }
                        $mid = $i->orang->id;
                    }
                    
                    // anak keturunan kedua
                    foreach (kingdom_keturunan($i->orang) as $j) {
                        
                        $pohonkeluarga[] = ["id" => $j->orang->id, "mid" => $mid, "fid" => $fid, "name" => fullname($j->orang), "gender" => kingdom_genderenglish($j->orang->gender),'photo' => kingdom_orangpotourl($j->orang->photo)];

                        if ($j->orang->gender == 'laki-laki') {
                            $mid2 = '';
                            $fid2 = $j->orang->id;
                        } else {
                            $mid2 = $j->orang->id;
                            $fid2 = '';
                        }
                        
                        // anak keturunan ketiga
                        foreach (kingdom_keturunan($j->orang) as $k) {
                            $pohonkeluarga[] = ["id" => $k->orang->id, "mid" => $mid2, "fid" => $fid2, "name" => fullname($k->orang), "gender" => kingdom_genderenglish($k->orang->gender),'photo' => kingdom_orangpotourl($k->orang->photo)];
                            
                        }
                    }
                }

                return view('chatomz.kingdom.keluarga.diagram', compact('keluarga','daftaristri','anggotakeluarga','pohonkeluarga'));
                break;
            
            default:
                return view('chatomz.kingdom.keluarga.show', compact('keluarga','pohon','daftaristri','anggotakeluarga','jumlahanak'));
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluarga $keluarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Keluarga::where('id',$request->id)->update([
            'orang_id' => $request->orang_id,
            'nama_keluarga' => $request->nama_keluarga,
            'no_kk' => $request->no_kk,
            'keterangan' => $request->keterangan,
            'tgl_pernikahan' => $request->tgl_pernikahan,
            'status_keluarga' => $request->status_keluarga,
        ]);

        return redirect()->back()->with('du','Keluarga');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();

        return redirect()->back()->with('dd','Keluarga');
    }
}

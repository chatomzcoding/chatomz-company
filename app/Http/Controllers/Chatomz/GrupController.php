<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Grup;
use App\Models\Orang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class GrupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grup   = Grup::orderBy('name','ASC')->get();

        return view('chatomz.kingdom.grup.index', compact('grup'));
    }

    public function lihatgrup($sesi)
    {
        $listgrup   = Grup::orderBy('name','ASC')->get();
        $orang      = Orang::where('status_group','available')->orderBy('first_name','ASC')->get();
        if ($sesi <> 'pilih') {
            $sesi       = explode('_',$sesi);
            $id         = $sesi[0];
            $kelamin    = $sesi[1];
            $perkawinan = $sesi[2];
            $usia1      = $sesi[3];
            $usia2      = $sesi[4];
            $grup       = Grup::find($id);
            if ($kelamin == 'semua') {
                $anggota    = DB::table('grup_anggota')
                                ->join('orang','grup_anggota.orang_id','=','orang.id')
                                ->select('grup_anggota.*','orang.first_name','orang.last_name','orang.gender','orang.photo','orang.death','orang.date_birth','orang.marital_status')
                                ->where('grup_anggota.grup_id',$grup->id)
                                ->orderBy('orang.first_name','ASC')
                                ->get();
            } else {
                $anggota    = DB::table('grup_anggota')
                                ->join('orang','grup_anggota.orang_id','=','orang.id')
                                ->select('grup_anggota.*','orang.first_name','orang.last_name','orang.gender','orang.photo','orang.death','orang.date_birth','orang.marital_status')
                                ->where('grup_anggota.grup_id',$grup->id)
                                ->where('orang.gender',$kelamin)
                                ->orderBy('orang.first_name','ASC')
                                ->get();
            }

             // cek usia
             $danggota   = [];
             foreach ($anggota as $item) {
                $usia = kingdom_umur($item->date_birth);
                if ($usia >= $usia1 AND $usia <= $usia2 ) {
                    // cek pernikahan
                    if ($perkawinan <> 'semua') {
                        if ($item->marital_status == $perkawinan) {
                            $danggota[] = $item;
                        }
                    } else {
                        $danggota[] = $item;
                    }
                    
                }
             }

        } else {
            $grup       = NULL;
            $danggota    = [] ;
            $id         = $sesi;
            $kelamin    = 'semua';
            $perkawinan  = 'semua';
            $usia1      = 0;
            $usia2      = 100;
        }

        $data = [
            'grup' => $grup,
            'anggota' => $danggota,
            'id' => $id,
            'kelamin' => $kelamin,
            'usia1' => $usia1,
            'usia2' => $usia2,
            'perkawinan' => $perkawinan,
        ];
        return view('chatomz.kingdom.grup.lihatgrup', compact('data','listgrup','orang'));
    }

    public function prosesgrup(Request $request)
    {
        return redirect('/lihat/grup/'.$request->id.'_'.$request->kelamin.'_'.$request->perkawinan.'_'.$request->usia1.'_'.$request->usia2);
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
     * @param  \App\Models\Grup  $grup
     * @return \Illuminate\Http\Response    
     */
    public function show($grup)
    {
        $grup       = Grup::find(Crypt::decryptString($grup));
        $tag = (isset($_GET['tag'])) ? $_GET['tag'] : NULL ;
        if (is_null($tag)) {
            $anggota    = DB::table('grup_anggota')
                            ->join('orang','grup_anggota.orang_id','=','orang.id')
                            ->select('grup_anggota.*','orang.first_name','orang.last_name','orang.gender','orang.photo','orang.death')
                            ->where('grup_anggota.grup_id',$grup->id)
                            ->where('grup_anggota.tag',NULL)
                            ->orderBy('orang.first_name','ASC')
                            ->get();
       
        } else {
            $anggota    = DB::table('grup_anggota')
                            ->join('orang','grup_anggota.orang_id','=','orang.id')
                            ->select('grup_anggota.*','orang.first_name','orang.last_name','orang.gender','orang.photo','orang.death')
                            ->where('grup_anggota.grup_id',$grup->id)
                            ->where('grup_anggota.tag','LIKE',"%".$tag."%")
                            ->orderBy('orang.first_name','ASC')
                            ->get();
        }
        
        $orang      = Orang::where('status_group','available')->orderBy('first_name','ASC')->get();
        $menu       = 'grup';
        $main       = [
            'tag' => $tag
        ];
        return view('chatomz.kingdom.grup.show', compact('menu','main','grup','anggota','orang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grup  $grup
     * @return \Illuminate\Http\Response
     */

    public function edit(Grup $grup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grup  $grup
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request)
    {
        // $dtag  = explode('#',$request->dtag);
        // unset($dtag[0]); 
        // $dtag  = array_map('trim',$dtag); 
        // $dtag  = array_values($dtag); 
        // $dtag  = json_encode($dtag);

        Grup::where('id',$request->id)->update([
            'name' => $request->name,
            'dtag' => $request->dtag,
        ]);

        return back()->with('du','Grup');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grup  $grup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grup $grup)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Grupanggota;
use Illuminate\Http\Request;

class GrupanggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $sesi = (isset($request->sesi)) ? $request->sesi : NULL ;
        switch ($sesi) {
            case 'taganggota':
                $isi    = $request->isi; 
                foreach ($request->id as $key => $value) {
                    // cek apakah sudah ada tag sebelumnya
                    $nilai          = [$request->tag => $isi[$value]];
                    $ganggota       = Grupanggota::find($value);
                    if ($ganggota->tag == NULL) {
                        $tag    = $nilai; 
                    } else {
                        $tag    = json_decode($ganggota->tag,TRUE);
                        $tag    = array_merge($nilai,$tag); 
                    }

                    Grupanggota::where('id',$ganggota->id)->update([
                        'tag' => json_encode($tag)
                    ]);
                }
                break;
            case 'anggotalist':
                $grup          = $request->grup_id;
                $information    = $request->information;
                $tag    = $request->tag;
                // hapus array null
                $info   = [];
                foreach ($information as $key) {
                    if (!is_null($key)) {
                        $info[] = $key;
                    }
                }
                for ($i=0; $i < count($grup); $i++) {
                    Grupanggota::create([
                        'orang_id' => $request->orang_id,
                        'grup_id' => $grup[$i],
                        'information' => $info[$i],
                    ]);
                }
                break;
            
            default:
                $tag = (isset($request->tag)) ? json_encode($request->tag) : NULL ;
                Grupanggota::create([
                    'orang_id' => $request->orang_id,
                    'information' => $request->information,
                    'grup_id' => $request->grup_id,
                    'tag' => $tag
                ]);
                break;
        }

        return redirect()->back()->with('ds','Anggota Grup');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupanggota  $grupanggota
     * @return \Illuminate\Http\Response
     */
    public function show(Grupanggota $grupanggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupanggota  $grupanggota
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupanggota $grupanggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupanggota  $grupanggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $tag = (isset($request->tag)) ? $request->tag : NULL ;
        // fungsi untuk hapus tag
        if (isset($request->hapustag)) {
            Grupanggota::where('id',$request->id)->update([
                'tag' => NULL
            ]);
        }
        $ganggota   = Grupanggota::find($request->id);
        if ($request->sesitag == "ya") {
            if ($ganggota->tag <> NULL) {
                if (!is_null($tag)) {
                    $dtag   = [];
                    $atag   = [];
                    for ($i=0; $i < count($tag); $i++) {
                        $dtag = ['#'.$tag[$i] => NULL];
                        if (is_null($atag)) {
                            $atag = $dtag;
                        } else {
                            $atag   = array_merge($atag,$dtag);
                        }
                    }
                    $tag    = json_decode($ganggota->tag,TRUE);
                    $tag    = array_merge($atag,$tag);
                    // $tag    = array_unique($tag);
                    $tag    = json_encode($tag);
                } else {
                    $tag    = $ganggota->tag;
                }
            } else {
                if (!is_null($tag)) {
                    $dtag   = [];
                    $atag   = [];
                    for ($i=0; $i < count($tag); $i++) {
                        $dtag = ['#'.$tag[$i] => NULL];
                        if (is_null($atag)) {
                            $atag = $dtag;
                        } else {
                            $atag   = array_merge($atag,$dtag);
                        }
                    }
                    $tag    = json_encode($atag);
                }
            }
        } else {
            $dtag   = json_decode($ganggota->tag,TRUE);
            if (isset($request->hapusdtag)) {
                unset($dtag[$request->dtag]);
            } else {
                $dtag[$request->dtag] = $request->isi;
            }
            $tag  = json_encode($dtag);

        }
        Grupanggota::where('id',$request->id)->update([
            'information' => $request->information,
            'tag' => $tag
        ]);

        return redirect()->back()->with('du','Anggota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupanggota  $grupanggota
     * @return \Illuminate\Http\Response
     */
    public function destroy($grupanggota)
    {
        Grupanggota::find($grupanggota)->delete();

        return redirect()->back()->with('dd','Anggota');
    }
}

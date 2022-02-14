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
                for ($i=0; $i < count($request->id); $i++) { 
                    // cek apakah sudah ada tag sebelumnya
                    $id             = $request->id;
                    $ganggota       = Grupanggota::find($id[$i]);
                    if ($ganggota->tag == NULL) {
                        $tag    = $request->tag; 
                    } else {
                        $tag    = json_decode($ganggota->tag,TRUE);
                        $tag    = array_merge($request->tag,$tag);
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
                Grupanggota::create([
                    'orang_id' => $request->orang_id,
                    'information' => $request->information,
                    'grup_id' => $request->grup_id,
                    'tag' => json_encode($request->tag)
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
        Grupanggota::where('id',$request->id)->update([
            'information' => $request->information,
            'tag' => json_encode($request->tag)
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

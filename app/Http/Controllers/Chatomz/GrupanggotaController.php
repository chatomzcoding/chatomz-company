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
        //
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
        if (isset($request->sesi)) {
            for ($i=0; $i < count($request->grup_id); $i++) {
                $grup          = $request->grup_id;
                $information    = $request->information;
                Grupanggota::create([
                    'orang_id' => $request->orang_id,
                    'grup_id' => $grup[$i],
                    'information' => $information[$i],
                ]);
            }
        } else {
            Grupanggota::create($request->all());
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
            'information' => $request->information
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

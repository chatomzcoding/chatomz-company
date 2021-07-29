<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Orang;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PendidikanController extends Controller
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
        Pendidikan::create($request->all());

        return redirect()->back()->with('ds','Pendidikan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit($pendidikan)
    {
        $pendidikan     = Pendidikan::find(Crypt::decryptString($pendidikan));
        $orang          = Orang::find($pendidikan->id);
        return view('chatomz.kingdom.pendidikan.edit', compact('pendidikan','orang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendidikan $pendidikan)
    {
        Pendidikan::where('id',$pendidikan->id)->update([
            'tk' => $request->tk,
            'sd' => $request->sd,
            'smp' => $request->smp,
            'sma' => $request->sma,
            'd' => $request->d,
            's1' => $request->s1,
            's2' => $request->s2,
            's3' => $request->s3,
            'pesantren' => $request->pesantren,
            'homescholl' => $request->homescholl,
            'boardingscholl' => $request->boardingscholl,
            'bimbel' => $request->bimbel,
            'kursus' => $request->kursus,
            'information' => $request->information,
        ]);

        return redirect('/orang/'.Crypt::encryptString($pendidikan->orang_id))->with('du','Pendidikan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendidikan $pendidikan)
    {
        //
    }
}

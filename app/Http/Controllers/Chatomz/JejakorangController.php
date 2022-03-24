<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Jejakorang;
use App\Models\Orang;
use Illuminate\Http\Request;

class JejakorangController extends Controller
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

        Jejakorang::create($request->all());
        $orang  = Orang::find($request->orang_id);
        return redirect()->back()->with('dsc',fullname($orang).' telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jejakorang  $jejakorang
     * @return \Illuminate\Http\Response
     */
    public function show(Jejakorang $jejakorang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jejakorang  $jejakorang
     * @return \Illuminate\Http\Response
     */
    public function edit(Jejakorang $jejakorang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jejakorang  $jejakorang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Jejakorang::where('id',$request->id)->update([
            'ket_orang' => $request->ket_orang
        ]);

        return back()->with('du','Orang terlibat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jejakorang  $jejakorang
     * @return \Illuminate\Http\Response
     */
    public function destroy($jejakorang)
    {
        $jejakorang = Jejakorang::find($jejakorang);
        $orang  = Orang::find($jejakorang->orang_id);
        $jejakorang->delete();
        return redirect()->back()->with('du',fullname($orang));
    }
}

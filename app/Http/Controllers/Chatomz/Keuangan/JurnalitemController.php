<?php

namespace App\Http\Controllers\Chatomz\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Jurnalitem;
use Illuminate\Http\Request;

class JurnalitemController extends Controller
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
        Jurnalitem::create([
            'jurnal_id' => $request->jurnal_id,
            'item_id' => $request->item_id,
            'harga' => default_nilai($request->harga),
            'detail' => $request->detail,
        ]);

        return back()->with('ds','Jurnal Item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurnalitem  $jurnalitem
     * @return \Illuminate\Http\Response
     */
    public function show(Jurnalitem $jurnalitem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurnalitem  $jurnalitem
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurnalitem $jurnalitem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurnalitem  $jurnalitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Jurnalitem::where('id',$request->id)->update([
            'item_id' => $request->item_id,
            'harga' => default_nilai($request->harga),
            'detail' => $request->detail,
        ]);

        return back()->with('du','Jurnal Item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurnalitem  $jurnalitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurnalitem $jurnalitem)
    {
        $jurnalitem->delete();

        return back()->with('dd','Jurnal Item');
    }
}

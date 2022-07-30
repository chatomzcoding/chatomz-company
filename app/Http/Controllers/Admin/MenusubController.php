<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menusub;
use Illuminate\Http\Request;

class MenusubController extends Controller
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
        Menusub::create($request->all());

        return back()->with('ds','Menu Sub');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menusub  $menusub
     * @return \Illuminate\Http\Response
     */
    public function show(Menusub $menusub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menusub  $menusub
     * @return \Illuminate\Http\Response
     */
    public function edit(Menusub $menusub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menusub  $menusub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Menusub::where('id',$request->id)->update([
            'nama' => $request->nama,
            'link' => $request->link,
            'urutan' => $request->urutan,
        ]);

        return back()->with('du','Menu Sub');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menusub  $menusub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menusub $menusub)
    {
        $menusub->delete();

        return back()->with('dd','Menu Sub');
    }
}

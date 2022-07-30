<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menurole;
use Illuminate\Http\Request;

class MenuroleController extends Controller
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
        Menurole::create([
            'akses' => $request->akses,
            'role' => json_encode($request->role),
        ]);
        
        return back()->with('ds','Menu Role');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menurole  $menurole
     * @return \Illuminate\Http\Response
     */
    public function show(Menurole $menurole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menurole  $menurole
     * @return \Illuminate\Http\Response
     */
    public function edit(Menurole $menurole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menurole  $menurole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menurole $menurole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menurole  $menurole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menurole $menurole)
    {
        dd($menurole);
    }
}

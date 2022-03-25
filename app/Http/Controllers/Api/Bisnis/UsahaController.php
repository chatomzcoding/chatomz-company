<?php

namespace App\Http\Controllers\Api\Bisnis;

use App\Http\Controllers\Controller;
use App\Models\Usaha;
use Illuminate\Http\Request;

class UsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (chatomz_token()) {
            $data = [
                'data' => Usaha::orderBy('nama_usaha','ASC')->get(),
                'link_gambar' => 'public/img/company/bisnis/usaha'
            ];
            return $data; 
        }
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
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function show(Usaha $usaha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function edit(Usaha $usaha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usaha $usaha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usaha $usaha)
    {
        //
    }
}

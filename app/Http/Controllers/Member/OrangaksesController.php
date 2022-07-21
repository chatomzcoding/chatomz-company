<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Orangakses;
use Illuminate\Http\Request;

class OrangaksesController extends Controller
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
        Orangakses::create($request->all());
        return back()->with('ds','Orang Akses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orangakses  $orangakses
     * @return \Illuminate\Http\Response
     */
    public function show(Orangakses $orangakses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orangakses  $orangakses
     * @return \Illuminate\Http\Response
     */
    public function edit(Orangakses $orangakses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orangakses  $orangakses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orangakses $orangakses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orangakses  $orangakses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orangakses $orangakses)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backupdb;
use Illuminate\Http\Request;

class BackupdbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $backupdb   = Backupdb::latest()->get();

        return view('chatomz.admin.backupdb.index', compact('backupdb'));
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
     * @param  \App\Models\Backupdb  $backupdb
     * @return \Illuminate\Http\Response
     */
    public function show(Backupdb $backupdb)
    {
        return $backupdb->data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backupdb  $backupdb
     * @return \Illuminate\Http\Response
     */
    public function edit(Backupdb $backupdb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backupdb  $backupdb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Backupdb $backupdb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backupdb  $backupdb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Backupdb $backupdb)
    {
        $backupdb->delete();

        return back()->with('dd','Backupdb');
    }
}

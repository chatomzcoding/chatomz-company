<?php

namespace App\Http\Controllers\Api;

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
        Backupdb::create([
            'aplikasi' => $request->aplikasi,
            'nama' => $request->nama,
            'tgl' => $request->tgl,
            'data' => $request->data,
        ]);

        return response()->json([
            'status' => TRUE,
            'message' => 'backup berhasil'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backupdb  $backupdb
     * @return \Illuminate\Http\Response
     */
    public function show(Backupdb $backupdb)
    {
        //
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
        //
    }
}

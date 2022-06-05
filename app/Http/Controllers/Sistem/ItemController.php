<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item       = Item::orderBy('nama_item','ASC')->get();
        $kelompok   = Kategori::where('label','kelompok')->get();
        return view('sistem.item.index', compact('item','kelompok'));
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
        Item::create($request->all());
        return back()->with('ds','Item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $jurnal = [];
        $total_item = 0;
        $total_pembelian = 0;
        $total_diskon = 0;
        foreach ($item->jurnalitem as $key) {
            $jurnal[] = $key;
            $diskon = (!is_null($key->diskon) AND !empty($key->diskon)) ? $key->diskon : 0 ;
            $total_item = $total_item + $key->jumlah;
            $total_diskon = $total_diskon + $diskon;
            $total_pembelian = $total_pembelian + (($key->harga * $key->jumlah) - $diskon);
        }
        $statistik = [
            'total_item' => $total_item,
            'total_diskon' => $total_diskon,
            'total_pembelian' => $total_pembelian,
        ];

        return view('sistem.item.show', compact('item','jurnal','statistik'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Item::where('id',$request->id)->update([
            'nama_item' => $request->nama_item,
            'kelompok' => $request->kelompok,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('du','Item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return back()->with('dd','Item');
    }
}

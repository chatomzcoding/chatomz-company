<?php

namespace App\Http\Controllers\Chatomz\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\Rekening;
use Illuminate\Http\Request;

class JurnalController extends Controller
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
        $s = (isset($request->s)) ? $request->s : 'store' ;
        switch ($s) {
            case 'transfer':
                // rekening tujuan
                $rekeningtujuan     = Rekening::find($request->rekening_tujuan);
                $rekeningawal     = Rekening::find($request->rekening_id);
                // rekening awal
                Jurnal::create([
                    'subkategori_id' => $request->subkategori_id,
                    'rekening_id' => $request->rekening_id,
                    'nama_jurnal' => 'transfer ke rekening '.$rekeningtujuan->nama_rekening,
                    'arus' => 'pengeluaran',
                    'nominal' => default_nilai($request->nominal),
                    'tanggal' => $request->tanggal,
                    'jam' => $request->jam,
                    'deskripsi' => $request->deskripsi,
                    'status' => 'selesai',
                ]);

                Jurnal::create([
                    'subkategori_id' => $request->subkategori_id,
                    'rekening_id' => $rekeningtujuan->id,
                    'nama_jurnal' => 'terima transfer dari rekening '.$rekeningawal->nama_rekening,
                    'arus' => 'pemasukan',
                    'nominal' => default_nilai($request->nominal),
                    'tanggal' => $request->tanggal,
                    'jam' => $request->jam,
                    'deskripsi' => 'terima dana antar rekening',
                    'status' => 'selesai',
                ]);

                return back()->with('ds','Transfer');
                break;
            
            default:
                Jurnal::create([
                    'subkategori_id' => $request->subkategori_id,
                    'rekening_id' => $request->rekening_id,
                    'nama_jurnal' => $request->nama_jurnal,
                    'arus' => $request->arus,
                    'nominal' => default_nilai($request->nominal),
                    'tanggal' => $request->tanggal,
                    'jam' => $request->jam,
                    'deskripsi' => $request->deskripsi,
                    'struk' => $request->struk,
                    'status' => $request->status,
                    'label' => $request->label,
                    'garansi' => $request->garansi,
                    'tempat' => $request->tempat,
                ]);
                
                $jurnal     = Jurnal::latest()->first();
                return redirect('jurnal/'.$jurnal->id)->with('ds','Jurnal');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function show(Jurnal $jurnal)
    {
        $items   = Item::orderBy('nama_item','ASC')->get();
        $kategori   = Kategori::where('label','keuangan')->get();
        $kelompok   = Kategori::where('label','kelompok')->orderBy('nama_kategori','ASC')->get();
        $satuan   = Kategori::where('label','satuan')->orderBy('nama_kategori','ASC')->get();
        $jumlah     = jumlahhargaitemperjurnal($jurnal->jurnalitem);
        $sisa       = $jurnal->nominal - $jumlah;
        $main       = [
            'totalharga' => $jumlah,
            'sisa' => $sisa
        ];
        return view('chatomz.kingdom.keuangan.jurnal.show', compact('jurnal','items','kategori','main','kelompok','satuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurnal $jurnal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Jurnal::where('id',$request->id)->update([
            'subkategori_id' => $request->subkategori_id,
            'nama_jurnal' => $request->nama_jurnal,
            'arus' => $request->arus,
            'nominal' => default_nilai($request->nominal),
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'deskripsi' => $request->deskripsi,
            'struk' => $request->struk,
            'label' => $request->label,
            'garansi' => $request->garansi,
            'tempat' => $request->tempat,
        ]);

        return back()->with('du','Jurnal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurnal $jurnal)
    {
        $jurnal->delete();
        return back()->with('dd','Jurnal');
    }
}

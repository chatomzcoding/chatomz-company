<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Informasisub;
use Illuminate\Http\Request;

class InformasisubController extends Controller
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
        switch ($request->sesi) {
            case 'hewan':
                $tujuan_upload = 'public/img/company/informasi/hewan';
                $detail     = [
                    'nama_sub' => $request->nama_sub,
                    'nama_latin' => $request->nama_latin,
                    'lama_hidup' => $request->lama_hidup,
                    'pemakan' => $request->pemakan,
                    'klasifikasi' => $request->klasifikasi,
                    'tentang' => $request->tentang,
                ];
                $notif  = 'jenis hewan';
                break;
                
            default:
                return back();
                break;
        }

        if (isset($request->gambar_sub)) {
            $request->validate([
                'gambar_sub' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            $file = $request->file('gambar_sub');
            $gambar_sub = time()."_".$file->getClientOriginalName();
            $file->move($tujuan_upload,$gambar_sub);
        } else {
            $gambar_sub = NULL;
        }
        Informasisub::create([
            'informasi_id' => $request->informasi_id,
            'nama_sub' => $request->nama_sub,
            'gambar_sub' => $gambar_sub,
            'detail_sub' => json_encode($detail)
        ]);

        return back()->with('du',$notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informasisub  $informasisub
     * @return \Illuminate\Http\Response
     */
    public function show(Informasisub $informasisub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informasisub  $informasisub
     * @return \Illuminate\Http\Response
     */
    public function edit(Informasisub $informasisub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Informasisub  $informasisub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $informasi = Informasisub::find($request->id);
        switch ($request->sesi) {
            case 'hewan':
                $tujuan_upload = 'public/img/company/informasi/hewan';
                $detail     = [
                    'nama_sub' => $request->nama_sub,
                    'nama_latin' => $request->nama_latin,
                    'lama_hidup' => $request->lama_hidup,
                    'pemakan' => $request->pemakan,
                    'klasifikasi' => $request->klasifikasi,
                    'tentang' => $request->tentang,
                ];
                $notif  = 'jenis hewan';
                break;
                
            default:
                return back();
                break;
        }

        if (isset($request->gambar_sub)) {
            $request->validate([
                'gambar_sub' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
            ]);
            $file = $request->file('gambar_sub');
            $gambar_sub = time()."_".$file->getClientOriginalName();
            $file->move($tujuan_upload,$gambar_sub);
            deletefile($tujuan_upload.'/'.$informasi->gambar_sub);
        } else {
            $gambar_sub = $informasi->gambar_sub;
        }
        Informasisub::where('id',$request->id)->update([
            'nama_sub' => $request->nama_sub,
            'gambar_sub' => $gambar_sub,
            'detail_sub' => json_encode($detail)
        ]);

        return back()->with('du',$notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informasisub  $informasisub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informasisub $informasisub)
    {
        //
    }
}

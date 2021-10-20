<?php

namespace App\Http\Controllers\Company\Informasi\Gadget;

use App\Http\Controllers\Controller;
use App\Models\Gadgethandphone;
use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HandphoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kamera = [
        //     'main' => '64 mp',
        //     'ultrawide' => '24 mp',
        //     'macro' => '15 mp',
        //     'depth' => '5 mp',
        // ];

        // $kamera     = json_encode($kamera);

        // $kamera     = json_decode($kamera);

        // var_dump($kamera);
        // echo $kamera->main.'</br>';
        // die();
        $handphone  = DB::table('gadget_handphone')
                        ->join('merk','gadget_handphone.merk_id','=','merk.id')
                        ->select('gadget_handphone.*','merk.nama')
                        ->orderByDesc('id')
                        ->get();
        $merk       = Merk::all();

        return view('company.informasi.gadget.handphone.index', compact('merk','handphone'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merk       = Merk::all();
        return view('company.informasi.gadget.handphone.create', compact('merk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // validation form photo
         $request->validate([
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('gambar');
        
        $tujuan_upload = 'public/img/company/informasi/gadget/handphone/';

        $nama_file = kompres($file,$tujuan_upload,400);
        
        // save data array
        $kamera = [
            'main' => $request->kamera_main,
            'ultrawide' => $request->kamera_ultrawide,
            'macro' => $request->kamera_macro,
            'depth' => $request->kamera_depth,
        ];
        
        $platform = [
            'os' => $request->platform_os,
            'chipset' => $request->platform_chipset,
            'cpu' => $request->platform_cpu,
            'gpu' => $request->platform_gpu,
        ];

        $layar = [
            'type' => $request->layar_type,
            'size' => $request->layar_size,
            'resolusi' => $request->layar_resolusi,
        ];
        
        $baterai = [
            'type' => $request->baterai_type,
            'charging' => $request->baterai_charging,
        ];

        $body = [
            'dimensi' => $request->body_dimensi,
            'berat' => $request->body_berat,
            'sim' => $request->body_sim,
        ];
        $memori = [
            'internal' => $request->memori_internal,
            'ram' => $request->memori_ram,
        ];

       Gadgethandphone::create([
           'merk_id' => $request->merk_id,
           'network' => $request->network,
           'nama_gadget' => strtolower($request->nama_gadget),
           'keterangan' => $request->keterangan,
           'kamera' => json_encode($kamera),
           'platform' => json_encode($platform),
           'layar' => json_encode($layar),
           'baterai' => json_encode($baterai),
           'body' => json_encode($body),
           'memori' => json_encode($memori),
           'gambar' => $nama_file,
       ]);

        return redirect('gadgethandphone')->with('ds','Gadget');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gadgethandphone  $gadgethandphone
     * @return \Illuminate\Http\Response
     */
    public function show(Gadgethandphone $gadgethandphone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gadgethandphone  $gadgethandphone
     * @return \Illuminate\Http\Response
     */
    public function edit($gadgethandphone)
    {
        $gadget = Gadgethandphone::find(Crypt::decrypt($gadgethandphone));
        $merk   = Merk::all();
        return view('company.informasi.gadget.handphone.edit', compact('gadget','merk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gadgethandphone  $gadgethandphone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gadgethandphone $gadgethandphone)
    {
        if (isset($request->gambar)) {
            // validation form photo
            $request->validate([
                'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar');
            
            $tujuan_upload = 'public/img/company/informasi/gadget/handphone/';
    
            $nama_file = kompres($file,$tujuan_upload,400);
            deletefile($tujuan_upload.$gadgethandphone->gambar);

        } else {
            $nama_file  = $gadgethandphone->gambar;
        }
        
        
        // save data array
        $kamera = [
            'main' => $request->kamera_main,
            'ultrawide' => $request->kamera_ultrawide,
            'macro' => $request->kamera_macro,
            'depth' => $request->kamera_depth,
        ];
        
        $platform = [
            'os' => $request->platform_os,
            'chipset' => $request->platform_chipset,
            'cpu' => $request->platform_cpu,
            'gpu' => $request->platform_gpu,
        ];

        $layar = [
            'type' => $request->layar_type,
            'size' => $request->layar_size,
            'resolusi' => $request->layar_resolusi,
        ];
        
        $baterai = [
            'type' => $request->baterai_type,
            'charging' => $request->baterai_charging,
        ];

        $body = [
            'dimensi' => $request->body_dimensi,
            'berat' => $request->body_berat,
            'sim' => $request->body_sim,
        ];
        $memori = [
            'internal' => $request->memori_internal,
            'ram' => $request->memori_ram,
        ];

       Gadgethandphone::where('id',$gadgethandphone->id)->update([
           'merk_id' => $request->merk_id,
           'network' => $request->network,
           'nama_gadget' => strtolower($request->nama_gadget),
           'keterangan' => $request->keterangan,
           'kamera' => json_encode($kamera),
           'platform' => json_encode($platform),
           'layar' => json_encode($layar),
           'baterai' => json_encode($baterai),
           'body' => json_encode($body),
           'memori' => json_encode($memori),
           'gambar' => $nama_file,
       ]);

        return redirect('gadgethandphone')->with('du','Gadget');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gadgethandphone  $gadgethandphone
     * @return \Illuminate\Http\Response
     */
    public function destroy($gadgethandphone)
    {
        $gadget     = Gadgethandphone::find($gadgethandphone);
        $tujuan_upload = 'public/img/company/informasi/gadget/handphone/';
        deletefile($tujuan_upload.$gadget->gambar);
        $gadget->delete();
        return redirect()->back()->with('dd','Gadget');

    }
}

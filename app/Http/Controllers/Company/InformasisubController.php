<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
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
        $informasi  = Informasi::find($_GET['id']);
        return view('company.informasi.gadget.create',compact('informasi'));
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
            case 'phone':
                $json = datajson($request->link);
                // dd($json->data->phones);
                $batas = 0;
                foreach ($json->data->phones as $key) {
                    // cek jika belum ada
                    $ceksubinformasi = Informasisub::where('informasi_id',$request->informasi_id)->where('slug',$key->slug)->first();
                    if (!$ceksubinformasi) {
                        $detail = datajson($key->detail);
                        $image  = $detail->data->phone_images[0];
                        $detailsub = json_encode($detail->data);
                        $gambar_sub = unduhgambar('company/informasi/phone',$key->slug,$image);
                        Informasisub::create([
                            'informasi_id' => $request->informasi_id,
                            'nama_sub' => $key->phone_name,
                            'slug' => $key->slug,
                            'gambar_sub' => $gambar_sub,
                            'detail_sub' => $detailsub,
                        ]);
                        $batas++;
                    }
                    if ($batas == 5) {
                        break;
                    }
                }
                return redirect('informasi/'.$request->informasi_id)->with('ds','phone');
                break;
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
            case 'gadget':
                $tujuan_upload = 'public/img/company/informasi/gadget';
                $detail     = [
                    'tentang' => $request->tentang,
                    'network' => $request->network,
                    'kamera' => [
                        'main' => $request->main,
                        'ultrawide' => $request->ultrawide,
                        'micro' => $request->micro,
                        'depth' => $request->depth,
                    ],
                    'layar' => [
                        'type' => $request->type_layar,
                        'size' => $request->size,
                        'resolusi' => $request->resolusi,
                    ],
                    'platform' => [
                        'os' => $request->os,
                        'chipset' => $request->chipset,
                        'cpu' => $request->cpu,
                        'gpu' => $request->gpu,
                    ],
                    'baterai' => [
                        'type' => $request->type_baterai,
                        'charging' => $request->charging,
                    ],
                    'body' => [
                        'dimensi' => $request->dimensi,
                        'berat' => $request->berat,
                        'sim' => $request->sim,
                    ],
                    'memori' => [
                        'internal' => $request->internal,
                        'ram' => $request->ram,
                    ]
                ];
                $notif  = 'jenis gadget';
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

        return redirect('informasi/'.$request->informasi_id)->with('ds',$notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informasisub  $informasisub
     * @return \Illuminate\Http\Response
     */
    public function show(Informasisub $informasisub)
    {
        $detail     = json_decode($informasisub->detail_sub);
        return view('company.informasi.phone.sub.show', compact('informasisub','detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informasisub  $informasisub
     * @return \Illuminate\Http\Response
     */
    public function edit(Informasisub $informasisub)
    {
        return view('company.informasi.gadget.edit',compact('informasisub'));
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
                case 'gadget':
                    $tujuan_upload = 'public/img/company/informasi/gadget';
                    $detail     = [
                        'tentang' => $request->tentang,
                        'network' => $request->network,
                        'kamera' => [
                            'main' => $request->main,
                            'ultrawide' => $request->ultrawide,
                            'macro' => $request->macro,
                            'depth' => $request->depth,
                        ],
                        'layar' => [
                            'type' => $request->type_layar,
                            'size' => $request->size,
                            'resolusi' => $request->resolusi,
                        ],
                        'platform' => [
                            'os' => $request->os,
                            'chipset' => $request->chipset,
                            'cpu' => $request->cpu,
                            'gpu' => $request->gpu,
                        ],
                        'baterai' => [
                            'type' => $request->type_baterai,
                            'charging' => $request->charging,
                        ],
                        'body' => [
                            'dimensi' => $request->dimensi,
                            'berat' => $request->berat,
                            'sim' => $request->sim,
                        ],
                        'memori' => [
                            'internal' => $request->internal,
                            'ram' => $request->ram,
                        ]
                    ];
                    $notif  = 'jenis gadget';
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

        return redirect('informasi/'.$informasi->informasi_id)->with('du',$notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informasisub  $informasisub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informasisub $informasisub)
    {
        deletefile('public/img/company/informasi/'.$informasisub->informasi->kategori->nama_kategori.'/'.$informasisub->gambar_sub);
        $informasisub->delete();

        return back()->with('dd','Sub Informasi');
    }
}

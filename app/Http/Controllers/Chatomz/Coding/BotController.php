<?php

namespace App\Http\Controllers\Chatomz\Coding;

use App\Http\Controllers\Controller;
use App\Models\Chatomzbot;
use Illuminate\Http\Request;

class BotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu   = 'bot';
        $status = (isset($_GET['status'])) ? $_GET['status'] : 'valid' ;
        $main   = [
            'link' => 'chatomzbot',
            'filter' => [
                'status' => $status
            ]
        ];
        if (isset($_GET['cek'])) {
            $jawaban = NULL;
            if (isset($_GET['pertanyaan'])) {
                $pertanyaan     = strtolower($_GET['pertanyaan']);
                $simpan         = $pertanyaan;
                $pertanyaan     = str_replace('?','',$pertanyaan);
                $pertanyaan     = trim($pertanyaan); // hapus spasi

                // filter by kata
                $dbfilter       = Chatomzbot::where('status','filter')->first('jawaban');
                $dbumum         = Chatomzbot::where('status','default')->first('jawaban');
                $katafilter     = explode(',',$dbfilter->jawaban);
                $kataumum       = explode(',',$dbumum->jawaban);
                $kataumum       = array_map('trim',$kataumum);
                $katafilter     = array_map('trim',$katafilter);
                
                $katapertanyaan = explode(' ',$pertanyaan);
                $cekfilter      = [];
                $pertanyaan     = NULL;
                foreach ($katapertanyaan as $kata) {
                    if (!in_array($kata,$kataumum)) {
                        $pertanyaan .= $kata.' ';
                    }
                    if (in_array($kata,$katafilter)) {
                        $cekfilter[] = $kata;
                    }
                }
                $pertanyaan     = trim($pertanyaan); // hapus spasi

                $db             = Chatomzbot::where('pertanyaan','LIKE','%'.$pertanyaan.'%')->where('status','valid')->first();
                if ($db) {
                    $jawaban    = '<strong>'.ucfirst($simpan).'? </strong> '.$db->jawaban;
                } else {
                    // cek jika ada kata yang perlu di filter
                    if (count($cekfilter) > 0) {
                        $cekfilter  = array_unique($cekfilter);
                        $katajahat  = implode(',',$cekfilter);
                        $jawaban    = 'maaf pertanyaan anda terdeteksi mengandung kata yang tidak bijak ('.$katajahat.')';
                    } else {
                        // cek terlebih dahulu apakah pertanyaan sudah ada atau tidak
                        $cek    = Chatomzbot::where('pertanyaan',$simpan)->first();
                        if (!$cek) {
                            // jika tidak ada jawaban, maka pertanyaan disimpan untuk bot lebih banyak inspirasi
                            Chatomzbot::create([
                                'pertanyaan' => $simpan,
                                'status' => 'proses'
                            ]);
                        }
                        $jawaban    = 'maaf saya tidak mengerti, saya akan mempelajarinya';
                    }
                    
                }
            }
            return view('chatomz.coding.bot.test', compact('menu','main','jawaban'));
        }
        $bots   = Chatomzbot::where('status',$status)->get();
        $botvalid   = Chatomzbot::where('status','valid')->get();
        return view('chatomz.coding.bot.index', compact('menu','main','bots','botvalid'));
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
        $apertanyaan    = explode(',',$request->pertanyaan);
        $pertanyaan     = [];
        for ($i=0; $i < count($apertanyaan); $i++) { 
            if (!is_null($apertanyaan[$i]) AND $apertanyaan[$i] <> '') {
                $tanya  = $apertanyaan[$i];
                $tanya = str_replace('?','',$tanya);
                $tanya = str_replace('\r\n','',$tanya);
                $tanya = trim($tanya);
                 // cek apakah pertanyaan ada di data lainnya
                 $cek = Chatomzbot::where('pertanyaan','LIKE','%'.$tanya.'%')->first();
                 if (!$cek) {
                     $pertanyaan[] = $tanya;
                 }
            }
        }
        if (count($pertanyaan) > 0) {
            $pertanyaan = array_unique($pertanyaan);
            Chatomzbot::create([
                'pertanyaan' => json_encode($pertanyaan),
                'jawaban' => $request->jawaban,
                'status' => $request->status
            ]);
            return back()->with('ds','Bot');
        } else {
            return back()->with('danger','data sudah ada');
        }


        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chatomzbot  $chatomzbot
     * @return \Illuminate\Http\Response
     */
    public function show(Chatomzbot $chatomzbot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chatomzbot  $chatomzbot
     * @return \Illuminate\Http\Response
     */
    public function edit(Chatomzbot $chatomzbot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chatomzbot  $chatomzbot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // cek apakah pertanyaan akan dimasukkan ke jawaban yang sudah ada
        if ($request->datajawaban == 'tidak') {
            $apertanyaan    = explode(',',$request->pertanyaan);
            $pertanyaan     = [];
            for ($i=0; $i < count($apertanyaan); $i++) { 
                if (!is_null($apertanyaan[$i]) AND $apertanyaan[$i] <> '') {
                    $tanya  = $apertanyaan[$i];
                    $tanya = str_replace('?','',$tanya);
                    $tanya = str_replace('\r\n','',$tanya);
                    $tanya = trim($tanya);
                    // cek apakah pertanyaan ada di data lainnya
                    $cek = Chatomzbot::where('id','<>',$request->id)->where('pertanyaan','LIKE','%'.$tanya.'%')->first();
                    if (!$cek) {
                        $pertanyaan[] = $tanya;
                    }
                }
            }
            $pertanyaan = array_unique($pertanyaan);
            Chatomzbot::where('id',$request->id)->update([
                'pertanyaan' => json_encode($pertanyaan),
                'jawaban' => $request->jawaban,
                'status' => $request->status
            ]);
        } else {
            $bot    = Chatomzbot::find($request->datajawaban);
            $pertanyaan = json_decode($bot->pertanyaan,TRUE);
            $pertanyaan = array_merge($pertanyaan,[$request->pertanyaan]);
            Chatomzbot::where('id',$bot->id)->update([
                'pertanyaan' => json_encode($pertanyaan),
                'status' => 'valid'
            ]);

            // hapus data sebelumnya
            Chatomzbot::find($request->id)->delete();
        }
        
        return back()->with('du','Bot');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chatomzbot  $chatomzbot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chatomzbot $chatomzbot)
    {
        $chatomzbot->delete();
        return back()->with('dd','Bots');
    }
}

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
                $pertanyaan     = $_GET['pertanyaan'];
                $pertanyaan     = str_replace('?','',$pertanyaan);
                // hapus pertanyaan default
                $pertanyaan     = str_replace('apa','',$pertanyaan);
                $pertanyaan     = str_replace('kamu','',$pertanyaan);
                $pertanyaan     = str_replace('anda','',$pertanyaan);
                $pertanyaan     = str_replace('dimana','',$pertanyaan);
                $pertanyaan     = trim($pertanyaan); // hapus spasi
                $db             = Chatomzbot::where('pertanyaan','LIKE','%'.$pertanyaan.'%')->where('status','valid')->first();
                if ($db) {
                    $jawaban    = '<strong>'.ucfirst($pertanyaan).'? </strong> '.$db->jawaban;
                } else {
                    // jika tidak ada jawaban, maka pertanyaan disimpan untuk bot lebih banyak inspirasi

                    // cek terlebih dahulu apakah pertanyaan sudah ada atau tidak
                    $cek    = Chatomzbot::where('pertanyaan',$pertanyaan)->first();
                    if (!$cek) {
                        Chatomzbot::create([
                            'pertanyaan' => $pertanyaan,
                            'status' => 'proses'
                        ]);
                    }
                    $jawaban    = 'maaf saya tidak mengerti, saya akan mempelajarinya';
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
        $pertanyaan = array_unique($pertanyaan);
        Chatomzbot::create([
            'pertanyaan' => json_encode($pertanyaan),
            'jawaban' => $request->jawaban,
            'status' => 'valid'
        ]);

        return back()->with('ds','Bot');

        
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

<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Chatomzbot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class LandingController extends Controller
{
    public function __construct()
    {
        $this->middleware('visitorhits');
    }

    public function index()
    {
        return view('homepage.index');
    }

    public function content($sesi)
    {
        switch ($sesi) {
            case 'bot':
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
                        $jawaban    = '<strong>'.ucfirst($simpan).'? </br> </strong> '.$db->jawaban;
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
                return view('homepage.content.bot', compact('jawaban'));
                break;
            
            default:
                return 'tidak ada sesi';
                break;
        }
    }
}

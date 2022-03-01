<?php

namespace App\Http\Controllers;

use App\Models\Chatomzbot;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function grab()
    {
        $url = "https://kurs.dollar.web.id/bank.php/?/@bca";
        $url = "http://citrasievertgemilang6.blogspot.com/2013/12/100-soal-pengetahuan-umum-dan-jawabannya.html";
        $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );
 
        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );
    
        // echo $content;
        $kata   = explode('Binatang yang bisa hidup di air',$content);
        $kata2   = explode('(Trakea)',$kata[1]);
        // dd($kata2[0]);
        $table = $kata2[0];
        $table = strip_tags($table);
        $table = str_replace("&nbsp;",'',$table);
        $table = "Binatang yang bisa hidup di air ". $table." (Trakea)";
        $table  = explode("\n",$table);
        // dd($table);
        $simpan = [];
        foreach ($table as $key) {
            $pecah  = explode("(",$key);
            $pertanyaan    = str_replace(")",'',$pecah[1]);
            $pertanyaan     = strtolower($pertanyaan);
            $jawaban     = trim($pecah[0]);
            $jawaban     = strtolower($jawaban);
            // $simpan[] = 'pertanyaan : '.$pertanyaan.' | '.$jawaban;
            // cek apakah pertanyaan sudah ada atau belum
            $cekbot     = Chatomzbot::where('pertanyaan','LIKE',"%".$pertanyaan."%")->first();
            if (!$cekbot) {
                $pertanyaan = [$pertanyaan];
                Chatomzbot::create([
                    'pertanyaan' => json_encode($pertanyaan),
                    'jawaban' => $jawaban,
                    'status' => 'proses',
                ]);
                $pertanyaan = NULL;
            }
        }
        die();
        // dd($simpan);
        // $table = str_replace('</div>','',$table);
        // $table = str_replace('</b>','',$table);
        // $table = str_replace('<b>','',$table);
        return view('demo.grab', compact('table'));
    }
}

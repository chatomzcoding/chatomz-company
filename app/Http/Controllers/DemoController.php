<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Chatomzbot;
use App\Models\Orang;
use App\Models\User;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function architectui()
    {
        return view('chatomz.admin.architectui');
    }
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

    public function mazer()
    {
        return view('sistem.uji.mazer');
    }

    public function backupdb()
    {
        $data           = Barang::all();
        $namaplikasi    = 'chatomz_company';
        $nama           = 'contoh';
        $tgl            = tgl_sekarang();
        $data           = json_encode($data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://sistem.zelnara.com/api/backupdb',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'aplikasi='.$namaplikasi.'&nama='.$nama.'&tgl='.$tgl.'&data='.$data,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
    }

    public function calendar()
    {
        return view('demo.calendar');
    }

    public function mapbox($s)
    {
        $token  = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
        $tasikmalaya = [108.217451, -7.323059];
        $orang  = Orang::where('nilai_lat','<>',NULL)->get();
        $data = [];
        foreach ($orang as $key) {
            $img    = asset('img/chatomz/orang/'.$key->photo);
            $data[] = [
                'type' => 'Feature',
                'properties' => [
                    'message' => fullname($key),
                    'iconSize' => [50, 50],
                    'poto'  => asset('img/chatomz/orang/'.$key->photo),
                    'description' =>
                    '<img src="'.$img.'" width="100%"><strong>'.fullname($key).'</strong>
                    <p>'.$key->home_address.'</p>',
                    'icon' => 'music-15'
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$key->nilai_long, $key->nilai_lat]
                ]
            ];
        }
        $data   = [
            'features' => $data
        ];
        // ini contoh untuk mendapatkan style
        return view('demo.mapbox.'.$s, compact('token','tasikmalaya','data'));
    }
}

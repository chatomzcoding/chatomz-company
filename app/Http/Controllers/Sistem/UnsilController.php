<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Orang;
use Illuminate\Http\Request;

class UnsilController extends Controller
{
    public function index()
    {
        $npm = (isset($_GET['npm'])) ? $_GET['npm'] : '147006136' ;
        $result = self::getnpm($npm)['data'];
        return view('demo.unsil', compact('result'));
    }

    public function getnpm($npm)
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        
        // $response = file_get_contents("https://maps.co.weber.ut.us/arcgis/rest/services/SDE_composite_locator/GeocodeServer/findAddressCandidates?Street=&SingleLine=3042+N+1050+W&outFields=*&outSR=102100&searchExtent=&f=json", false, stream_context_create($arrContextOptions));
        
        $json = file_get_contents("https://simak.unsil.ac.id/api/v1/mahasiswa/".$npm,false, stream_context_create($arrContextOptions));
        // $mahasiswa[] = json_decode($json, TRUE);
        return json_decode($json, TRUE);
    }

    public function simpan(Request $request)
    {
        $nama   = explode(' ',$request->nama);
        if (count($nama) == 1) {
            $first_name = $request->nama;
            $last_name  = NULL;
        }elseif (count($nama) == 2) {
            $first_name = $nama[0];
            $last_name  = $nama[1];
        } else {
            $first_name = $nama[0];
            $last_name  = NULL;
            for ($i=0; $i < count($nama); $i++) { 
                if ($i <> 0) {
                    $last_name .= $nama[$i].' ';
                }
            }
        }
        
        Orang::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'date_birth' => $request->date_birth,
            'marital_status' => $request->marital_status,
            'blood_type' => 'none',
            'nasionality' => 'indonesia',
            'status_group' => 'available',
            'home_address' => $request->home_address,
        ]);

        return back()->with('ds','Orang');
    }
}

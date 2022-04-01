<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Orang;
use Illuminate\Http\Request;

class UnsilController extends Controller
{
    public function index()
    {
        $s = (isset($_GET['s'])) ? $_GET['s'] : NULL ;
        switch ($s) {
            case 'many':
                $npm = (isset($_GET['npm'])) ? $_GET['npm'] : '147006136' ;
                $angka = (isset($_GET['angka'])) ? $_GET['angka'] : 5 ;
                $batas  = $npm + $angka;
                $list   = [];
                for ($i=$npm; $i < $batas; $i++) { 
                    $result = self::getnpm($i)['data'];
                    $dnama  = explode(' ',$result['Nama']);
                    $first_name = $dnama[0];
                    if (count($dnama) == 1) {
                        $last_name = $dnama[0];
                        $orang  = Orang::where('first_name','LIKE','%'.$first_name.'%')->Orwhere('last_name','LIKE','%'.$last_name.'%')->get();
                    } else {
                        $last_name = $dnama[1];
                        $orang  = Orang::where('first_name','LIKE','%'.$first_name.'%')->where('last_name','LIKE','%'.$last_name.'%')->get();
                    }
                    $list[] = [
                        'orang' => $orang,
                        'unsil' => $result
                    ];
                }
                return view('demo.unsilmany', compact('list','npm','angka','batas'));
                break;
            
            default:
                $npm = (isset($_GET['npm'])) ? $_GET['npm'] : '147006136' ;
                $result = self::getnpm($npm)['data'];
                $dnama  = explode(' ',$result['Nama']);
                $first_name = $dnama[0];
                if (count($dnama) == 1) {
                    $last_name = $dnama[0];
                    $orang  = Orang::where('first_name','LIKE','%'.$first_name.'%')->Orwhere('last_name','LIKE','%'.$last_name.'%')->get();
                } else {
                    $last_name = $dnama[1];
                    $orang  = Orang::where('first_name','LIKE','%'.$first_name.'%')->where('last_name','LIKE','%'.$last_name.'%')->get();
                }
                return view('demo.unsil', compact('result','orang'));
                break;
        }
    }

    public function getnpm($npm)
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        
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
            'first_name' => strtolower($first_name),
            'last_name' => strtolower($last_name),
            'gender' => $request->gender,
            'religion' => $request->religion,
            'date_birth' => $request->date_birth,
            'marital_status' => $request->marital_status,
            'blood_type' => 'none',
            'nasionality' => 'indonesia',
            'status_group' => 'available',
            'home_address' => strtolower($request->home_address),
            'note' => $request->note,
        ]);

        // return back()->with('ds','Orang');
        return redirect('unsil?s=many&npm='.$request->npm.'&angka='.$request->angka)->with('ds','Orang');
    }
}

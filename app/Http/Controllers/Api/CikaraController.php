<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grup;
use App\Models\Grupanggota;
use App\Models\Orang;
use Illuminate\Http\Request;

class CikaraController extends Controller
{
    public function index()
    {
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'index' ;
        $result = [
            'status' => FALSE,
            'developer' => 'Firman Chatomz',
            'information' => 'Cikara API'
        ];
        switch ($s) {
            case 'magang':
                $grup   = Grup::where('name','cikara magang')->first();
                $anggota = [];
                foreach ($grup->anggota as $key) {
                    $anggota[] = [
                        'anggota' => $key,
                        'detail' => $key->orang
                    ];
                }

                $result = [];

                foreach ($anggota as $key) {
                    $result[] = $key['anggota'];
                }

                break;
            
            default:
                # code...
                break;
        }

        return $result;
    }

    public function simpanmagang(Request $request)
    {
        $nama_file = unduhgambar('chatomz/orang',time().'-'.$request->first_name,$request->photo);
             Orang::create([
                 'first_name'  => strtolower($request->first_name),
                 'last_name'  => strtolower($request->last_name),
                 'nick_name' => '',
                 'place_birth' => strtolower($request->place_birth),
                 'date_birth' => $request->date_birth,
                 'gender' => $request->gender,
                 'home_address' => strtolower($request->home_address),
                 'current_address' => strtolower($request->home_address),
                 'religion' => $request->religion,
                 'blood_type' => $request->blood_type,
                 'nasionality' => 'indonesia',
                 'job_status' => $request->job_status,
                 'marital_status' => 'belum',
                 'status_group' => 'available',
                 'photo' => $nama_file,
                 'death' => '',
                 'note' => strtolower($request->note),
             ]);
             $orang     = Orang::where('first_name',$request->first_name)->where('last_name',$request->last_name)->where('date_birth',$request->date_birth)->first();
             if ($orang) {
                 Grupanggota::create([
                     'grup_id' => 32,
                     'orang_id' => $orang->id,
                     'information' => $request->note
                 ]);
             }

             return TRUE;
    }
}

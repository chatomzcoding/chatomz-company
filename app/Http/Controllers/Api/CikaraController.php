<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grup;
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
}

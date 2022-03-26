<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Orang;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function orang()
    {
        $orang  = Orang::orderBy('first_name','ASC')->get();
        // fase kehidupan
            $bayi = [];
            $kanak = [];
            $anak = [];
            $remaja = [];
            $dewasa = [];
            $tua = [];
            $lansia = [];
        // kelengkapan data
        $alamat = [];
        $pekerjaan = [];
        $tempat = [];
        $tanggal = [];
        $note = [];
        $photo = [];
                foreach ($orang as $item) {
                    if (is_null($item->home_address) || $item->home_address == '') {
                        $alamat[] = $item;
                    }
                    if (is_null($item->job_status) || $item->job_status == '') {
                        $pekerjaan[] = $item;
                    }
                    if (is_null($item->place_birth) || $item->place_birth == '') {
                        $tempat[] = $item;
                    }
                    if (is_null($item->date_birth) || $item->date_birth == '') {
                        $tanggal[] = $item;
                    }
                    if (is_null($item->note) || $item->note == '') {
                        $note[] = $item;
                    }
                    if (is_null($item->photo) || $item->photo == '') {
                        $photo[] = $item;
                    }

                    if (!is_null($item->date_birth)) {
                        $umur = explode(' ',age($item->date_birth));
                        $u      = $umur[0];
                        if ($u <= 3) {
                            $bayi[] = $item;
                        }elseif ($u > 3 AND $u <= 5) {
                            $kanak[] = $item;
                        }elseif ($u > 5 AND $u <= 11) {
                            $anak[] = $item;
                        }elseif ($u > 11 AND $u <= 18) {
                            $remaja[] = $item;
                        }elseif ($u > 18 AND $u <= 40) {
                            $dewasa[] = $item;
                        }elseif ($u > 40 AND $u <= 60) {
                            $tua[] = $item;
                        }else{
                            $lansia[] = $item;
                        }
                    }
                }
                $data   = 
                [ 
                    'kelengkapandata' => [
                        'alamat' => $alamat,
                        'pekerjaan' => $pekerjaan,
                        'tempat lahir' => $tempat,
                        'tanggal lahir' => $tanggal,
                        'Catatan' => $note,
                        'photo' => $photo
                    ],
                    'fasekehidupan' => [
                        'bayi' => $bayi,
                        'kanak' => $kanak,
                        'anak' => $anak,
                        'remaja' => $remaja,
                        'dewasa' => $dewasa,
                        'tua' => $tua,
                        'lansia' => $lansia
                    ]
                ];
        return view('sistem.statistik.orang', compact('data'));
    }
}

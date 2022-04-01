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
        $biodata    = [
            'home_address' => 'tempat tinggal',
            'job_status' => 'pekerjaan',
            'place_birth' => 'tempat lahir',
            'date_birth' => 'tanggal lahir',
            'note' => 'catatan'
        ];
        // agama
        $islam =kingdom_agama();
        // agama
        $jk = ['laki-laki','perempuan'];
        // goldar
        $goldar     = kingdom_goldar();
                foreach ($orang as $item) {
                    for ($i=0; $i < count($goldar); $i++) { 
                        if ($goldar[$i] == $item->blood_type) {
                            $dgoldar[$goldar[$i]][] = $item;
                        }                        
                    }
                    for ($i=0; $i < count($jk); $i++) { 
                        if ($jk[$i] == $item->gender) {
                            $djk[$jk[$i]][] = $item;
                        }                        
                    }
                    for ($i=0; $i < count($islam); $i++) { 
                        if ($islam[$i] == $item->religion) {
                            $dislam[$islam[$i]][] = $item;
                        }                        
                    }
                   
                    foreach ($biodata as $key => $value) {
                        $field  = $key;
                        if (is_null($item->$field) || $item->$field == '') {
                            $dbiodata[$value][] = $item;
                        }                        
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
                    'goldar' => $dgoldar,
                    'jk' => $djk,
                    'kelengkapandata' => $dbiodata,
                    'fasekehidupan' => [
                        'bayi' => $bayi,
                        'kanak' => $kanak,
                        'anak' => $anak,
                        'remaja' => $remaja,
                        'dewasa' => $dewasa,
                        'tua' => $tua,
                        'lansia' => $lansia
                    ],
                    'agama' => $dislam
                ];
        $datafase = [];
        foreach ($data['fasekehidupan'] as $key => $value) {
            $datafase[] = count($value);
        }
        $datagoldar = [];
        foreach ($data['goldar'] as $key => $value) {
            $datagoldar[] = count($value);
        }
        $datajk = [];
        foreach ($data['jk'] as $key => $value) {
            $datajk[] = count($value);
        }

        $chart  = [
            'fase' => [
                'label' => ['bayi','kanak-kanak','anak','remaja','dewasa','tua','lansia'],
                'data' => $datafase
            ],
            'goldar' => [
                'label' => $goldar,
                'data' => $datagoldar
            ],
            'jk' => [
                'label' => $jk,
                'data' => $datajk
            ]
        ];
        return view('sistem.statistik.orang', compact('data','chart'));
    }
}

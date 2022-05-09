<?php

namespace App\Http\Controllers\Api\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use Illuminate\Http\Request;

class SilsilahkeluargaController extends Controller
{
    public function show($slug)
    {
        $keluarga   = Keluarga::where('slug',$slug)->first();
        if ($keluarga) {
            $pohonkeluarga = [];
            // add suami
            $istri          = $keluarga->istri->orang;
            $suami          = $keluarga->orang;
            $pohonkeluarga[] = ["id" => $istri->id, "pids" => [$suami->id], "name" => fullname($istri), "gender" => kingdom_genderenglish($istri->gender), 'photo' => kingdom_orangpotourl($istri->photo)];
            $pohonkeluarga[] = ["id" => $suami->id, "pids" => [$istri->id], "name" => fullname($suami), "gender" => kingdom_genderenglish($suami->gender), 'photo' => kingdom_orangpotourl($suami->photo)];
            
            // anak keturunan pertama

            foreach ($keluarga->anakketurunan as $i) {
                // cek pasangan
                if ($i->orang->gender == 'laki-laki') {
                    $mid = '';
                    if (isset($i->orang->kepalakeluarga->istri)) {
                        $dataistri  = $i->orang->kepalakeluarga->istri;
                        $mid = $dataistri->id;
                        $pohonkeluarga[] = ["id" => $dataistri->orang->id, "pids" => [$i->orang->id], "name" => fullname($dataistri->orang), "gender" => kingdom_genderenglish($dataistri->orang->gender),'photo' => kingdom_orangpotourl($dataistri->orang->photo)];
                        $pohonkeluarga[] = ["id" => $i->orang->id, "mid" => $istri->id, "fid" => $suami->id, "pids" => [$dataistri->orang->id],"name" => fullname($i->orang), "gender" => kingdom_genderenglish($i->orang->gender),'photo' => kingdom_orangpotourl($i->orang->photo)];
                    } else {
                        $pohonkeluarga[] = ["id" => $i->orang->id, "mid" => $istri->id, "fid" => $suami->id, "name" => fullname($i->orang), "gender" => kingdom_genderenglish($i->orang->gender),'photo' => kingdom_orangpotourl($i->orang->photo)];

                    }
                    $fid = $i->orang->id;
                    
                } else {
                    $fid = '';
                    if (isset($i->orang->istri->keluarga->orang)) {
                        $datasuami = $i->orang->istri->keluarga->orang;
                        $fid = $datasuami->id;
                        $pohonkeluarga[] = ["id" => $i->orang->id, "mid" => $istri->id, "fid" => $suami->id, "pids" => [$datasuami->id],"name" => fullname($i->orang), "gender" => kingdom_genderenglish($i->orang->gender),'photo' => kingdom_orangpotourl($i->orang->photo)];
                        $pohonkeluarga[] = ["id" => $datasuami->id, "pids" => [$i->orang->id],"name" => fullname($datasuami), "gender" => kingdom_genderenglish($datasuami->gender),'photo' => kingdom_orangpotourl($datasuami->photo)];
                    } else {
                        $pohonkeluarga[] = ["id" => $i->orang->id, "mid" => $istri->id, "fid" => $suami->id, "name" => fullname($i->orang), "gender" => kingdom_genderenglish($i->orang->gender),'photo' => kingdom_orangpotourl($i->orang->photo)];
                    }
                    $mid = $i->orang->id;
                }
                
                // anak keturunan kedua
                foreach (kingdom_keturunan($i->orang) as $j) {
                    
                    $pohonkeluarga[] = ["id" => $j->orang->id, "mid" => $mid, "fid" => $fid, "name" => fullname($j->orang), "gender" => kingdom_genderenglish($j->orang->gender),'photo' => kingdom_orangpotourl($j->orang->photo)];

                    if ($j->orang->gender == 'laki-laki') {
                        $mid2 = '';
                        $fid2 = $j->orang->id;
                    } else {
                        $mid2 = $j->orang->id;
                        $fid2 = '';
                    }
                    
                    // anak keturunan ketiga
                    foreach (kingdom_keturunan($j->orang) as $k) {
                        $pohonkeluarga[] = ["id" => $k->orang->id, "mid" => $mid2, "fid" => $fid2, "name" => fullname($k->orang), "gender" => kingdom_genderenglish($k->orang->gender),'photo' => kingdom_orangpotourl($k->orang->photo)];
                        
                    }
                }
            }

            return [
                'keluarga' => $keluarga,
                'silsilah' => $pohonkeluarga
            ];
        } // end of if keluarga
    }
}

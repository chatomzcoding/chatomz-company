<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UjiController extends Controller
{
    public function pengujian($sesi)
    {
        switch ($sesi) {
            case 'maps':
                $data = [
                    ['Jakarta Pusat', '-6.2060905', '106.8475342'],
                    ['Jakarta Utara', '-6.1554034', '106.8926811'],
                    ['Jakarta Selatan', '-6.2614652', '106.810627'],
                    ['Jakarta Barat', '-6.1674356', '106.7637634'],
                    ['Jakarta Timur', '-6.2248623', '106.9004059'],
                    ['Kota Depok', '-6.4024778', '106.7942333'],
                    ['Kota Bogor', '-6.5971469', '106.8060388'],
                    ['Kab. Bogor', '-6.5517758', '106.6291304'],
                    ['Kota Sukabumi', '-6.9277901', '106.9299316'],
                    [ 'Kab. Sukabumi', '-7.2134052', '106.6291304'],
                    [ 'Kab. Cianjur', '-7.3579773', '107.1957203'],
                    [ 'Kab. Bekasi', '-6.3668231', '107.1736908'],
                    [ 'Kota Bekasi', '-6.2381727', '106.9755936']
                ];
                return view('sistem.uji.maps', compact('data'));
                // return view('sistem.uji.marker', compact('data'));
                break;
            
            default:
                # code...
                break;
        }
    }
}

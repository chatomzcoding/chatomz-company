<?php

namespace App\Http\Controllers;

use App\Models\Kategoriproduk;
use Illuminate\Http\Request;
use PDF;

class CetakController extends Controller
{
    public function get()
    {
        $kategori = Kategoriproduk::all();
        return view('pengujian.cetak', compact('kategori'));
    }

    public function out()
    {
        $kategori   = Kategoriproduk::all();
        $pdf        = PDF::loadView('pengujian.cetak', compact('kategori'));
        return $pdf->download('pengujian.pdf');
    }
}

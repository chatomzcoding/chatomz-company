<?php

namespace App\Http\Controllers\Bisnis;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WadeController extends Controller
{
    public function index()
    {
        $produk     = Produk::with('kategori')->where('aplikasi','wadec')->orderBy('nama_produk')->get();
        $kategori   = Kategori::where('label','wadec')->get();
        return view('company.bisnis.wadec.index', compact('produk','kategori'));
    }
}

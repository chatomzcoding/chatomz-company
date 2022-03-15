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
        $produk     = DB::table('produk')
                        ->join('kategori','produk.kategori_id','=','kategori.id')
                        ->select('produk.*','kategori.nama_kategori')
                        ->where('produk.aplikasi','wadec')
                        ->get();
        $kategori   = Kategori::where('label','wadec')->get();
        return view('company.bisnis.wadec.index', compact('produk','kategori'));
    }
}

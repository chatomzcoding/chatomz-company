<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Grup;
use App\Models\Informasi;
use App\Models\Informasisub;
use App\Models\Item;
use App\Models\Jejak;
use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\Keluarga;
use App\Models\Linimasa;
use App\Models\Orang;
use App\Models\Pendidikan;
use App\Models\Riwayat;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('visitorhits');
    // }
    public function index()
    {
        $dashboard  = TRUE;
        $user       = Auth::user();
        switch ($user->level) {
            case 'admin':
                $orang          = Orang::count();
                $grup           = Grup::count();
                $keluarga       = Keluarga::count();
                $jejak          = Jejak::count();
                $total      = [
                    'orang' => $orang,
                    'grup' => $grup,
                    'keluarga' => $keluarga,
                    'jejak' => $jejak,
                ];

                // kebutuhan info
                $ulangtahunbulanini     = Orang::whereMonth('date_birth',ambil_bulan())->orderBy('first_name','ASC')->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                $ulangtahuntanggalini     = Orang::whereMonth('date_birth',ambil_bulan())->whereDay('date_birth',ambil_tgl())->orderBy('first_name','ASC')->limit(3)->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                $info = [
                    'ulangtahunbulanini' => $ulangtahunbulanini,
                    'ulangtahuntanggalini' => $ulangtahuntanggalini
                ];
                $jumlahlakilaki     = Orang::where('gender','laki-laki')->count();
                $meninggal              = Orang::where('death','alm')->count();
                $jumlahperempuan    = $orang - $jumlahlakilaki;
                $hidup    = $orang - $meninggal;
                $gender = [$jumlahlakilaki,$jumlahperempuan];
                $kematian = [$hidup,$meninggal];
                $data       = [
                    'riwayatlihatorang' => Riwayat::where('kode','lihatorang')->limit(4)->latest()->get(),
                    'orangbaru' => Orang::limit(4)->latest()->get()
                ];
                $chart = [
                    'visitor' => self::chartvisitor()
                ];
                $jurnal         = Jurnal::where('tanggal',tgl_sekarang())->get();
                $jurnalkeuangan = PerhitunganDompet($jurnal);
                $main   = [
                    'jurnalkeuangan' => $jurnalkeuangan
                ];
                return view('chatomz.admin.dashboard', compact('main','total','dashboard','info','gender','kematian','data','chart'));
                break;
            default:
                $statistik = [
                    'orang' => count($user->orangakses),
                    'keluarga' => count($user->keluargaakses)
                ];
                return view('member.dashboard', compact('statistik'));
                break;
        }
    }

    public static function chartvisitor()
    {
        $label  = [];
        $nilai  = [];
        for ($i=1; $i <= ambil_tgl() ; $i++) { 
            $label[]    = $i;
            $hits    = Visitor::whereYear('tgl_visitor',ambil_tahun())
                            ->whereMonth('tgl_visitor',ambil_bulan())
                            ->whereDay('tgl_visitor',$i)->sum('hits');
            $nilai[] = $hits;
        }
        $result = [
            'label' => $label,
            'nilai' => $nilai
        ];
        return $result;
    }

    public function statistik()
    {
        // data orang yang baru ditambahkan ditampilkan 8 data
        $orangbaru      = Orang::limit(8)->orderByDesc('id')->get();
        $data = [
            'orangbaru' => $orangbaru
        ];

        return view('sistem.statistik', compact('data'));
    }

    public function cari()
    {
        $s = (isset($_GET['s'])) ? $_GET['s'] : NULL ;
        switch ($s) {
            case 'carinama':
                $cari   = $_GET['nama'];
                // BARANG
                $dbarang     = Barang::where('nama_barang','LIKE','%'.$cari.'%')->get();
                $barang     = [];
                foreach ($dbarang as $key) {
                    $barang[] = [
                        'nama' => $key->nama_barang,
                        'photo' => 'img/chatomz/barang/'.$key->photo_barang,
                        'info' => $key->keterangan,
                        'link' => 'barang/'.$key->id
                    ];
                }

                // ITEM
                $ditem      = Item::where('nama_item','LIKE','%'.$cari.'%')->get();
                $listitem   = [];
                foreach ($ditem as $key) {
                    $listitem[] = [
                        'nama' => $key->nama_item,
                        'photo' => 'img/chatomz/item/'.$key->gambar_item,
                        'info' => $key->keterangan,
                        'link' => 'item/'.$key->id
                    ];
                }

                // ORANG
                $dnama  = explode(' ',$cari);
                $first_name = $dnama[0];
                if (count($dnama) == 1) {
                    $last_name = $dnama[0];
                    $dorang  = Orang::where('first_name','LIKE','%'.$first_name.'%')->Orwhere('last_name','LIKE','%'.$last_name.'%')->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                } else {
                    $last_name = $dnama[1];
                    $dorang  = Orang::where('first_name','LIKE','%'.$first_name.'%')->where('last_name','LIKE','%'.$last_name.'%')->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                }
                $orang  = [];
                foreach ($dorang as $key) {
                    $orang[] = [
                        'nama' => kingdom_fullname($key),
                        'photo' => 'img/chatomz/orang/'.$key->photo,
                        'info' => age($key->date_birth),
                        'link' => 'orang/'.Crypt::encryptString($key->id)
                    ];
                }
                $datainformasi    = Kategori::where('label','informasi')->get();
                $informasi      = [];
                foreach ($datainformasi as $key) {
                    $dinformasi = $key->informasi;
                    if (count($dinformasi) > 0) {
                        foreach ($key->informasi as $item) {
                            // cek sesuai dengan pencarian
                            if (preg_match("/".$cari."/i", $item->nama)) {
                                switch ($key->nama_kategori) {
                                    case 'masakan':
                                        $detail     = json_decode($item->detail);
                                        $detail = (isset($detail->servings)) ? $detail->servings : NULL ;
                                        break;
                                    case 'film':
                                        $detail     = json_decode($item->detail);
                                        $detail = (isset($detail->Year)) ? 'Tahun '.$detail->Year : NULL ;
                                        break;
                                    case 'hewan':
                                        $detail     = json_decode($item->detail);
                                        $detail = (isset($detail->tentang)) ? substr($detail->tentang,0,100).'...' : NULL ;
                                        break;
                                    case 'phone':
                                        $detail     = json_decode($item->detail);
                                        $detail = (isset($detail->jumlah)) ? $detail->jumlah.' Model' : NULL ;
                                        break;
                                    
                                    default:
                                        $detail = NULL;
                                        break;
                                }
                                $informasi[$key->nama_kategori][] = [
                                    'nama' => $item->nama,
                                    'photo' => 'img/company/informasi/'.$key->nama_kategori.'/'.$item->gambar,
                                    'info' => $detail,
                                    'link' => 'informasi/'.$item->id
                                ];
                            }

                            // khusus phone
                            if ($key->nama_kategori == 'phone') {
                                $model      = $item->informasisub;
                                // loop model
                                foreach ($model as $row) {
                                    $detailsub  = json_decode($row->detail_sub);
                                    if(preg_match("/".$cari."/i", $row->nama_sub)) {
                                        $informasi[$key->nama_kategori][] = [
                                            'nama' => $item->nama.' '.$row->nama_sub,
                                            'photo' => 'img/company/informasi/'.$key->nama_kategori.'/'.$row->gambar_sub,
                                            'info' => $detailsub->release_date,
                                            'link' => 'informasisub/'.$row->id
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }
                $judul  = 'Pencarian key : "'.$cari.'"';
                $data   = [
                    'barang' => $barang,
                    'orang' => $orang,
                    'listitem' => $listitem,
                ];
                $data = array_merge($data,$informasi);
                break;
            
            case 'ulangtahuntanggalini':
                $judul  = 'Ulang tahun tanggal '.ambil_tgl().' bulan '.bulan_indo();
                $orang     = Orang::whereMonth('date_birth',ambil_bulan())->whereDay('date_birth',ambil_tgl())->orderBy('first_name','ASC')->limit(3)->get(['id','first_name','last_name','gender','death','photo','date_birth']);
                break;
            
            case 'statistik':
                $orang  = Orang::all();
                break;

            default:
                return redirect('dashboard')->with('danger','tidak ada apa apa');
                break;
        }
        return view('sistem.list', compact('data','judul'));
    }

    // kalendar
    public function kalender()
    {
        // referensi
        // "id" => "required-id-2",
        // "name" => "Firman Day", 
        // "date" => ["2022-05-10","2022-05-13"] | "2022-05-12"
        // "type" => "event" | "holiday" | "birthday 
        // "everyYear" => false,
        // "description" =>"ini adalah hari yang spesial",
        // "color" => "#222"

        $data   = [];
        $linimasa   = Linimasa::orderBy('tanggal','desc')->get();
        foreach ($linimasa as $key) {
            $tanggal = (!is_null($key->tanggal_akhir)) ? [$key->tanggal,$key->tanggal_akhir] : $key->tanggal ;
            $data[] = [
                "id" => $key->id,
                "name" => $key->nama, 
                "date" => $tanggal,
                "type" => "event", 
                "everyYear" => false,
                "description" => $key->keterangan,
                // "color" => "#222"
            ];
        }

        $ulangtahunbulanini     = Orang::whereMonth('date_birth',ambil_bulan())->orderBy('first_name','ASC')->get(['id','first_name','last_name','gender','death','photo','date_birth']);
        foreach ($ulangtahunbulanini as $key) {
            $tanggal = ambil_tahun().'-'.ambil_bulan().'-'.substr($key->date_birth,8,2);
            $data[] = [
                "id" => $key->id,
                "name" => fullname($key), 
                "date" => $tanggal,
                "type" => "birthday", 
                "everyYear" => false,
                "description" => $key->gender,
                // "color" => "#222"
            ];
        }
        
        return view('chatomz.sistem.calendar', compact('data'));
    }
}

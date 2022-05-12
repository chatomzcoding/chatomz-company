<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Grup;
use App\Models\Keluarga;
use App\Models\Keluargahubungan;
use App\Models\Orang;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('menu','orang');
        $orang  = Orang::select('id','first_name','last_name','gender','home_address')->orderBy('first_name','ASC')->get();
        return view('chatomz.kingdom.orang.index', compact('orang'));
    }

    public function orangpoto()
    {
        $datasemua  = Orang::select('id','date_birth','first_name','last_name','gender','photo','death')->orderBy('first_name','ASC')->get();
        if (!isset($_GET['kelamin'])) {
            $kelamin        = 'semua';
            $perkawinan     = 'semua';
            $kematian       = 'semua';
            $usia1           = 0;
            $usia2           = 100;
            $orang  = $datasemua;
        } else {
            $kelamin        = $_GET['kelamin'];
            $perkawinan        = $_GET['perkawinan'];
            $kematian        = $_GET['kematian'];
            $usia_awal        = $_GET['usia_awal'];
            $usia_akhir        = $_GET['usia_akhir'];
            // cek kelamin
            if ($kelamin == 'semua' AND $perkawinan == 'semua') {
                $orang = $datasemua;
            } else {
                // cek jika kelamin semua dan perkawinan bukan semua
                if ($kelamin == 'semua') {
                    $orang  = Orang::select('id','date_birth','first_name','last_name','gender','photo','death')->where('marital_status',$perkawinan)->orderBy('first_name','ASC')->get();
                } else {
                    if ($perkawinan == 'semua') {
                        $orang  = Orang::select('id','date_birth','first_name','last_name','gender','photo','death')->where('gender',$kelamin)->orderBy('first_name','ASC')->get();
                    } else {
                        $orang  = Orang::select('id','date_birth','first_name','last_name','gender','photo','death')->where('gender',$kelamin)->where('marital_status',$perkawinan)->orderBy('first_name','ASC')->get();
                    }
                }
            }
            // cek usia
            $data   = [];
            foreach ($orang as $item) {
                $usia = kingdom_umur($item->date_birth);
                // cek kematian
                if ($kematian == 'semua') {
                    if ($usia >= $usia_awal AND $usia <= $usia_akhir ) {
                        $data[] = $item;
                    }
                } else {
                    if ($item->death == $kematian) {
                        if ($usia >= $usia_awal AND $usia <= $usia_akhir ) {
                            $data[] = $item;
                        }
                    }                    
                }
            }
            $kematian   = $kematian;
            $orang      = $data;
            $kelamin    = $kelamin;
            $perkawinan = $perkawinan;
            $usia1 = $usia_awal;
            $usia2 = $usia_akhir;
        }

        $sesi = [
            'kelamin' => $kelamin,
            'perkawinan' => $perkawinan,
            'usia1' => $usia1,
            'usia2' => $usia2,
            'kematian' => $kematian
        ];
        
        return view('chatomz.kingdom.orang.lihatpoto', compact('orang','sesi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chatomz.kingdom.orang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required','max:4']
        ]);
       if (isset($request->photo)) {
            $request->validate([
                'photo' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
            ]);
            $file = $request->file('photo');
            $nama_file = kompres($file,'public/img/chatomz/orang');
            
        } else {
            $nama_file = NULL;
        }
        Orang::create([
            'first_name'  => strtolower($request->first_name),
            'last_name'  => strtolower($request->last_name),
            'nick_name' => strtolower($request->nick_name),
            'place_birth' => strtolower($request->place_birth),
            'date_birth' => $request->date_birth,
            'gender' => $request->gender,
            'home_address' => strtolower($request->home_address),
            'current_address' => strtolower($request->current_address),
            'religion' => $request->religion,
            'blood_type' => $request->blood_type,
            'nasionality' => $request->nasionality,
            'job_status' => $request->job_status,
            'marital_status' => $request->marital_status,
            'status_group' => $request->status_group,
            'photo' => $nama_file,
            'death' => $request->death,
            'note' => strtolower($request->note),
        ]);
        $orang = Orang::latest()->first();

        return redirect('orang/'.Crypt::encryptString($orang->id))->with('ds','Orang');
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orang  $orang
     * @return \Illuminate\Http\Response
     */
    public function show($orang)
    {
        $orang  = Orang::find(Crypt::decryptString($orang));
        $tombol['next'] = Orang::where("id",'>',$orang->id)->first();
        $tombol['back'] = Orang::where("id",'<',$orang->id)->orderBy('id','DESC')->first();
        // riwayat keluarga
        $keluarga   = DB::table('keluarga_hubungan')
        ->join('orang','keluarga_hubungan.orang_id','=','orang.id')
        ->join('keluarga','keluarga_hubungan.keluarga_id','=','keluarga.id')
        ->select('keluarga_hubungan.*','orang.first_name','orang.last_name','orang.photo','orang.death','orang.gender','keluarga.nama_keluarga')
        ->where('keluarga_hubungan.orang_id',$orang->id)
        ->orderBy('keluarga_hubungan.urutan','ASC')
        ->get();
        $suami          = Keluarga::where('orang_id',$orang->id)->get();
        $dkeluarga      = Keluarga::all();
        $daftarkeluarga = [];
        foreach ($dkeluarga as $item) {
            // cek jika belum ada istri
            $keluargahubungan = Keluargahubungan::where('keluarga_id',$item->id)->where('status','istri')->first();
            if (!$keluargahubungan) {
                $daftarkeluarga[] = $item;
            }
        }
        // grup
        $anggotagrup    = DB::table('grup_anggota')
                            ->join('grup','grup_anggota.grup_id','=','grup.id')
                            ->select('grup_anggota.*','grup.name','grup.photo')
                            ->where('grup_anggota.orang_id',$orang->id)
                            ->orderBy('grup.name','ASC')
                            ->get();
        $datagrup       = Grup::orderBy('name','ASC')->get();
        // save riwayat dilihat
        // cek jika sudah dilihat
        $cekriwayat = Riwayat::where('kode','lihatorang')->where('nilai',$orang->id)->first();
        if ($cekriwayat) {
            Riwayat::where('id',$cekriwayat->id)->update([
                'tanggal' => tgl_sekarang(),
                'detail' => 'lihat profil'
            ]);
        } else {
            Riwayat::create([
                'kode' => 'lihatorang',
                'tanggal' => tgl_sekarang(),
                'nilai' => $orang->id,
                'detail' => 'lihat profil'
            ]);
        }
        return view('chatomz.kingdom.orang.show', compact('orang','tombol','keluarga','suami','daftarkeluarga','anggotagrup','datagrup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orang  $orang
     * @return \Illuminate\Http\Response
     */
    public function edit($orang)
    {
        $orang  = Orang::find(Crypt::decryptString($orang));
        return view('chatomz.kingdom.orang.edit', compact('orang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orang  $orang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $orang  = Orang::find($request->id);
        $sesi = (isset($request->sesi)) ? $request->sesi : 'update' ;
        switch ($sesi) {
            case 'ubahphoto':
                $request->validate([
                    'photo' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
                ]);
                $file = $request->file('photo');
                $tujuan_upload = 'public/img/chatomz/orang';
                $nama_file = kompres($file,$tujuan_upload);
                deletefile($tujuan_upload.'/'.$orang->photo);
                Orang::where('id',$orang->id)->update([
                    'photo' => $nama_file
                ]);

                return back()->with('success','Photo sudah dirubah');
                break;
            
            default:
            if (isset($request->photo)) {
                $request->validate([
                    'photo' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
                ]);
                $file = $request->file('photo');
                $tujuan_upload = 'public/img/chatomz/orang';
                $nama_file = kompres($file,$tujuan_upload);
                deletefile($tujuan_upload.'/'.$orang->photo);
            } else {
                $nama_file = $orang->photo;
            }
            if (isset($request->perbaharui)) {
                Orang::where('id',$orang->id)->update([
                    'place_birth' => $request->place_birth,
                    'date_birth' => $request->date_birth,
                    'gender' => $request->gender,
                    'home_address' => $request->home_address,
                    'blood_type' => $request->blood_type,
                    'marital_status' => $request->marital_status,
                    'status_group' => $request->status_group,
                    'photo' => $nama_file,
                    'death' => $request->death,
                    'note' => $request->note,
                ]);
                return redirect('statistik/orang?m='.$request->m.'&t='.$request->t)->with('du','Orang');
            } else {
                Orang::where('id',$orang->id)->update([
                    'first_name'  => strtolower($request->first_name),
                    'last_name'  => strtolower($request->last_name),
                    'nick_name' => strtolower($request->nick_name),
                    'place_birth' => strtolower($request->place_birth),
                    'date_birth' => $request->date_birth,
                    'gender' => $request->gender,
                    'home_address' => strtolower($request->home_address),
                    'current_address' => strtolower($request->current_address),
                    'religion' => $request->religion,
                    'blood_type' => $request->blood_type,
                    'nasionality' => $request->nasionality,
                    'job_status' => $request->job_status,
                    'marital_status' => $request->marital_status,
                    'status_group' => $request->status_group,
                    'photo' => $nama_file,
                    'death' => $request->death,
                    'note' => strtolower($request->note),
                ]);
                return redirect('orang/'.Crypt::encryptString($orang->id))->with('du','Orang');
            }
                break;
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orang  $orang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orang $orang)
    {
        $orang->delete();
        $tujuan_upload = 'public/img/chatomz/orang';
        deletefile($tujuan_upload.'/'.$orang->photo);

        return redirect('orang')->with('dd','Orang');
    }
}

<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Orang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Swift;

class OrangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orang  = Orang::select('id','first_name','last_name','gender','home_address')->orderBy('first_name','ASC')->get();
        return view('chatomz.kingdom.orang.index', compact('orang'));
    }

    public function orangpoto($sesi)
    {
        $datasemua  = Orang::select('id','date_birth','first_name','last_name','gender','photo')->orderBy('first_name','ASC')->get();
        if ($sesi == 'semua') {
            $kelamin        = 'semua';
            $perkawinan     = 'semua';
            $usia1           = 0;
            $usia2           = 100;
            $orang  = $datasemua;
        } else {
            // pecahkan data parameter
            $sesi   = explode('_',$sesi);
            // cek kelamin
            if ($sesi[0] == 'semua' AND $sesi[1] == 'semua') {
                $orang = $datasemua;
            } else {
                // cek jika kelamin semua dan perkawinan bukan semua
                if ($sesi[0] == 'semua') {
                    $orang  = Orang::select('id','date_birth','first_name','last_name','gender','photo')->where('marital_status',$sesi[1])->orderBy('first_name','ASC')->get();
                } else {
                    if ($sesi[1] == 'semua') {
                        $orang  = Orang::select('id','date_birth','first_name','last_name','gender','photo')->where('gender',$sesi[0])->orderBy('first_name','ASC')->get();
                    } else {
                        $orang  = Orang::select('id','date_birth','first_name','last_name','gender','photo')->where('gender',$sesi[0])->where('marital_status',$sesi[1])->orderBy('first_name','ASC')->get();
                    }
                    
                }
                
            }
            // cek usia
            $data   = [];
            foreach ($orang as $item) {
                $usia = kingdom_umur($item->date_birth);
                if ($usia >= $sesi[2] AND $usia <= $sesi[3] ) {
                    $data[] = $item;
                }
            }

            $orang      = $data;
            $kelamin    = $sesi[0];
            $perkawinan = $sesi[1];
            $usia1 = $sesi[2];
            $usia2 = $sesi[3];
        }

        $sesi = [
            'kelamin' => $kelamin,
            'perkawinan' => $perkawinan,
            'usia1' => $usia1,
            'usia2' => $usia2
        ];
        
        return view('chatomz.kingdom.orang.lihatpoto', compact('orang','sesi'));
    }

    public function prosesorangpoto(Request $request)
    {
        return redirect('/lihat/orangpoto/'.$request->kelamin.'_'.$request->perkawinan.'_'.$request->usia1.'_'.$request->usia2);
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
        // validation form
        $request->validate([
            'first_name' => 'required',
            'place_birth' => 'required',
            'date_birth' => 'required',
       ]);
       if (isset($request->photo)) {
            // validation form photo
            $request->validate([
                'photo' => 'required|file|image|mimes:jpeg,png,jpg|max:1000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('photo');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/chatomz/orang';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
        } else {
            $nama_file = NULL;
        }
        Orang::create([
            'first_name'  => $request->first_name,
            'last_name'  => $request->last_name,
            'nick_name' => $request->nick_name,
            'place_birth' => $request->place_birth,
            'date_birth' => $request->date_birth,
            'gender' => $request->gender,
            'home_address' => $request->home_address,
            'current_address' => $request->current_address,
            'religion' => $request->religion,
            'blood_type' => $request->blood_type,
            'nasionality' => $request->nasionality,
            'job_status' => $request->job_status,
            'marital_status' => $request->marital_status,
            'status_group' => $request->status_group,
            'photo' => $nama_file,
            'death' => $request->death,
            'note' => $request->note,
        ]);
        $orang = Orang::latest()->first();

        return redirect('orang/'.Crypt::encryptString($orang->id))->with('ds','Orang');
    }

    public function cariorang(Request $request)
    {
        $orang  = Orang::where('first_name','LIKE','%'.$request->nama.'%')->Orwhere('last_name','LIKE','%'.$request->nama.'%')->get();
        return view('chatomz.kingdom.orang.index', compact('orang'));

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
        $kontak         = Orang::find($orang->id)->kontak;
        $pendidikan     = Orang::find($orang->id)->pendidikan;
        return view('chatomz.kingdom.orang.show', compact('orang','tombol','kontak','pendidikan'));
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
    public function update(Request $request, Orang $orang)
    {
        // validation form
        $request->validate([
            'first_name' => 'required',
            'place_birth' => 'required',
            'date_birth' => 'required',
       ]);
       if (isset($request->photo)) {
            // validation form photo
            $request->validate([
                'photo' => 'required|file|image|mimes:jpeg,png,jpg|max:1000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('photo');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/chatomz/orang';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$nama_file);
            deletefile($tujuan_upload.'/'.$orang->photo);
        } else {
            $nama_file = $orang->photo;
        }
        Orang::where('id',$orang->id)->update([
            'first_name'  => $request->first_name,
            'last_name'  => $request->last_name,
            'nick_name' => $request->nick_name,
            'place_birth' => $request->place_birth,
            'date_birth' => $request->date_birth,
            'gender' => $request->gender,
            'home_address' => $request->home_address,
            'current_address' => $request->current_address,
            'religion' => $request->religion,
            'blood_type' => $request->blood_type,
            'nasionality' => $request->nasionality,
            'job_status' => $request->job_status,
            'marital_status' => $request->marital_status,
            'status_group' => $request->status_group,
            'photo' => $nama_file,
            'death' => $request->death,
            'note' => $request->note,
        ]);
        return redirect('orang/'.Crypt::encryptString($orang->id))->with('du','Orang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orang  $orang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orang $orang)
    {
        $tujuan_upload = 'img/chatomz/orang';
        deletefile($tujuan_upload.'/'.$orang->photo);

        $orang->delete();

        return redirect('/orang')->with('dd','Orang');
    }
}

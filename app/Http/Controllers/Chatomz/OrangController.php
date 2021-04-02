<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Orang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OrangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orang  = Orang::orderBy('first_name','ASC')->get();
        return view('chatomz.orang.index', compact('orang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chatomz.orang.create');
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
            $nama_file = 'person.png';
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
        return view('chatomz.orang.show', compact('orang','tombol'));
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
        return view('chatomz.orang.edit', compact('orang'));
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
        //
    }
}

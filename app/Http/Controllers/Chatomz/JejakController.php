<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Jejak;
use App\Models\Jejakorang;
use App\Models\Jejakpoto;
use App\Models\Kategori;
use App\Models\Orang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class JejakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $folder   = 'public/img/chatomz/jejak';
    protected $view     = 'chatomz.kingdom.jejak.';

    public function index()
    {
        $jejak      = Jejak::orderby('tanggal','desc')->get();
        $kategori   = Kategori::all();
        return view($this->view.'index', compact('jejak','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->gambar_jejak)) {
            // validation form gambar_jejak
            $request->validate([
                'gambar_jejak' => 'required|file|image|mimes:jpeg,png,jpg|max:10000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar_jejak');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($this->folder,$nama_file);

            // $nama_file = kompres($file,$tujuan_upload,1200);
            
        } else {
            $nama_file = NULL;
        }
        Jejak::create([
            'nama_jejak'  => $request->nama_jejak,
            'tanggal'  => $request->tanggal,
            'keterangan_jejak' => $request->keterangan_jejak,
            'lokasi' => $request->lokasi,
            'kategori' => $request->kategori,
            'gambar_jejak' => $nama_file,
        ]);
        $jejak = Jejak::latest()->first();

        return redirect('jejak/'.Crypt::encryptString($jejak->id))->with('ds','Jejak');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jejak  $jejak
     * @return \Illuminate\Http\Response
     */
    public function show($jejak)
    {
        $jejak  = Jejak::find(Crypt::decryptString($jejak));
        $orang  = Orang::select('id','first_name','last_name','death')->orderBy('first_name','ASC')->get();
        $jejakorang     = DB::table('jejak_orang')
                            ->join('orang','jejak_orang.orang_id','=','orang.id')
                            ->select('jejak_orang.*','orang.first_name','orang.last_name','orang.death','orang.gender','orang.photo')
                            ->where('jejak_orang.jejak_id',$jejak->id)
                            ->orderBy('orang.first_name','ASC')
                            ->get();
        $kategori   = Kategori::all();
        $jejakpoto  = Jejakpoto::where('jejak_id',$jejak->id)->get();
        return view($this->view.'show', compact('jejak','orang','jejakorang','kategori','jejakpoto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jejak  $jejak
     * @return \Illuminate\Http\Response
     */
    public function edit(Jejak $jejak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jejak  $jejak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $jejak  = Jejak::find($request->id);
        if (isset($request->gambar_jejak)) {
            // validation form gambar_jejak
            $request->validate([
                'gambar_jejak' => 'required|file|image|mimes:jpeg,png,jpg|max:10000',
            ]);
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('gambar_jejak');
            
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($this->folder,$nama_file);
            deletefile($this->folder.'/'.$jejak->gambar_jejak);

            // $nama_file = kompres($file,$tujuan_upload,1200);
            
        } else {
            $nama_file = $jejak->gambar_jejak;
        }
        Jejak::where('id',$request->id)->update([
            'nama_jejak'  => $request->nama_jejak,
            'tanggal'  => $request->tanggal,
            'keterangan_jejak' => $request->keterangan_jejak,
            'lokasi' => $request->lokasi,
            'kategori' => $request->kategori,
            'gambar_jejak' => $nama_file,
        ]);
        return redirect()->back()->with('du','Jejak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jejak  $jejak
     * @return \Illuminate\Http\Response
     */
    public function destroy($jejak)
    {
        $jejak  = Jejak::find($jejak);

        deletefile('public/img/chatomz/jejak/'.$jejak->gambar_jejak);
        $jejak->delete();

        return redirect('/jejak')->with('dd','Jejak');
    }
}

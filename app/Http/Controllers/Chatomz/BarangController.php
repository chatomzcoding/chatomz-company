<?php

namespace App\Http\Controllers\Chatomz;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'index' ;
        $barang     = Barang::all();
        switch ($s) {
            case 'dashboard':
                $totalasset    = Barang::where('status_barang','ada')->sum('harga_beli');
                return view('chatomz.kingdom.barang.dashboard', compact('barang','totalasset'));
                break;
            
            default:
                return view('chatomz.kingdom.barang.index', compact('barang'));
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chatomz.kingdom.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $s  = (isset($request->s)) ? $request->s : 'store' ;
        $id = uniqid();
        switch ($s) {
            case 'data':
                $barang     = Barang::find($request->id);
                $detail     = json_decode($barang->detail,TRUE);
                $namaformat = $request->nama_format;
                $format     = $detail[$namaformat]['format'];
                $data = [];
                foreach ($format as $key) {
                    $field  = $key['field']; 
                    $data[$field] = $request->$field;
                }
                $hasil = [
                    $id => $data
                ];
                // cek data ada atau tidak
                if (count($detail[$namaformat]['data']) > 0) {
                    $hasil = array_merge($detail[$namaformat]['data'],$hasil);    
                }
                $detail[$namaformat]['data'] = $hasil;

                Barang::where('id',$barang->id)->update([
                    'detail' => json_encode($detail)
                ]);
                return back()->with('ds','Data '.ucwords($request->nama_format));
                break;
            case 'format':
                $barang     = Barang::find($request->id);
                // cek detail
                $format     = [
                    'info' => $request->info,
                    'label' => $request->label,
                    'format' => [],
                    'data' => []
                ];
                $detail_r = [
                    $request->nama_format => $format
                ];
                if (is_null($barang->detail)) {
                    $detail = $detail_r;
                } else {
                    $detail_l   = json_decode($barang->detail,TRUE);
                    $detail     = array_merge($detail_l,$detail_r);
                }
                
                Barang::where('id',$barang->id)->update([
                    'detail' => json_encode($detail)
                ]);
                return back()->with('ds','Format '.ucwords($request->nama_format));
                break;
            case 'field':
                $barang     = Barang::find($request->id);
                $detail     = json_decode($barang->detail,TRUE);
                $field_r    = [
                    $id => [
                    'field' => $request->field,
                    'tipe' => $request->tipe,
                    'fungsi' => $request->fungsi,
                    ]
                ];
                // cek jika belum ada field
                if (is_null($detail[$request->nama_format]['format'])) {
                    $detail[$request->nama_format]['format'] = $field_r;
                } else {
                    $field = array_merge($detail[$request->nama_format]['format'],$field_r);
                    $detail[$request->nama_format]['format'] = $field;
                }
                Barang::where('id',$barang->id)->update([
                    'detail' => json_encode($detail)
                ]);
                return back()->with('ds','Field '.ucwords($request->field));
                break;
            default:
                $request->validate([
                    'photo_barang' => 'required|file|image|mimes:jpeg,png,jpg,webp|max:4000',
                ]);
                $tujuan_upload = 'public/img/chatomz/barang';
                $file = $request->file('photo_barang');
                $nama_file = time()."_".$file->getClientOriginalName();
                // $mini = $request->file('photo_barang');
                // $mg_barang = kompres($mini,$tujuan_upload,150,'mini'); bug compress png
                $mg_barang = $nama_file;
                $file->move($tujuan_upload,$nama_file);
        
                Barang::create([
                    'nama_barang' => $request->nama_barang,
                    'kondisi' => $request->kondisi,
                    'merk' => $request->merk,
                    'sumber' => $request->sumber,
                    'keterangan' => $request->keterangan,
                    'harga_jual' => default_nilai($request->harga_jual),
                    'harga_beli' => default_nilai($request->harga_beli),
                    'tgl_kepemilikan' => $request->tgl_kepemilikan,
                    'status_barang' => $request->status_barang,
                    'photo_barang' => $nama_file,
                    'mg_barang' => $mg_barang,
                ]);
        
                $barang     = Barang::latest()->first();
        
                return redirect('barang/'.$barang->id)->with('ds','Barang');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'show' ;
        $format = (isset($_GET['format'])) ? $_GET['format'] : 'show' ;
        switch ($s) {
            case 'format':
                $detail = json_decode($barang->detail);
                $dataformat = $detail->$format;
                return view('chatomz.kingdom.barang.format', compact('barang','dataformat','format'));
                break;
            case 'data':
                $detail = json_decode($barang->detail);
                $dataformat = $detail->$format;
                return view('chatomz.kingdom.barang.data', compact('barang','dataformat','format'));
                break;
            case 'detail':
                return view('chatomz.kingdom.barang.detail', compact('barang'));
                break;
            default:
                return view('chatomz.kingdom.barang.show', compact('barang'));
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('chatomz.kingdom.barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $s = (isset($request->s)) ? $request->s : 'update' ;
        $barang     = Barang::find($request->id);
        switch ($s) {
            case 'simple':
                if (isset($request->photo_barang)) {
                    $request->validate([
                        'photo_barang' => 'required|file|image|mimes:jpeg,png,jpg,webp|max:4000',
                    ]);
                    $tujuan_upload = 'public/img/chatomz/barang';
                    $file = $request->file('photo_barang');
                    // $mini = $request->file('photo_barang');
                    $nama_file = time()."_".$file->getClientOriginalName();
                    // $mg_barang = kompres($mini,$tujuan_upload,150,'mini');
                    $mg_barang = $nama_file;
                    $file->move($tujuan_upload,$nama_file);
        
                    deletefile($tujuan_upload.'/'.$barang->photo_barang);
                    deletefile($tujuan_upload.'/'.$barang->mg_barang);
                } else {
                    $nama_file =$barang->photo_barang;
                    $mg_barang =$barang->mg_barang;
                }
        
                Barang::where('id',$request->id)->update([
                    'nama_barang' => $request->nama_barang,
                    'photo_barang' => $nama_file,
                    'mg_barang' => $mg_barang,
                ]);
        
                return redirect()->back()->with('du','Barang');
                break;
            
            default:
                if (isset($request->photo_barang)) {
                    $request->validate([
                        'photo_barang' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
                    ]);
                    $tujuan_upload = 'public/img/chatomz/barang';
                    $file = $request->file('photo_barang');
                    // $mini = $request->file('photo_barang');
                    // $mg_barang = kompres($mini,$tujuan_upload,150,'mini');
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $mg_barang = $nama_file;
                    $file->move($tujuan_upload,$nama_file);
        
                    deletefile($tujuan_upload.'/'.$barang->photo_barang);
                    deletefile($tujuan_upload.'/'.$barang->mg_barang);
                } else {
                    $nama_file =$barang->photo_barang;
                    $mg_barang =$barang->mg_barang;
                }
                Barang::where('id',$request->id)->update([
                    'nama_barang' => $request->nama_barang,
                    'kondisi' => $request->kondisi,
                    'merk' => $request->merk,
                    'sumber' => $request->sumber,
                    'keterangan' => $request->keterangan,
                    'harga_beli' => default_nilai($request->harga_beli),
                    'harga_jual' => default_nilai($request->harga_jual),
                    'tgl_kepemilikan' => $request->tgl_kepemilikan,
                    'status_barang' => $request->status_barang,
                    'photo_barang' => $nama_file,
                    'mg_barang' => $mg_barang,
                ]);
                return redirect('barang/'.$barang->id)->with('du','Barang');
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'destroy' ;
        switch ($s) {
            case 'format':
                $detail     = json_decode($barang->detail,TRUE);
                // proses hapus format by id
                unset($detail[$_GET['format']]['format'][$_GET['id']]);
                Barang::where('id',$barang->id)->update([
                    'detail' => json_encode($detail)
                ]);
                return back()->with('dd','Format');
                break;
            case 'data':
                $detail     = json_decode($barang->detail,TRUE);
                unset($detail[$_GET['format']]['data'][$_GET['id']]);
                Barang::where('id',$barang->id)->update([
                    'detail' => json_encode($detail)
                ]);
                return back()->with('dd','Format');
                break;
            default:
                $tujuan_upload = 'public/img/chatomz/barang';
                deletefile($tujuan_upload.'/'.$barang->photo_barang);
                deletefile($tujuan_upload.'/'.$barang->mg_barang);
                $barang->delete();
                return redirect('barang')->with('dd','Barang');
                break;
        }
    }
}

<?php
namespace App\Http\Helpers\Chatomz;

use App\Models\Keluarga;
use App\Models\Keluargahubungan;
use App\Models\Produkdiskon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DbChatomz {

    public static function cekketurunankeluarga($id,$jk)
    {
        if ($jk == 'perempuan') {
            $keluarga = Keluargahubungan::where('orang_id',$id)->where('status','istri')->first();
            if ($keluarga) {
                $idkeluarga = $keluarga->keluarga_id;
            } else {
                return FALSE;
            }
        } else {
            $keluarga = Keluarga::where('orang_id',$id)->first();
            if ($keluarga) {
                $idkeluarga = $keluarga->id;
            } else {
                return FALSE;
            }
        }
        return $idkeluarga;
    }

    public static function cekstatusistri($id)
    {
        $istri  = Keluargahubungan::where('orang_id',$id)->where('status','istri')->first();
        return $istri;
    }
    public static function countGroupId($id) {
        $jumlah = DB::table('members')->where('group_id', $id)->count();
        return $jumlah;
    }
    public static function produkdiskonid($id)
    {
        $diskon         = Produkdiskon::where('produk_id',$id)->where('tgl_awal','<=',tgl_sekarang())->where('tgl_akhir','>=',tgl_sekarang())->first();
        return $diskon;
    }

    public static function personid($id)
    {
        $person = DB::table('persons')->where('id',$id)->first();
        return $person;
    }
    public static function showtableid($table,$id)
    {
        $data = DB::table($table)->where('id',$id)->first();
        return $data;
    }
    public static function kategoriakses($akses)
    {
        $kategori = DB::table('kategori')->where('akses',$akses)->get();
        return $kategori;
    }
    public static function person()
    {
        $person = DB::table('persons')->get();
        return $person;
    }

    // count total add new person in today
    public static function Totalperson()
    {
        $now = date('Y-m-d');
        $newperson = DB::table('persons')->whereDate('created_at',$now)->count();
        return $newperson;
    }

    public static function familyId($person_id,$status)
    {
        $relationship = DB::table('relationships')->where("person_id",$person_id)->where('status',$status)->first();
        if (!is_null($relationship)) {
            return $relationship->family_id;
        } else {
            $family = DB::table('families')->where("person_id",$person_id)->first();
            if (!is_null($family) AND $status != 'anak') {
                return $family->id;
            }
            return NULL;
        }

    }

    // filter person for children in add family
    public static function filterchildren($person_id)
    {
        $relationship = DB::table('relationships')->where('person_id',$person_id)->where('status','anak')->count();
        if ($relationship > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public static function getsetting($field)
    {
        $setting    = DB::table('user_akses')
        ->join('setting','user_akses.setting_id','=','setting.id')
        ->where('user_akses.user_id',Auth::user()->id)
        ->first();
        if ($setting) {
            switch ($field) {
                case 'tema':
                    $result = $setting->tema;
                    break;

                case 'logo':
                    $result = 'img/setting/'.$setting->logo_aplikasi;
                    break;
                case 'brand':
                    $result = 'img/setting/'.$setting->logo_brand;
                    break;

                case 'avatar':
                    $result = 'img/setting/'.$setting->avatar;
                    break;
                case 'nama_tab':
                    $result = $setting->nama_tab;
                    break;
                case 'nama_aplikasi':
                    $result = $setting->nama_aplikasi;
                    break;
                case 'nama_alias':
                    $result = $setting->nama_alias;
                    break;
                case 'id':
                    $result = $setting->id;
                    break;
                
                default:
                    # code...
                    break;
            }
        } else {
            switch ($field) {
                case 'tema':
                    $result = 'dark';
                    break;
              
                case 'logo':
                    $result = 'atlantis/img/logo.svg';
                    break;
                    
                case 'brand':
                    $result = 'atlantis/img/logo.svg';
                    break;

                case 'avatar':
                    $result = 'atlantis/img/profile.jpg';
                    break;
                case 'nama_tab':
                    $result = 'Halaman Web';
                    break;
                case 'nama_aplikasi':
                    $result = 'Aplikasi Web';
                    break;
                default:
                    # code...
                    break;
            }
        }
        return $result;
    }

    // total data tabel
    public static function countData($table=null,$where=null)
    {
        $total = null;
        if (!is_null($table)) {
            if (!is_null($where) AND is_array($where)) {
                if (count($where) == 2) {
                    $total = DB::table($table)
                    ->where($where[0],$where[1])
                    ->count();
                }
            } else {
                $total = DB::table($table)
                ->count();
            }
            return $total;
        }
    }

    // tampil data table
    public static function showtable($table=null,$where=null)
    {
        if (!is_null($where) AND is_array($where)) {
            $show = DB::table($table)
            ->where($where[0],$where[1])
            ->get();
        } else {
            $show = DB::table($table)
            ->get();
        }
        return $show;
    }
    // tampil data table
    public static function showtablefirst($table,$where=null)
    {
        if (!is_null($where) AND is_array($where)) {
            $show = DB::table($table)
            ->where($where[0],$where[1])
            ->first();
        } else {
            $show = DB::table($table)
            ->first();
        }
        return $show;
    }
}
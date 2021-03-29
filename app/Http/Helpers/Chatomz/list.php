<?php 

// name label for reminders
if (! function_exists('reminderlabel')) {
    function reminderlabel()
    {
        $result = ['wedding','birthday','graduation','task','holiday','other'];
        return $result;
    }
}

// status keluarga
if (! function_exists('statusfamily')) {
    function statusfamily()
    {
        $result = ['menikah'=>['bg'=>'danger','icon'=>'fas fa-heart'],'bercerai'=>['bg'=>'warning','icon'=>'fas fa-heartbeat'],'talak'=>['bg'=>'secondary','icon'=>'fas fa-heartbeat']];
        return $result;
    }
}

// icon status keluarga
if (! function_exists('iconstatusfamily')) {
    function iconstatusfamily($status_family)
    {
        $icon       = statusfamily();
        $result     = $icon[$status_family]['icon'].' text-'.$icon[$status_family]['bg'];
        return $result;
    }
}




// cek umur
if (! function_exists('age')) {
    function age($date_birth,$info='Tahun')
    {
        $tgl2 				= new Datetime($date_birth);
        $now 				= new Datetime();
        $ultah = $tgl2->diff($now);
        if ($ultah->y == 0) {
            return $ultah->m.' Bulan';
        } else {
            return $ultah->y.' Tahun';
        }
        
    }
}

// colour for reminder
if (! function_exists('remindercolour')) {
    function remindercolour($label)
    {
        $colour = ['wedding'=>'secondary','graduation'=>'success','birthday'=>'info','task'=>'warning','holiday'=>'primary','other'=>'danger'];
        return $colour[$label];
    }
}

// colour for reminder
if (! function_exists('bgaddgroupicon')) {
    function bgaddgroupicon($status)
    {
        $bg = 'bg-info';
        if ($status == 'full') {
            $bg = 'bg-danger';
        }
        return $bg;
    }
}

// colour for reminder
if (! function_exists('death')) {
    function death($death)
    {
        $result = '';
        if ($death == 'alm') {
            $result = '('.$death.')';
        }
        return $result;
    }
}

// get nama lengkap
if (! function_exists('fullname')) {
    function fullname($item)
    {
        if (!is_null($item)) {
            $name = $item->first_name . ' ' . $item->last_name.' '.death($item->death);
            return ucwords($name);
        }
    }
}

// nama negara
if (! function_exists('countryname')) {
    function countryname()
    {
        $result = ['indonesia','singapura','malaysia'];
        return $result;
    }
}

// nama negara
if (! function_exists('kingdom_opsi_submenu')) {
    function kingdom_opsi_submenu()
    {
        $result = ['ya','tidak','db','kategori','sub_kategori'];
        return $result;
    }
}

// type chart
if (! function_exists('kingdom_type_chart')) {
    function kingdom_type_chart()
    {
        $result = ['pie','bar'];
        return $result;
    }
}
// daftar agama yang di akui di indonesia
if (! function_exists('kingdom_agama')) {
    function kingdom_agama()
    {
        $result = ['islam','protestan','katolik','hindu','buddha','khonghucu'];
        return $result;
    }
}
// type chart
if (! function_exists('kingdom_jk')) {
    function kingdom_jk($versi=null)
    {
        switch ($versi) {
            case '1':
                $result = ['laki - laki','perempuan'];
            break;
            case '2':
                $result = ['perempuan','laki - laki'];
            break;
            
            default:
                $result = ['laki - laki','perempuan','lainnya'];
                break;
        }
        return $result;
    }
}

// daftar agama yang di akui di indonesia
if (! function_exists('kingdom_goldar')) {
    function kingdom_goldar()
    {
        $result = ['A','B','AB','O'];
        return $result;
    }
}

// daftar agama yang di akui di indonesia
if (! function_exists('kingdom_jjgpendidikan')) {
    function kingdom_jjgpendidikan()
    {
        $result = ['Tidak Sekolah','SD','SMP/MTS','SMA/SMK/MA','Akademi','Perguruan Tinggi'];
        return $result;
    }
}


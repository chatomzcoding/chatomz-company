<?php 
// name label for reminders
if (! function_exists('list_status')) {
    function list_status()
    {
        $result = ['aktif','tidak aktif'];
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


// daftar agama yang di akui di indonesia
if (! function_exists('kingdom_statuskeluarga')) {
    function kingdom_statuskeluarga()
    {
        $result = ['menikah','bercerai','talak'];
        return $result;
    }
}

// HELPER UNTUK COMPANY INFORMASI
if (! function_exists('list_klasifikasihewan')) {
    function list_klasifikasihewan()
    {
        $result = [
            'amfibi' => 'Amfibia adalah hewan yang hidup di dua alam, air dan darat, dengan ciri kulit yang tidak bersisik dan lembab. Amfibi memiliki ciri bermetamorfosis dengan fase larva pada anakan. Amfibi adalah hewan tukang belakang, berkembang biak dengan bertelur dan berdarang dingin',
            'aves' => 'Aves adalah hewan jenis burung, yang ditandai dengan adanya bulu burung, paruh dan berdarah panas. Aves umunya berkembang biak dengan bertelur',
            'mamalia' => 'Mamalia adalah hewan dengan ciri khas menyusui. Mamalia memiliki kelenjar susu di bagian dada atau perut, yang digunakan untuk memberi makan anaknya ketika masih kecil. Mamalia adalah hewan bertulang belakang, dan merupakan hewan yang berdarah hangat',
            'pisces' => 'hewan jenis ikan. Ikan hidup di air, memiliki tukang belakang, berkembang biak dengan bertelur dan berdarang dingin',
            'reptilia' => 'Reptilia adalah hewan darat yang memiliki ciri bersisik. Reptilia memiliki tukang belakang, berkembang biak dengan bertelur dan berdarang dingin, sama seperti amfibi. Namun reptilia tidak mengalami metamorfosis'
        ];
        return $result;
    }
}

// daftar list pemakan hewan
if (! function_exists('list_hewanpemakan')) {
    function list_hewanpemakan()
    {
        $result = [
            'herbivora' => 'hewan pemakan tumbuhan',
            'karnivora' => 'hewan pemakan daging',
            'omnivora' => 'hewan pemakan tumbuhan dan daging',
        ];
        return $result;
    }
}

// TERKAIT BARANG

// daftar list kondisi barang
if (! function_exists('list_kondisibarang')) {
    function list_kondisibarang()
    {
        $list = ['baik','rusak'];
        return $list;
    }
}
if (! function_exists('list_statusbarang')) {
    function list_statusbarang()
    {
        $list = ['ada','hilang','dijual','dipinjam','dibuang'];
        return $list;
    }
}
if (! function_exists('list_manajemenkeuangan')) {
    function list_manajemenkeuangan()
    {
        $list = ['kewajiban','perencanaan','pemasukan'];
        return $list;
    }
}
if (! function_exists('list_leveluser')) {
    function list_leveluser()
    {
        $list = ['member'];
        return $list;
    }
}
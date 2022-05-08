<?php
// daftar warna bootstrap
if (! function_exists('view_listwarna')) {
    function view_listwarna(){
        $warna  = ['primary','info','success','light','dark','danger','warning'];
        return $warna;
    }
}

// random pilih warna
if (! function_exists('view_randomwarna')) {
    function view_randomwarna($filter=null){
        $warna  = view_listwarna();
        if (!is_null($filter)) {
            if (($key = array_search($filter, $warna)) !== false) {
                unset($warna[$key]);
                $warna = array_values($warna);
            }
        }
        $max    = count($warna) - 1;
        $index  = rand(0,$max);
        $result = $warna[$index]; 
        return $result;
    }
}

if (! function_exists('button_status')) {
    function button_status($nilai,$data){
        $html = null;
        if (is_array($data)) {
            foreach ($data as $status => $warna) {
                if ($status == $nilai) {
                    $html .= $warna;
                }
            }
        }
        return $html;
    }
}
if (! function_exists('menuaktif')) {
    function menuaktif($menu,$link){
       $html = ($menu == $link) ? 'active' : '' ;
        return $html;
    }
}
if (! function_exists('menudropdown')) {
    function menudropdown($data,$menu){
        $html = (in_array($menu,$data)) ? 'menu-is-opening menu-open' : NULL ;
        return $html;
    }
}

// fungsi untuk menampilkan notifikasi bahwa input wajib di isi 
if (! function_exists('ireq')) {
    function ireq()
    {
       $html = "<strong class='text-danger'>*</strong>";
       return $html;
    }
}

// fungsi untuk UI info teks
if (! function_exists('UIstatus')) {
    function UIstatus($status)
    {
        switch ($status) {
            case 'aktif':
                $html = "<span class='badge badge-success'>AKTIF</span>";
                break;
            case 'tidak aktif':
                $html = "<span class='badge badge-danger'>TIDAK AKTIF</span>";
                break;
            
            default:
                $html = NULL;
                break;
        }
       return $html;
    }
}

// fungsi untuk System Selected select form
if (! function_exists('SySelected')) {
    function SySelected($data,$index)
    {
        $system     = NULL;
        if ($data == $index) {
            $system = 'selected';
        }
        return $system;
    }
}
<?php

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
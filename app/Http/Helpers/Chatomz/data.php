<?php 

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
// status aktif tombol
if (! function_exists('aktiftombol')) {
    function aktiftombol($s,$ds,$d=NULL,$dd=null)
    {
        $result = NULL;
        if (is_null($d)) {
            if ($s == $ds) {
                $result = 'active';
            }
        } else {
            if ($s == $ds AND $d == $dd) {
                $result = 'active';
            }
        }
        return $result;
    }
}
if (! function_exists('gender')) {
    function gender($gender)
    {
        if ($gender == 'laki-laki') {
            $result = "<sup><i class='fas fa-mars text-primary'></i></sup>";  
        } else {
            $result = "<sup><i class='fas fa-venus text-danger'></i></sup>";  
        }
        return $result;
    }
}

// cek photo null apa tidak
if (! function_exists('orang_photo')) {
    function orang_photo($photo)
    {
        $nama_file     = 'orang.png';
        if (!is_null($photo)) {
            $nama_file = $photo;
        }
        return $nama_file;
    }
}

if (! function_exists('c_showtag')) {
    function c_showtag($dtag)
    {
        $result     = [];
        $dtag  = explode('#',$dtag);
        if (count($dtag) > 0) {
            unset($dtag[0]); 
            if (count($dtag) > 0) {
                $dtag  = array_map('trim',$dtag); 
                $result  = array_values($dtag); 
            }
        }
        return $result;
    }
}
if (! function_exists('c_listtag')) {
    function c_listtag($tag)
    {
        $result     = NULL;
        if (!is_null($tag)) {
            $html   = NULL;
            $tag = json_decode($tag);
            foreach ($tag as $k => $isi) {
                $html .= $k.' ';
            }
            $result     = $html;
        }
        return $result;
    }
}
if (! function_exists('linimasa_icon')) {
    function linimasa_icon($icon)
    {
        $result     = 'calendar';
        if (!is_null($icon)) {
            $result     = $icon;
        }
        return $result;
    }
}
if (! function_exists('get_saved_locations')) {
    function get_saved_locations()
    {   
        $array = [['28.710463464570836','77.30186504296853']];
        echo json_encode($array);
        $result     = NULL;
        return $result;
    }
}

if (! function_exists('showpertag')) {
    function showpertag($data,$tag)
    {   
        $result = NULL;
        if (!is_null($data)) {
            $tag    = '#'.$tag;
            $data   = json_decode($data);
            $result = $data->$tag;
        }
        return $result;
    }
}


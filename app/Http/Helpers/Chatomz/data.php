<?php 

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
            foreach ($tag as $k) {
                $html .= "#".$k.' ';
            }
            $result     = $html;
        }
        return $result;
    }
}


<?php 

// list keturunan

use Illuminate\Support\Facades\Crypt;

if (! function_exists('kingdom_keturunan')) {
    function kingdom_keturunan($data)
    {
        $result     = [];
        if ($data->gender == 'laki-laki') {
            if (isset($data->kepalakeluarga->anakketurunan)) {
                $result = $data->kepalakeluarga->anakketurunan;
            }
        } else {
           if (isset($data->istri->keluarga->anakketurunan)) {
               $result = $data->istri->keluarga->anakketurunan;
           }
       }
       return $result;
    }
}
if (! function_exists('kingdom_orangpoto')) {
    function kingdom_orangpoto($photo,$id,$class='rounded')
    {
        $html = "<a href='".url('orang/'.Crypt::encryptString($id))."'><img src='".asset('img/chatomz/orang/'.orang_photo($photo))."' class='img-fluid ".$class."'></a>";
        return $html;
    }
}
if (! function_exists('kingdom_orangpotourl')) {
    function kingdom_orangpotourl($photo)
    {
        $url = asset('img/chatomz/orang/'.orang_photo($photo));
        return $url;
    }
}
if (! function_exists('kingdom_gender')) {
    function kingdom_gender($gender)
    {
        $icon = ($gender == 'laki-laki') ? 'male' : 'female' ;
        $html   = "<sup><i class='bi bi-gender-".$icon."'></i></sup>";
        return $html;
    }
}
if (! function_exists('kingdom_genderenglish')) {
    function kingdom_genderenglish($gender)
    {
        $result = ($gender == 'laki-laki') ? 'male' : 'female' ;
        return $result;
    }
}

// get nama lengkap
if (! function_exists('kingdom_fullname')) {
    function kingdom_fullname($item)
    {
        if (!is_null($item)) {
            $name = ucwords($item->first_name . ' ' . $item->last_name.' '.death($item->death)).' '.kingdom_gender($item->gender);
            return $name;
        }
    }
}
if (! function_exists('kingdom_tokenmap')) {
    function kingdom_tokenmap()
    {
        $token = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
        return $token;
    }
}
if (! function_exists('kingdom_latlong')) {
    function kingdom_latlong()
    {
        $latlong = [108.217451, -7.323059];
        return $latlong;
    }
}
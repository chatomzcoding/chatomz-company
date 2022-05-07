<?php 

// list keturunan
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
    function kingdom_orangpoto($photo,$class='rounded')
    {
        $html = "<img src='".asset('img/chatomz/orang/'.orang_photo($photo))."' class='img-fluid ".$class."'>";
        return $html;
    }
}
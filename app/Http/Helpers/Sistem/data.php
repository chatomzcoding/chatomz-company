<?php

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
// daftar agama yang di akui di indonesia
if (! function_exists('kingdom_jjgpendidikan')) {
    function kingdom_jjgpendidikan()
    {
        $result = ['Tidak Sekolah','SD','SMP/MTS','SMA/SMK/MA','Akademi','Perguruan Tinggi'];
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
        $result = ['none','a','b','ab','o'];
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

// nama negara
if (! function_exists('countryname')) {
    function countryname()
    {
        $result = ['indonesia','singapura','malaysia'];
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
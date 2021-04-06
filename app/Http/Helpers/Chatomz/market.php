<?php 

// perhitungan diskon
if (! function_exists('market_hitungdiskon')) {
    function market_hitungdiskon($harga,$diskon)
    {
        // perhitungan harga x diskon/100
        $diskon     = $harga * $diskon/100;
        $hargabaru  = $harga - $diskon;
        return $hargabaru;
    }
}

// link pesan lewat whatsapp
if (! function_exists('market_pesanwhatsapp')) {
    function market_pesanwhatsapp($no,$pesan)
    {
        // menggunakan fitur yang diberikan whatsapp secara gratis
        $telp   = substr($no,1,11);
        $pesan  = str_replace(' ','%20',$pesan);
        $link   = "https://api.whatsapp.com/send?phone=62".$telp."&text=".$pesan;
        return $link;
    }
}
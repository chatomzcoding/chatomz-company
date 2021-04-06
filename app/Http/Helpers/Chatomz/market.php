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
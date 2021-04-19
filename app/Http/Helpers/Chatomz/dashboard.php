<?php 

// name label for reminders
if (! function_exists('chart_tanggal')) {
    // digunakan untuk mendapatkan list tanggal perbulan
    function chart_tanggal()
    {
        $result     = NULL;
        for ($i=1; $i <= ambil_tgl(); $i++) { 
            $result .= "'".$i."', ";
        }
        
        return $result;
    }
}

// name label for reminders
if (! function_exists('chart_isi')) {
    // digunakan untuk mendapatkan list tanggal perbulan
    function chart_isi()
    {
        $result     = NULL;
        for ($i=1; $i <= ambil_tgl(); $i++) {
            $visitor    = App\Models\Visitor::whereMonth('created_at',ambil_bulan())->whereDay('created_at',$i)->sum('hits'); 
            $result .= $visitor.", ";
        }
        
        return $result;
    }
}

// name label for reminders
if (! function_exists('dashboard_persentarget')) {
    // digunakan untuk mendapatkan list tanggal perbulan
    function dashboard_persentarget($real,$target)
    {
        $result     = 0;
        if ($real > 0 AND $target > 0) {
            $result     = $real / $target * 100;
        }
        
        return $result;
    }
}
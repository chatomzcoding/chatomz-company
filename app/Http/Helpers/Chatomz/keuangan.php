<?php 

// warna arus keuangan
if (! function_exists('keuanganWarnaArus')) {
    function keuanganWarnaArus($arus)
    {
       $warna = NULL;
       if ($arus == 'pemasukan') {
           $warna = 'primary';
       }
       if ($arus == 'pengeluaran') {
           $warna = 'danger';
       }

       return $warna;
    }
}
if (! function_exists('PerhitunganDompet')) {
    function PerhitunganDompet($jurnal,$saldoawal)
    {
       // hitung
       $pemasukan      = 0;
       $pengeluaran    = 0;
       $total          = $saldoawal;
       foreach ($jurnal as $key) {
           $nominal    = $key->nominal;
           if ($key->arus == 'pemasukan') {
               $total      = $total + $nominal;
               $pemasukan  = $pemasukan + $nominal;
           } else {
               $total = $total - $nominal;
               $pengeluaran  = $pengeluaran + $nominal;
           }
       }
       $hitung  = $pemasukan - $pengeluaran;
       return [
           'total' => $total,
           'pemasukan' => $pemasukan,
           'pengeluaran' => $pengeluaran,
           'hitung' => $hitung,
       ];
    }
}
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
// warna arus keuangan
if (! function_exists('keuanganWaktu')) {
    function keuanganWaktu()
    {
       $waktu = ['harian','bulanan','tahunan'];
       return $waktu;
    }
}
// nilai pencapaian minumum saldo
if (! function_exists('KeuanganProgressMinimum')) {
    function KeuanganProgressMinimum($saldo,$minimum)
    {
        $nilai = 0;
        if ($saldo > 0) {
            $nilai = $saldo / $minimum * 100; 
        }
        return $nilai;
    }
}
// total setiap alokasi
if (! function_exists('keuanganTotalManajemen')) {
    function keuanganTotalManajemen($data)
    {
        $total = 0;
        if (count($data)) {
            foreach ($data as $key) {
                $total = $total + $key->nominal;
            }
        } 
        return $total;
    }
}
if (! function_exists('PerhitunganDompet')) {
    function PerhitunganDompet($jurnal,$saldoawal=0)
    {
       // hitung
       $pemasukan      = 0;
       $pengeluaran    = 0;
       $total          = $saldoawal;
       $jumlah         = 0;
       foreach ($jurnal as $key) {
           $nominal     = $key->nominal;
           $jumlah      = $jumlah + $nominal;
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
           'jumlah' => $jumlah,
       ];
    }
}

// jumlah total harga item
if (! function_exists('subtotal')) {
    function subtotal($jumlah,$harga,$diskon)
    {
        $subtotal = 0;
        $diskon = (!is_null($diskon) AND !empty($diskon)) ? $diskon : 0 ;
        if (!is_null($harga)) {
            $subtotal = ($jumlah * $harga);
        }
        return $subtotal;
    }
}
// jumlah total harga item
if (! function_exists('jumlahhargaitemperjurnal')) {
    function jumlahhargaitemperjurnal($jurnalitem)
    {
        $jumlah = 0;
        if (isset($jurnalitem)) {
            foreach ($jurnalitem as $key) {
                if (!is_null($key->harga)) {
                    $subjumlah = ($key->harga * $key->jumlah);
                    if (!is_null($key->diskon) AND !empty($key->diskon)) {
                        $subjumlah = $subjumlah - $key->diskon;
                    }
                    $jumlah = $jumlah + $subjumlah;
                }
            }
        }
        return $jumlah;
    }
}
<?php

if (! function_exists('cek_internet')) {
    function cek_internet(){
        $connected = @fsockopen("www.google.com", 80);
        if ($connected){
         $is_conn = true; //jika koneksi tersambung
         fclose($connected);
        }else{
         $is_conn = false; //jika koneksi gagal
        }
        return $is_conn;
       }
}

// disabled link
if (! function_exists('linkDisabled')) {
    function linkDisabled($data)
    {
        $link   = '';
        if (is_null($data)) {
            $link = 'disabled';
        }
        return $link;
    }
}

// add fw plus if data is not found
if (! function_exists('addplus')) {
    function addplus($data)
    {
        $icon   = '';
        if (is_null($data)) {
            $icon = "fas fa-plus-circle" ;
        }
        return $icon;
    }
}

// get nama lengkap
if (! function_exists('deletefile')) {
    function deletefile($lokasi)
    {
        if (!is_dir($lokasi)) {
            if (file_exists($lokasi)) {
                unlink($lokasi);
            }
        }
    }
}
// get nama lengkap
if (! function_exists('kingdomlinkmenu')) {
    function kingdomlinkmenu($level)
    {
        
        $level = str_replace(' ','-',$level);
        return $level;
    }
}
// get nama lengkap
if (! function_exists('kingdom_notif_indo')) {
    function kingdom_notif_indo($notif)
    {
        $notif = str_replace('The','Input',$notif);
        $notif = str_replace('field is required','Wajib diisi',$notif);
        return $notif;
    }
}

// get nama lengkap
if (! function_exists('kingdom_avatar')) {
    function kingdom_avatar()
    {
        $gambar = 'avatar.png';
        if (!is_null(Auth::user()->avatar)) {
            $gambar = Auth::user()->avatar;
        }
        return $gambar;
    }
}

// HELPER GENERAL
// helper untuk daftar components
if (! function_exists('listcomponents')) {
    function listcomponents()
    {
        $components = [
            ['link' => 'avatars','menu'=>'avatars'],
            ['link' => 'buttons','menu'=>'buttons'],
            ['link' => 'flaticons','menu'=>'flaticons'],
            ['link' => 'font-awesome-icons','menu'=>'font awesome icons'],
            ['link' => 'gridsystem','menu'=>'grid system'],
            ['link' => 'notifications','menu'=>'notifications'],
            ['link' => 'panels','menu'=>'panels'],
            ['link' => 'simple-line-icons','menu'=>'simple line icons'],
            ['link' => 'sweetalert','menu'=>'sweet alert'],
            ['link' => 'typography','menu'=>'typography']
        ];
        return $components;
    }
}
<?php

if (! function_exists('button_status')) {
    function button_status($nilai,$data){
        $html = null;
        if (is_array($data)) {
            foreach ($data as $status => $warna) {
                if ($status == $nilai) {
                    $html .= $warna;
                }
            }
        }
        return $html;
    }
}
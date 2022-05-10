<?php
// $awal  = strtotime('2022-08-10 20:05:25');
// $akhir = strtotime('2022-08-11 06:07:33');
// $diff  = $akhir - $awal;

// $jam   = floor($diff / (60 * 60));
// $menit = $diff - ( $jam * (60 * 60) );
// $detik = $diff % 60;

// echo 'selisih: ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit, ' . $detik . ' detik';
date_default_timezone_set("Asia/Bangkok");
echo date('I-L-Y');
echo "<br>";
echo date('Y-m-d');
echo "<br>";
echo date("Y-M-d H:i:s");
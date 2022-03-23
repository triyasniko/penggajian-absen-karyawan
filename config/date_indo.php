<?php 
	function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$day = date('D', strtotime($tanggal));
	$dayList = array(
	    'Sun' => 'Minggu',
	    'Mon' => 'Senin',
	    'Tue' => 'Selasa',
	    'Wed' => 'Rabu',
	    'Thu' => 'Kamis',
	    'Fri' => 'Jumat',
	    'Sat' => 'Sabtu'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tahun
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tanggal

	// var_dump($pecahkan);
	// echo "<br>";
 	// 	echo $pecahkan[2].$pecahkan[1].$pecahkan[0];

	return $dayList[$day].' , '.$pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
	
 ?>
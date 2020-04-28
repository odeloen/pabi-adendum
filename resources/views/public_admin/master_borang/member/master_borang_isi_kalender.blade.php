<?php
header('Access-Control-Allow-Origin: *');

$bulan = date('m') * 1;
$data = array();
$data[] = array(
	'id' => 1,
	'title' => 'judul',
	// 'title'   => $row["id_pegawai"].' - '.$row["judul_kegiatan"],
	'start' => "2019-11-25", 
	'backgroundColor' => "#ac8daf",
	'textColor' => 'white',
	'tipe' => 'umum'
);
$data[] = array(
	'id' => 2,
	'title' => 'judul',
	// 'title'   => $row["id_pegawai"].' - '.$row["judul_kegiatan"],
	'start' => "2019-11-03", 
	'backgroundColor' => "#fda77f",
	'textColor' => 'white',
	'tipe' => 'umum'
);
echo json_encode($data);

?>
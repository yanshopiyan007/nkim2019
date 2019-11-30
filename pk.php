<?php
include("config.php");
	$faktur = 'TR.';
	$dot = '.';
	$results = array();
	$query= mysql_query("SELECT RIGHT(year(now()),2) as tahun , char(month(now())+64) as bulan , LEFT(time(now()),2) as waktu1,MID(time(now()),4,2) as waktu2,
		RIGHT(time(now()), 2) as waktu3, day(now()) as hari, date(now())as tanggal, time(now()) as waktu");
	while($row1 = mysql_fetch_assoc($query)){
		$id['tahun'] = $row1['tahun'];
		$id['bulan'] = $row1['bulan'];
		$id['waktu1'] = $row1['waktu1'];
		$id['waktu2'] = $row1['waktu2'];
		$id['waktu3'] = $row1['waktu3'];
		$id['hari'] = $row1['hari'];
		$id['tanggal'] = $row1['tanggal'];
		$id['waktu'] = $row1['waktu'];
	}
	$dataMax = mysql_fetch_array(mysql_query("SELECT right(`id_transaksi`,4) AS ID  FROM  input_addquestion")); // ambil data maximal dari id transaksi

	if ($dataMax['ID']=='') { // bila data kosong
		$ID = "0001";
		 $no_penjurian = $faktur.$id['hari'].$id['bulan'].$id['tahun'].$ID;
		 echo $no_penjurian;
	} else {
		$MaksID = $dataMax['ID'];
		$MaksID++;
		if ($MaksID < 10) {
			$ID1 =strval($MaksID);
			$ID = "000".$ID1; // nilai kurang dari 10
		   $no_penjurian = $faktur.$id['hari'].$id['bulan'].$id['tahun'].$ID;
		   echo $no_penjurian;
			
		} else if($MaksID < 100) {
			$ID1 =strval($MaksID);
			$ID ="00".$ID1; // nilai kurang dari 100
			$no_penjurian = $faktur.$id['hari'].$id['bulan'].$id['tahun'].$ID;
			 echo $no_penjurian;
		} else if($MaksID < 100) {
			$ID1 =strval($MaksID);
			$ID ="0".$ID1; // nilai kurang dari 100
			$no_penjurian = $faktur.$id['hari'].$id['bulan'].$id['tahun'].$ID;
			 echo $no_penjurian;
		}
	}
	$data['success'] = true;
	$data['data'] =$no_penjurian;
	echo json_encode($data);
?>
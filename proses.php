<?php
include("config.php");

$aksi = $_GET['aksi'];

if ($aksi == 'get_tema') {
	$id = $_GET['id'];

	$query = mysql_query("SELECT id_nominee, tema FROM mstr_nominee WHERE id_Dealer = '".$id."' ");
	$row = mysql_fetch_array($query);

	echo json_encode([
		'tema' => $row['tema'],
		'id_nominee' => $row['id_nominee']
	]);
} else if ($aksi == 'insert') {
	$data = json_decode(file_get_contents('php://input'), true);

	$no_penjurian = $data['no_penjurian'];
	$id_juri = $data['id_juri'];
	$fbengkel = $data['fbengkel'];
	$id_nominee = $data['id_nominee'];
	$question = $data['question'];
	$nilai = $data['nilai'];
	$total = array_sum($nilai);
	$insert = mysql_query("INSERT INTO input_addquestion (id_transaksi, id_nominee, id_juri, Keterangan,total)
		VALUES ('".$no_penjurian."','".$id_nominee."','".$id_juri."','-','".$total."')");

	if ($insert) {
		for ($i=0; $i < count($question); $i++) { 
			$insert_detail = mysql_query("INSERT INTO input_addquestion_detail (id_transaksi, id_question, nilai, keterangan)
			VALUES ('".$no_penjurian."','".$question[$i]."','".$nilai[$i]."','-')");
		}

		echo 1;
	} else {
		echo 2;
	}
} else if ($aksi == 'update') {
	$data = json_decode(file_get_contents('php://input'), true);

	$no_penjurian = $data['no_penjurian'];
	$id_juri = $data['id_juri'];
	$fbengkel = $data['fbengkel'];
	$id_nominee = $data['id_nominee'];
	$question = $data['question'];
	$nilai = $data['nilai'];
	$total = array_sum($nilai);
	$update = mysql_query("UPDATE input_addquestion SET id_nominee='".$id_nominee."', id_juri='".$id_juri."' , total ='".$total."' WHERE id_transaksi='".$no_penjurian."'");
	
	if ($update) {
		for ($i=0; $i < count($question); $i++) { 
			$insert_detail = mysql_query("UPDATE input_addquestion_detail SET nilai='".$nilai[$i]."' WHERE id_question='".$question[$i]."' AND id_transaksi='".$no_penjurian."'");
		
		}

		
	} else {
		echo 2;
	}
} else if ($aksi == 'delete') {
	$id = $_GET['id'];

	$delete = mysql_query("DELETE FROM input_addquestion WHERE id_transaksi='".$id."'");

	if ($delete) {
		$delete_detail = mysql_query("DELETE FROM input_addquestion_detail WHERE id_transaksi='".$id."'");

		echo 1;
	} else {
		echo 2;
	}
}
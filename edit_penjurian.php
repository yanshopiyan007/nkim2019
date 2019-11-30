<?php
include("config.php");
ob_start();
session_start();
{
    $aaa = $_SESSION['login'];
    $id_juri = $_SESSION['id_juri'];

if(isset($_SESSION['login'])) {
?>
<!DOCTYPE html> 
<html> 
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
       
        <link rel="apple-touch-icon" href="images/icons/launch_icon_57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="images/icons/launch_icon_72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="images/icons/launch_icon_114.png" />
	<!--<link rel="stylesheet" href="css/custom.css" />-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>TSM KODAWARI</title>  
	<link rel="stylesheet"  href="css/themes/default/jquery.mobile-1.2.0.css" />  
	<link rel="stylesheet" href="docs/_assets/css/jqm-docs.css"/>
	<script src="js/jquery.js"></script>
	<script src="docs/_assets/js/jqm-docs.js"></script>
	<script src="js/jquery.mobile-1.2.0.js"></script>
</head>
	<body>   
        <div data-role="page" id="home" data-theme="a">
			<div data-role="header" data-theme="a" data-position="fixed">
				<table border = "0" width = "100%">
					<tr>
						<td width = "20%">
							<center>
								<a href="menu.php" data-role="button" data-theme="b">Back</a>
							</center>
						</td>
						<td width = "80%">
							<center>
								<h3>INPUT PENJURIAN</h3>	
							</center>
						</td>
					<tr>
				</table>	
		    </div><!--/header-->
			<?php
				//include "../config.php";
				$sql=mysql_query("select u.*, j.id_juri from users as u, mstr_juri as j
				where u.user_name = j.id_juri
				AND u.user_name = '".$id_juri."'");
				$num = mysql_num_rows($sql);
				$row = mysql_fetch_array($sql);

				if (!empty($_GET['id'])) {
					$transaksi=mysql_query("SELECT a.id_transaksi, a.id_nominee, b.tema, c.id_Dealer FROM input_addquestion a JOIN mstr_nominee b ON a.id_nominee=b.id_nominee
					JOIN mstr_dealer c ON b.id_Dealer=c.id_Dealer WHERE a.id_transaksi='".$_GET['id']."' LIMIT 1");
					$row_transaksi = mysql_fetch_array($transaksi);

					$resultfaktur = $_GET['id'];
				} else {
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
						 $resultfaktur = $faktur.$id['hari'].$id['bulan'].$id['tahun'].$ID;
					} else {
						$MaksID = $dataMax['ID'];
						$MaksID++;
						if ($MaksID < 10) {
							$ID1 =strval($MaksID);
							$ID = "000".$ID1; // nilai kurang dari 10
						   $resultfaktur = $faktur.$id['hari'].$id['bulan'].$id['tahun'].$ID;
							
						} else if($MaksID < 100) {
							$ID1 =strval($MaksID);
							$ID ="00".$ID1; // nilai kurang dari 100
							$resultfaktur = $faktur.$id['hari'].$id['bulan'].$id['tahun'].$ID;
						} else if($MaksID < 100) {
							$ID1 =strval($MaksID);
							$ID ="0".$ID1; // nilai kurang dari 100
							$resultfaktur = $faktur.$id['hari'].$id['bulan'].$id['tahun'].$ID;
						}
					}	
				}
			?>
			<?php if (!empty($_GET['id'])) { ?>
				<form action="" method="post" onsubmit="submit_edit_form()">
			<?php } else { ?>
				
			<?php } ?>
				 <div data-role="content" data-theme="c">
					<div data-role="fieldcontain">
						<label for="no_penjurian">NO Penjurian :</label>
						<input type="text" name="no_penjurian" id="no_penjurian" value="<?php echo $resultfaktur; ?>" readonly="readonly" data-mini="true" />
					</div>
					<div data-role="fieldcontain">
						<label for="nama">Nama :</label>
						<input type="hidden" name="id_juri" id="id_juri" value="<?php echo $row["id_juri"]; ?>" readonly="readonly" data-mini="true" />
						<input type="text" name="nama" id="nama" value="<?php echo $row["real_name"]; ?>" readonly="readonly" data-mini="true" />
					</div>
					
					<div data-role="fieldcontain">
						<label for="fbengkel">Dealer :</label>
						<select name="fbengkel" id="fbengkel" onchange="getTema(this)">
									<option>[--Pilih Dealer--]</option>
							<?php 
							$sql1 = "SELECT a . * , b.nama_Dealer
									FROM mstr_dealer AS b, mstr_nominee AS a
									WHERE a.id_Dealer = b.id_Dealer";
							$qry1 = mysql_query($sql1) or
							die("Query salah : " . mysql_error());
							$num = mysql_num_rows($qry1);
							while ($data1 =mysql_fetch_array($qry1)) {
								echo "<option value='$data1[id_Dealer]' ".(!empty($_GET['id']) ? ($row_transaksi['id_Dealer'] == $data1['id_Dealer'] ? "selected" : "") : "").">$data1[nama_Dealer]</option>";
							}
							?>
					 	</select>
					</div>
				
					<div data-role="fieldcontain">
						<label for="tema">Tema :</label>
						<input type="hidden" name="id_nominee" id="id_nominee" value="<?= !empty($_GET['id']) ? $row_transaksi['id_nominee'] : '' ?>" readonly="readonly" data-mini="true" />
						<input type="text" name="tema" id="tema" value="<?= !empty($_GET['id']) ? $row_transaksi['tema'] : '' ?>" readonly="readonly" data-mini="true" />
					</div>
				</div>
				<div data-role="content" data-theme="a">
					
					<table border = "0" width="100%">
						<tr>
							<td align="center">Question</td>
							<td align="center">Nilai</td>
						</tr>
						<?php
							$query = mysql_query("SELECT id_question, question FROM main_question");
							while ($row = mysql_fetch_array($query)) {
								$sub_transaksi=mysql_query("SELECT nilai FROM input_addquestion_detail WHERE id_transaksi='".$resultfaktur."' AND id_question='".$row['id_question']."' LIMIT 1");
								$row_sub_transaksi = mysql_fetch_array($sub_transaksi);
						?>
							<tr>
								<td >
									<tr>
										<td >
											<div data-role="fieldcontain">
												<label for="fno"><?= $row['question'] ?></label>
												<input type="hidden" name="question[]" id="question" class="question" value="<?= $row['id_question'] ?>" />
											</div>
										</td>
										<td >
											<select name="nilai[]" id="nilai" class="nilai">
												<option>0</option>
												<option value="1" <?= $row_sub_transaksi['nilai'] == 1 ? 'selected' : '' ?>>1</option>
												<option value="2" <?= $row_sub_transaksi['nilai'] == 2 ? 'selected' : '' ?>>2</option>
												<option value="3" <?= $row_sub_transaksi['nilai'] == 3 ? 'selected' : '' ?>>3</option>
												<option value="4" <?= $row_sub_transaksi['nilai'] == 4 ? 'selected' : '' ?>>4</option>
												<option value="5" <?= $row_sub_transaksi['nilai'] == 5 ? 'selected' : '' ?>>5</option>
												<option value="6" <?= $row_sub_transaksi['nilai'] == 6 ? 'selected' : '' ?>>6</option>
												<option value="7" <?= $row_sub_transaksi['nilai'] == 7 ? 'selected' : '' ?>>7</option>
												<option value="8" <?= $row_sub_transaksi['nilai'] == 8 ? 'selected' : '' ?>>8</option>
												<option value="9" <?= $row_sub_transaksi['nilai'] == 9 ? 'selected' : '' ?>>9</option>
												<option value="10" <?= $row_sub_transaksi['nilai'] == 10 ? 'selected' : '' ?>>10</option>
											</select>
										</td>
										
									</tr>
									
								</td>
							</tr>
						<?php } ?>

					</table>
				</div>
			    <div data-role="footer" data-id="foo1" data-position="fixed">
					<fieldset class="ui-grid-a">
						<div class="ui-block-a"><button type="submit" onclick="history.go(-1)" data-theme="b">Save</button></div>
						<div class="ui-block-b"><a href="summary_penjurian.php"  data-role="button" data-theme="b">Back</a></div>
					</fieldset>
			    </div>
			</form>
        </div>
        <script src="js/custom.js" type="text/javascript"></script>
	</body>
</html>
<?php
}
else
{ 
?>
<script language="JavaScript">
document.location="index.php";
</script>
<?php
}
}
?>
?>
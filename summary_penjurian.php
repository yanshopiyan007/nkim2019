<?php
include("config.php");
ob_start();
session_start();
{
    $aaa = $_SESSION['status'];
    $id_juri = $_SESSION['id_juri'];

if(isset($_SESSION['status']))
{
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
	<title>VOTE NKIM 2019</title>  
	<link rel="stylesheet"  href="css/themes/default/jquery.mobile-1.2.0.css" />  
	<link rel="stylesheet" href="docs/_assets/css/jqm-docs.css"/>
	<script src="js/jquery.js"></script>
	<script src="docs/_assets/js/jqm-docs.js"></script>
	<script src="js/jquery.mobile-1.2.0.js"></script>
</head>




<body>


   
    
			<div data-role="header" data-theme="a" data-position="fixed">
				<table border = "0" width = "100%">
				<tr>
			
				<td width = "20%">
				<center>
				<a href="menu.php" data-role="button" data-theme="b">Back</a>
				</center>
				</td>
				<td width = "60%">
					<center>
				<h3>SUMMARY PENJURIAN</h3>	</center>
				</td>
				<td width = "20%">
				<center>
				<a href="menu.php" onclick="location.reload(true)" data-role="button" data-theme="b">Refresh</a>
				</center>
				</td>
				<tr>
				</table>
			</div>	
		
		
		<div data-role="content" data-theme="c">
			<table border="1" width="100%">
			<tr height="60px" >
				<td>
					<center>NAMA DEALER</center>
				</td>
				<?php
					$pertanyaan = mysql_query('SELECT id_question FROM main_question ORDER BY id_question ASC');
					while ($row_pertanyaan = mysql_fetch_array($pertanyaan)) {
				?>
					<td>
						<center><?= $row_pertanyaan['id_question'] ?></center>
					</td>
				<?php } ?>
				<td>
					<center>Summary</center>
				</td>
				<td>
					<center>Action</center>
				</td>
			</tr>
			<?php
				$aaa =  $id_juri;
				$query = mysql_query('SELECT 
					a.id,
					a.id_transaksi,
					c.nama_Dealer,
					a.total,
					a.Keterangan
					FROM input_addquestion a JOIN mstr_nominee b ON a.id_nominee=b.id_nominee
					JOIN mstr_dealer c ON b.id_Dealer=c.id_Dealer WHERE a.id_juri = "'.$id_juri.'" ORDER BY a.id_transaksi ASC');

				while ($row = mysql_fetch_array($query)) {
			?>
				<tr height="60px">
					<td align="center">
						<?= $row['nama_Dealer'] ?>
					</td>
					<?php
						$subquery = mysql_query('SELECT nilai FROM input_addquestion_detail WHERE id_transaksi="'.$row['id_transaksi'].'" ORDER BY id ASC');

						while ($row_sub = mysql_fetch_array($subquery)) {
					?>
						<td align="center">
							<?= $row_sub['nilai'] ?>
						</td>
					<?php } ?>
					<td align="center">
						<?= $row['total'] ?>
					</td>
					<td align="center">
						<a href="edit_penjurian.php?id=<?= $row['id_transaksi'] ?>">Edit</a>
						
					</td>
				</tr>
				<?php } ?>
			</table>
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
<?php
include("config.php");
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
	<title>TSM KODAWARI</title> 
	<link rel="stylesheet"  href="css/themes/default/jquery.mobile-1.2.0.css" />  
	<link rel="stylesheet" href="docs/_assets/css/jqm-docs.css"/>
	<script src="js/jquery.js"></script>
	<script src="docs/_assets/js/jqm-docs.js"></script>
	<script src="js/jquery.mobile-1.2.0.js"></script>
	
</head> 
<body>
	<script>
	//mendeksripsikan variabel yang akan digunakan

		var fbengkel;
		var fmaindealer;
		$(function(){
			
			//jika ada perubahan di kode barang
				$("#fbengkel").change(function(){
					fbengkel=$("#fbengkel").val();
					alert('Transaksi Berhasil');
					//tampilkan status loading dan animasinya
					$("#status").html("loading. . .");
					$("#loading").show();
					
					//lakukan pengiriman data
					$.ajax({
						url:"proses.php",
						data:"op=ambildata&fbengkel="+fbengkel,
						cache:false,
						success:function(msg){
							data=msg.split("|");
							//masukan isi data ke masing - masing field
							$("#fmaindealer").val(data[0]);
							
							//hilangkan status animasi dan loading
							$("#status").html("");
							$("#loading").show();
						}
					});
					
			});
		});
	</script>
	
	
	
	
        <div data-role="page" id="home" data-theme="d">
	    
			<div data-role="header" data-theme="b" data-position="fixed">
				<h1>MENU PENJURIAN</h1>
			</div><!--/header-->
			<?php
				
				//include "../config.php";
				$sql=mysql_query("select u.user_name, j.id_juri, j.nama_juri from users as u, mstr_juri as j
				where u.user_name = j.id_juri
				AND u.user_name = '".$id_juri."'");
				$num = mysql_num_rows($sql);
				$row = mysql_fetch_array($sql);
				
			?>
			<center>
			<div data-role="content" data-theme="">
				
				<table width="100%" border="0" cellpadding="1" cellspacing="0" >
					<tr>
					<h2>SELAMAT DATANG DI PENJURIAN NKIM 2019</h2>
					</tr>
					<tr>
					<h3><?php echo $row['nama_juri']; ?></h3>
					</tr>
				</table>
				
				<table width="100%" border="0" cellpadding="1" cellspacing="0" >
					<tr>
						<a href="input_penjurian.php" style="text-decoration: none;"><button data-theme="b">INPUT PENJURIAN</button></a>
						</tr>
						<tr>
							<a href="summary_penjurian.php" style="text-decoration: none;"><button data-theme="b">SUMMARY PENJURIAN</button></a>
							
						</tr>
						<tr>
							<a href="destroy.php" style="text-decoration: none;"><button data-theme="b">LOG OUT</button></a>
						</tr>
				</table>
				
				<table width="100%" border="0" cellpadding="1" cellspacing="0" >
					
				
				</table>
			</div>
			
			<div data-role="" data-id="foo1" data-position="fixed">
			<h4></h4>
			</div>
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
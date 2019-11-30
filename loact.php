<?php
ob_start();
session_start();
 
?>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>SPAM Captain Order</title> 
	<link rel="shortcut icon" href="images/spam_icon.png">
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mobile-1.0.1.min.js"></script>
</head>
<body>
<?php
         
	  include("config.php");
	  $username    = $_POST['name'];
	  $password    = md5($_POST['passw']);
	  $sql = "select j.id_juri, u.user_password from mstr_juri j, users u 
					where j.id_juri= u.user_name and
					j.id_juri= '$username' 
					and u.user_password = '$password' limit 1";
	  $qry = mysql_query($sql) or
	  die("Query salah : " . mysql_error());
	  $num = mysql_num_rows($qry);
	  $row = mysql_fetch_array($qry);
	  if ($num==0 OR $password!=$row['user_password']) {
	  ?>
	  <script language="JavaScript">
	  document.location="index.php";
	  </script>
	  <?php
	  } else {
	  $_SESSION['login']=1;
	  $_SESSION['status'] ='authorized';
	  $_SESSION['id_juri']=$row['id_juri'];
	
	  header("Location: menu.php");
	  }
	  //ob_en_flush();
	  ?>
</body>
</html>


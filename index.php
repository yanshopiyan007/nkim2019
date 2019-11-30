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
	<title>PENJURIAN</title> 
	<link rel="stylesheet"  href="css/themes/default/jquery.mobile-1.2.0.css" />  
	<link rel="stylesheet" href="docs/_assets/css/jqm-docs.css"/>
	<script src="js/jquery.js"></script>
	<script src="docs/_assets/js/jqm-docs.js"></script>
	<script src="js/jquery.mobile-1.2.0.js"></script>
</head>
<body>   
		<!--/header-->
        <div data-role="page" id="home" data-theme="d">
	    <div data-role="header" data-theme="b" data-position="fixed">
		<h1>Login Member</h1>
		
	    </div><!--/header-->
	        <center>
	        <img src="img/2.jpg" width="350">
		</center>
		<form action="loact.php" method="post" id="faddmember" name="faddmember">
		<ul data-role="content" data-theme="g">
			<li data-role="fieldcontain">
	        	   <center><label for="name">ID Member</label></center>
			    <center><input type="text" name="name" id="name" value=""/></center>
			    </br>
			    <center><label for="passw">Password</label></center>
	        	    <center><input type="password" name="passw" id="passw" value="" /></center>
			</li>	
	        </ul>
		<div class="ui-body">
			
				
				<button type="submit" data-theme="b">Login</button>
			
			
		</div>
		</form>
	 
		<h4></h4>
	    </div>
        </div>
        <script src="js/custom.js" type="text/javascript"></script>
    
</body>
</html>


  <html>
  <head>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>
  <body> <?php 
  include("common_layout.php"); 
  ?>
  	<h1> You have logged out.</h1>
  </body>
  </html>
<?php
		$_SESSION["username"] = NULL;
	
?>

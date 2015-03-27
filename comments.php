<html>
<head>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>
<body>
	<?php include("common_layout.php"); ?>
</body>
</html>

<?php
if (isset($_POST["submitone"])) {
	echo "Thanks for the comment!" . "<br>";
}
?>

Comments: <TEXTAREA Name = "content" ROWS = 10 COLS = 100> </TEXTAREA>
<form action="<?php $_PHP_SELF ?>" method = "POST">
<input type = "submit" name = "submitone" />
  </form> <br>

  
<html>
<head>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>
<body>
	<?php include("common_layout.php"); 
	include "connectfunc.php";
	?>

<h1>Comments </h1>
	 <form action="<?php $_PHP_SELF ?>" method="POST">
        <br>
				Name:
				<br>
				<input type="text" name="cname" value="">
				<br>
				Email:
				<br>
				<input type="text" name="email" value="">
				<br>
				Comment:
				<br>
				<textarea name="comment" id="comment" rows= 5 cols=50 value="" maxlength="500">
				</textarea>
        <br>
				<input type="submit" name="submit" value="Submit">
			</form>

<?php

//get the functions to connect to db

function new_comment($condb) {
	if ($_POST["comment"] && $_POST["cname"] && $_POST["email"]) {
		$comm = $_POST["comment"];
		$email = $_POST["email"];
		$cname = $_POST["cname"];
		
		$comm = mysqli_real_escape_string($condb, $comm);
		
		$query = "INSERT INTO comments (cname, email, comment)
						values ( '" . "$cname". "','" .
							"$email" ."','". 
								"$comm" ."')";
	
		//$querytwo = "SELECT comment FROM comments WHERE comment = '" ."$comm" ."'";

		if ($condb->query($query) === TRUE) {
			//$result = $condb->query($querytwo);
			//$row = $result->fetch_assoc();
			//$comm_attr = $row["Comment"];
			//$comm_attr = mysqli_real_escape_string($condb, $com_attr);
			//$result->free();
			//echo "Your comment is: " ."$comm_attr";
			echo "Your comment has been submitted. Thank you!";
		} else echo "Comment submission unsuccessful";
	} else echo "<p style='width:80%; text-align:center'>"."Please enter a comment!"."</p>";
}

$condb = conn_db();
if (isset($_POST["submit"])) {
	new_comment($condb);
}
dconn_db($condb);
?>
  
</body>
</html>



<!--
Sign In page
-->

<html>
<head>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>
<body>
	<?php include("common_layout.php"); ?>
	<form action = "<?php $_PHP_SELF ?>" method= "POST">
	
	Name: <input type = "text" name = "empl_name" />
	Password: <input type = "text" name = "pass"/>
	<input type="submit" name="submit"/>
	</form>
</body>
</html>

<?php
include "connectfunc.php";

session_start();

function check_mem($condb) {
	if($_POST["empl_name"] && $_POST["pass"]){
		$mname = $_POST["empl_name"];
		$pw = $_POST["pass"];
		
		$mname = mysqli_real_escape_string($condb, $mname);
		$pw = mysqli_real_escape_string($condb, $pw);
		
		$query = "SELECT * FROM trainer WHERE Name =  '". "$mname". "'";
					"AND Empl_ID = '" ."$pw"."'";
		$result = $condb->query($query);
		
		if($result->num_rows > 0) {
			echo "Thank you for logging in, $mname";
		} else {
			echo "Incorrect trainer Name or Password, please try again!";
			echo "$mname";
			echo "$pw";
		}
	} else {
		echo "Please enter both trainer Name and Password!";
	}
}


$condb = conn_db();

if (isset($_POST["submit"])) {
	check_mem($condb);
}
dconn_db($condb);
?>


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
	
	Member Name: <input type = "text" name = "mem_name" />
	Password: <input type = "text" name = "pass"/>
	<input type="submit" name="submit"/>
	</form>
</body>
</html>

<?php
include "connectfunc.php";

session_start();

function check_mem($condb) {
	if($_POST["mem_name"] && $_POST["pass"]){
		$mname = $_POST["mem_name"];
		$pw = $_POST["pass"];
		
		$mname = mysqli_real_escape_string($condb, $mname);
		$pw = mysqli_real_escape_string($condb, $pw);
		
		$query = "SELECT * FROM member WHERE Name =  '". "$mname". "'";
					"AND MemberID = '" ."$pw"."'";
		$result = $condb->query($query);
		
		if($result->num_rows > 0) {
			echo "Thank you for logging in, $mname";
		} else {
			echo "Incorrect Member Name or Password, please try again!";
			echo "$mname";
			echo "$pw";
		}
	} else {
		echo "Please enter both Member Name and Password!";
	}
}


$condb = conn_db();

if (isset($_POST["submit"])) {
	check_mem($condb);
}
dconn_db($condb);
?>


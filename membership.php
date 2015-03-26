<html>
<head>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>
<body>
	<?php include("common_layout.php"); ?>
  <form action="<?php $_PHP_SELF ?>" method="POST">

  Name: <input type = "text" name = "name" /> <br>
  Phone: <input type = "text" name = "phone" /> <br>
  Address: <input type = "text" name = "addr" /> <br>
  <input type="submit" name="submit" />
  </form>
  
</body>
</html>

<?php

//get the functions to connect to db
include "connectfunc.php";

session_start();

function new_member($condb) {
	if ($_POST["name"] && $_POST["phone"] && $_POST["addr"]) {
		$mname = $_POST["name"];
		$phone = $_POST["phone"];
		$addr = $_POST["addr"];
		
		$mname = mysqli_real_escape_string($condb, $mname);
		$phone = mysqli_real_escape_string($condb, $phone);
		$addr = mysqli_real_escape_string($condb, $addr);
		
		$query = "SELECT MemberID FROM member WHERE Name = '" ."$mname" ."'";
		
		$querytwo = "INSERT INTO member (PhoneNo, Address, Name)
						values ( '" . "$phone". "','" . 
								"$addr" ."','". 
								"$mname" ."') ";
	
		if ($condb->query($querytwo) === TRUE) {
			$result = $condb->query($query);
			$row = $result->fetch_assoc();
			$num_mem = $row["MemberID"];
			$num_mem = mysqli_real_escape_string($condb, $num_mem);
			$result->free();
			echo "Thank you for signing up! You will be put on our mailing list. Your MemberID is: " ."$num_mem";
		} else echo "Sign up unsuccessful";
	} else echo "Please fill in all fields!";
}

$condb = conn_db();
if (isset($_POST["submit"])) {
	new_member($condb);
}
dconn_db($condb);
?>


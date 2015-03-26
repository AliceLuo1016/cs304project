<html>
<head>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>
<body>
	<?php include("common_layout.php"); ?>
  <form action="<?php $_PHP_SELF ?>" method="POST">

  Name: <input type="text" name="name" />
  Password: <input type="text" name="pw" />
  Empl_ID to fire: <input type="text" name="fire_ID" />
  <input type="submit" name="submit" />
  </form>
  
</body>
</html>



<?php
//get the functions to connect to db
include "connectfunc.php";
session_start();


function fire_trainer($condb) {
	if ($_POST["name"] && $_POST["pw"] && $_POST["fire_ID"]) {
		
		$tname = $_POST["name"];
		$pw = $_POST["pw"];
		
		$tname = mysqli_real_escape_string($condb, $tname);
		$pw = mysqli_real_escape_string($condb, $pw);
		
		$query = "SELECT * FROM trainer WHERE Name =  '". "$tname". "'";
					"AND Empl_ID = '" ."$pw"."'";
		
		$result = $condb->query($query);
		
		if ($result->num_rows > 0) {
			$fire = $_POST["fire_ID"];
			$fire = mysqli_real_escape_string($condb, $fire);
			
			$querytwo = "DELETE FROM trainer WHERE Empl_ID = '" . "$fire". "'";
			if ($condb->query($querytwo) === TRUE) {
				echo "Successfully fired Employee # '". "$fire". "'";
			} else echo "Could not delete";
			
			
		} else echo "Incorrect verification info, are you sure you're a trainer?";
		
		
	} else echo "Please enter all details";
}

$condb = conn_db();
if (isset($_POST["submit"])) {
	fire_trainer($condb);
}
dconn_db($condb);
?>
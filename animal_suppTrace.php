<html>
<head>
	<title>Animal Supplier Trace</title>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>

	<body>
		<?php include("common_layout.php"); ?>

		<?php
// get the functions to connect to db
include "connectfunc.php";

session_start();

function animalSupplier_query($condb) {
	echo "Get ". $_POST["name"]. "<br />";
	if( $_POST["name"]){
		$suppname = $_POST["name"];
		$query = "SELECT A.aName, A.Species FROM Animal A WHERE A.aSuppID 
		IN (SELECT aSuppID FROM Animal_Supplier WHERE Name LIKE '" . "$suppname". "')";
		$result = $condb->query($query);
		if($result->num_rows > 0) {
		echo "<table>";
		$col = mysqli_fetch_fields($result);
		echo "<tr>";
		foreach ($col as $header) {
			$header = get_object_vars($header);
			if ($header["name"] == "aName") {
				echo "<td>" . "Animal Name". "</td>";
			}else
			echo "<td>" . $header["name"]. "</td>";
		}
		echo "</tr><br>";
		
		while ($tup = $result->fetch_assoc()) {
			echo "<tr><td>". $tup["aName"]. "</td><td>".
				$tup["Species"]. "</td><tr>" ;				
		}	
		echo "</table>";
		exit();
	}
	else {
		echo "Could not find ". $_POST["name"]. "<br />";
		exit();
	}
}	
}

$condb = conn_db();
if(isset($_POST["submit"])) {
	animalSupplier_query($condb);
}
dconn_db($condb);

?>
		
		<h1>Animal Supplier Trace</h1>
	  <form action="<?php $_PHP_SELF ?>" method="POST">

	  Supplier Name: <input type="text" name="name" />
	  <input type="submit" name="submit" />
	  </form>

	</body>
</html>





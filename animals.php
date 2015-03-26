<?php
// get the functions to connect to db 
include "connectfunc.php";

session_start();

function print_animal($condb) {
	$query = "SELECT * FROM animal";
	$result = $condb->query($query);
	
	if ($result->num_rows > 0) {
		echo "<table>";
		$col = mysqli_fetch_fields($result);
		echo "<tr>";
		foreach ($col as $header) {
			$header = get_object_vars($header);
			if ($header["name"] == "hName") {
				echo "<td>" . "Habitat Name". "</td>";
			} else if ($header["name"] == "aName") {
				echo "<td>". "Animal Name". "</td>";
			} else
			echo "<td>" . $header["name"]. "</td>";
		}
		echo "</tr><br>";
		
		while ($tup = $result->fetch_assoc()) {
			echo "<tr><td>". $tup["aName"]. "</td><td>".
				$tup["Species"]. "</td><td>" .
				$tup["Gender"]. "</td><td>" .
				$tup["Weight"]. "</td><td>" .
				$tup["Diet"]. "</td><td>" .
				$tup["Birthday"]. "</td><td>" .
				$tup["hName"]. "</td><td>" .
				$tup["aSuppID"]. "</td><td>" .
				$tup["Cost"]. "</td></tr>";				
		}		
		echo "</table><br>";
	}	
}

function name_query($condb) {
	if( $_POST["name"])
  {
	$aniname = $_POST["name"];
	$aniname = mysqli_real_escape_string($condb, $aniname);
	$query = "SELECT * FROM animal WHERE aName = '" . "$aniname". "'";
	$result = $condb->query($query);
	if($result->num_rows > 0) {
		echo "<table>";
		$col = mysqli_fetch_fields($result);
		echo "<tr>";
		foreach ($col as $header) {
			$header = get_object_vars($header);
			if ($header["name"] == "hName") {
				echo "<td>" . "Habitat Name". "</td>";
			} else if ($header["name"] == "aName") {
				echo "<td>". "Animal Name". "</td>";
			} else
			echo "<td>" . $header["name"]. "</td>";
		}
		echo "</tr><br>";
		
		while ($tup = $result->fetch_assoc()) {
			echo "<tr><td>". $tup["aName"]. "</td><td>".
				$tup["Species"]. "</td><td>" .
				$tup["Gender"]. "</td><td>" .
				$tup["Weight"]. "</td><td>" .
				$tup["Diet"]. "</td><td>" .
				$tup["Birthday"]. "</td><td>" .
				$tup["hName"]. "</td><td>" .
				$tup["aSuppID"]. "</td><td>" .
				$tup["Cost"]. "</td></tr>";				
		}	
		echo "</table>";
		exit();
	} else {
		echo "Could not find ". $_POST["name"]. "<br />";
		exit();
	}
  }
}

$condb = conn_db();
print_animal($condb);
if(isset($_POST["submit"])) {
	name_query($condb);
}
dconn_db($condb);

?>

<html>
<body>
  <form action="<?php $_PHP_SELF ?>" method="POST">

  Animal Name: <input type="text" name="name" />
  <input type="submit" name="submit" />
  </form>
  
</body>
</html>
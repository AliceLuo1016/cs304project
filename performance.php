<?php
// get the functions to connect to db 
include "connectfunc.php";

session_start();

function print_performance($condb) {
	$query = "SELECT * FROM direct_performance";
	$result = $condb->query($query);
	
	if ($result->num_rows > 0) {
		echo "<table>";
		$col = mysqli_fetch_fields($result);
		echo "<tr>";
		foreach ($col as $header) {
			$header = get_object_vars($header);
			if ($header["name"] == "hName") {
				echo "<td>" . "Habitat Name". "</td>";
			} else if ($header["name"] == "pName") {
				echo "<td>". "Performance Name". "</td>";
			} else if ($header["name"] == "aName") {
				echo "<td>". "Animal Name". "</td>";
			}else if ($header["name"] == "EmpID") {
			} else 
			echo "<td>" . $header["name"]. "</td>";
		}
		echo "</tr><br>";
		
		while ($tup = $result->fetch_assoc()) {
			echo "<tr><td>". $tup["Start_Time"]. "</td><td>".
				$tup["End_Time"]. "</td><td>" .
				$tup["Date"]. "</td><td>" .
				$tup["pName"]. "</td><td>" .
				$tup["hName"]. "</td><td>" .
				$tup["aName"]. "</td><td>" .
				$tup["Species"]. "</td></tr>";				
		}		
		echo "</table><br>";
	}
}

function find_trainer_from_name($condb) {
	if ($_POST["pname"]) {
	    $aniname = $_POST["pname"];
	    $aniname = mysqli_real_escape_string($condb, $aniname);
	   
	    $query = "SELECT Name FROM trainer t, direct_performance d 
				WHERE t.Empl_ID = d.EmpID
				AND d.pName = '" . "$aniname" . "'";
				
		$result = $condb->query($query);
		if($result->num_rows > 0) {
			while ($tup = $result->fetch_assoc()) {
			  echo $tup["Name"] . "<br>";
			}
		} else echo "No results, sorry" . "<br>";
	}else echo "Please enter a performance name!" . "<br>";
}

$condb = conn_db();
print_performance($condb);
if(isset($_POST["submitone"])) {
	find_trainer_from_name($condb);
}
dconn_db($condb);

?>

Find out who directs these performances!
  <form action="<?php $_PHP_SELF ?>" method = "POST">
  Enter a performance name: <input type = "text" name = "pname">
  <input type = "submit" name = "submitone" />
  </form>
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
		echo "</tr>";
		
		while ($tup = $result->fetch_assoc()) {
			echo "<tr><td>". $tup["Start_Time"]. "</td><td>".
				$tup["End_Time"]. "</td><td>" .
				$tup["Date"]. "</td><td>" .
				$tup["pName"]. "</td><td>" .
				$tup["hName"]. "</td><td>" .
				$tup["aName"]. "</td><td>" .
				$tup["Species"]. "</td></tr>";				
		}		
		echo "</table>";
	}
}

$condb = conn_db();
print_performance($condb);
dconn_db($condb);

?>
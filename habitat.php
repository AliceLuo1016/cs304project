<?php
// get the functions to connect to db 
include "connectfunc.php";

session_start();

function print_habitats($condb) {
	$query = "SELECT * FROM habitat";
	$result = $condb->query($query);
	
	if ($result->num_rows > 0) {
		echo "<table>";
		$col = mysqli_fetch_fields($result);
		echo "<tr>";
		foreach ($col as $header) {
			$header = get_object_vars($header);
			if ($header["name"] == "hName") {
				echo "<td>" . "Habitat Name" . "</td>";
			} else
			echo "<td>" . $header["name"]. "</td>";
		}
		echo "</tr><br>";
		
		while ($tup = $result->fetch_assoc()) {
			echo "<tr><td>". 
				$tup["hName"]. "</td><td>".
				$tup["Climate"]. "</td><td>" .
				$tup["Size"]. "</td><td>" .
				$tup["Type"]. 
				 "</td></tr>";				
		}		
		echo "</table><br>";
	}
}

$condb = conn_db();
print_habitats($condb);
dconn_db($condb);

?>
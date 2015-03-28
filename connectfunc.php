
<?php 
$result = NULL;

// establish connection
function conn_db() {
  $condb = @new mysqli("localhost","root", "", "zoo");
  if ($condb->connect_error) {
    echo "Error: Could not connect to database". "<br />";
	return null;
  }
  echo "<p style='width:80%; text-align:center'>"."Successfully connected to database!"."</p>";
  echo "<br>";
  return $condb;
}

// disconnect from connection
function dconn_db($condb) {
	if ($condb == null) {
		return;
	}
	$condb->close();
}

function get_table($condb) {
	$query = "SELECT * FROM animal";
	$result = $condb->query($query);
	
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "aName: ". $row["aName"]. "<br>";
		}
	} else {
		echo "0 results lah";
	}
}

?>

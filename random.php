
<?php 
session_start();

$result = NULL;

function conn_db() {
  $con = @new mysqli("127.0.0.1", "root", "heuvenmysql", "zoo", "3306");
  if ($con->connect_error) {
    echo "NO CONNECT LAH". "<br />";
	return null;
  }
  echo "CONNECT LAH SO GOOD LAH". "<br />";
  return $con;
}

function dconn_db($con) {
	if ($con == null) {
		return;
	}
	$con->close();
}

function get_table($con) {
	$query = "SELECT * FROM animal";
	$result = $con->query($query);
	
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "aName: ". $row["aName"]. "<br>";
		}
	} else {
		echo "0 results lah";
	}
}

$con = conn_db();
get_table($con);
dconn_db($con);

?>

<html>
<head>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>
<body>
	<?php include("common_layout.php"); ?>
</body>
</html>
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

<?php
// get the functions to connect to db 
include "connectfunc.php";

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

function find_animal_from_habitat($condb) {
	if ($_POST["hname"]) {
	    $habname = $_POST["hname"];
	    $habname = mysqli_real_escape_string($condb, $habname);
	   
	    $query = "SELECT aName FROM animal a, habitat h WHERE 
				a.hName = h.hName AND h.hName = '". "$habname". "'";
				
		$result = $condb->query($query);
		if($result->num_rows > 0) {
			while ($tup = $result->fetch_assoc()) {
			  echo $tup["aName"] . "<br>";
			}
			$result->free();
		} else echo "No results, sorry" . "<br>";
	}else echo "Please enter a habitat name!" . "<br>";
}

$condb = conn_db();
?>
<h1> Habitat Table </h1>
<?php
print_habitats($condb);
if (isset($_POST["submitone"])) {
	find_animal_from_habitat($condb);
}
dconn_db($condb);

?>

Find out which animals live in the habitats!
  <form action="<?php $_PHP_SELF ?>" method = "POST">
  Enter a habitat name: <input type = "text" name = "hname">
  <input type = "submit" name = "submitone" />
  </form> <br>
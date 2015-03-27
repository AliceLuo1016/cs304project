<html>
<head>
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
			$result->free();
		} else echo "No results, sorry" . "<br>";
	}else echo "Please enter a performance name!" . "<br>";
}

function find_showtime_from_name($condb) {
	if ($_POST["ppname"]) {
	    $aniname = $_POST["ppname"];
	    $aniname = mysqli_real_escape_string($condb, $aniname);
	   
	    $query = "SELECT Start_Time, End_Time FROM direct_performance
				WHERE pName = '" . "$aniname" . "'";
				
		$result = $condb->query($query);
		if($result->num_rows > 0) {
			while ($tup = $result->fetch_assoc()) {
			  echo "Starts at: ". $tup["Start_Time"] . "<br>";
			  echo "Ends at: " . $tup["End_Time"]. "<br>";
			}
			$result->free();
		} else echo "No results, sorry" . "<br>";
	}else echo "Please enter a performance name!" . "<br>";
}

$condb = conn_db();
?>

<h1> Performance Table </h1>

<?php
print_performance($condb);
?>

Find out who directs these performances!
  <form action="<?php $_PHP_SELF ?>" method = "POST">
  Enter a performance name: <input type = "text" name = "pname">
  <input type = "submit" name = "submitone" />
  </form> 
<?php
  if(isset($_POST["submitone"])) {
	find_trainer_from_name($condb);
}
?>
<br>
  
Find the start and end times of a performance!
  <form action="<?php $_PHP_SELF ?>" method = "POST">
  Enter a performance name: <input type = "text" name = "ppname">
  <input type = "submit" name = "submittwo" />
  </form>

<?php
  if(isset($_POST["submittwo"])) {
	find_showtime_from_name($condb);
}

dconn_db($condb);
?>

</body>
</html>





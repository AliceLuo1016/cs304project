<html>
<head>
	<title>Update Database</title>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>

<body>
	<?php include("common_layout.php"); ?>
	<?php
	include "connectfunc.php";
	session_start();
	$condb = conn_db();

	$animalToAdd = array();
	$IsValid = true;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		global $animalToAdd, $IsValid, $condb;
		//need to do validity check here
		handleAddanimal();
		if ($IsValid)
			addanimal($condb, $animalToAdd);
	}

	?>

<h1>Animal Database Management</h1><br>

<?php
	
	function addanimal($condb, $animal) {
		$statement = $condb->prepare("UPDATE Animal SET Weight=?, Cost=? WHERE aName=? AND Species=?");
		$statement->bind_param("iiss",$animal["Weight"],$animal["Cost"],$animal["aName"], $animal["Species"]);

			$result = $statement->execute();	
			if ($result)
				echo "Animal information updates successfully". "<br />";
			else {
				echo "Unknown error encountered while updating animal" . "<br />";
			}
	}
	
	function printAnimals($condb) {
		$query = "SELECT * FROM Animal";
		$result = $condb->query($query);

		echo "<table style='width:60%; text-align:left;'>";
		echo "<tr>";
		echo "<th>Animal Name</th>";
		echo "<th>Species</th>";
		echo "<th>Gender</th>";
		echo "<th>Weight</th>";
		echo "<th>Diet</th>";
		echo "<th>Birthday</th>";
		echo "<th>Habitat Name</th>";
		echo "<th>Supplier ID</th>";
		echo "<th>Cost</th>";
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["aName"] . "</td>";
			echo "<td>" . $row["Species"] . "</td>";
			echo "<td>" . $row["Gender"] . "</td>";
			echo "<td>" . $row["Weight"] . "</td>";
			echo "<td>" . $row["Diet"] . "</td>";
			echo "<td>" . $row["Birthday"] . "</td>";
			echo "<td>" . $row["hName"] . "</td>";
			echo "<td>" . $row["aSuppID"] . "</td>";
			echo "<td>" . $row["Cost"] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}	

		function handleAddanimal() {
		GLOBAL $animalToAdd, $IsValid;
		
		if (isset($_POST["aName"]) && $_POST["aName"] != "")
			$animalToAdd["aName"] = $_POST["aName"];
		else {
			$IsValid = false;
			echo "<br>" ."Animal name cannot be empty";
		}
		if (isset($_POST["Species"]) && $_POST["Species"] != "") 
			$animalToAdd["Species"] = $_POST["Species"];
		else {
			$IsValid = false;
			echo "<br>" ."Species cannot be empty";
		}
		//CODED CHECK CONSTRAINT HERE, also in animal table in zoo.sql
		if (isset($_POST["Weight"]) && $_POST["Weight"] != "" &&($_POST["Weight"] > 0)) 
			$animalToAdd["Weight"] = $_POST["Weight"];
		else {
			$IsValid = false;
			echo "<br>" . "Weight cannot be empty, and must be greater than 0";
		}
		if (isset($_POST["Cost"]) && $_POST["Cost"] != "") 
			$animalToAdd["Cost"] = $_POST["Cost"];
		else {
			$IsValid = false;
			echo "<br>" ."Cost cannot be empty";
		}
	}
		printAnimals($condb);
		dconn_db($condb);

?>

<br>
<h3>Update Animal</h3>
<!-- Add animal Form -->
<form action="update.php" method="POST">
		<table>
			<tr><td align="right" style="padding-right: 5px;">Animal Name</td><td align="left"><input type="text" name="aName" value="<?php echo ((isset($animalToAdd["aName"]) && ($IsValid == false)) ? $animalToAdd["aName"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Species</td><td align="left"><input type="text" name="Species" value="<?php echo ((isset($animalToAdd["Species"]) && ($IsValid == false)) ? $animalToAdd["Species"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Weight</td><td align="left"><input type="text" name="Weight" value="<?php echo ((isset($animalToAdd["Weight"]) && ($IsValid == false)) ? $animalToAdd["Weight"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Cost</td><td align="left"><input type="text" name="Cost" value="<?php echo ((isset($animalToAdd["Cost"]) && ($IsValid == false)) ? $animalToAdd["Cost"] : "") ?>"></td></tr>
			<tr><td></td><td><input type="submit" value="Update"></td></tr>
			</table>
		</form>

</body>
</html>


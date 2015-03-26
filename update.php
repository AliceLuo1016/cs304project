<?php
	include "connectfunc.php";
	session_start();
	$condb = conn_db();

	$animalToAdd = array();
	$formIsValid = true;
	
	// Perform requested operations from HTML form here
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		global $animalToAdd, $formIsValid, $condb;
		handleAddanimal();
		if ($formIsValid)
			addanimal($condb, $animalToAdd);
	}
	
	// Perform all remaining database queries here
	$animals = getanimals($condb);
	
	dconn_db($condb);
?>

<?
	// VIEW
	// ===============
?>
<html>
<head>
	<title>Update Database</title>
</head>

<body>

<div class="heading" >Animal LIST</div>
<!-- animals -->
<?php createanimalList($animals); ?>

<br>
<div class="heading">UPDATE animal</div>
<!-- Add animal Form -->
<?php createAddanimalForm(); ?>

</body>
</html>

<?php
	// MODEL
	// ===============

	function addanimal($condb, $animal) {
		$statement = $condb->prepare("UPDATE Animal SET Weight=?, Cost=? WHERE aName=? AND Species=?");
		$statement->bind_param("iiss",$animal["Weight"],$animal["Cost"],$animal["aName"], $animal["Species"]);

			$result = $statement->execute();	
			if ($result)
				echo "Animal information updates successfully". "<br />";
			else {
				global $formIsValid;
				echo "Unknown error encountered while updating animal" . "<br />";
				$formIsValid = false;
			}
	}
	
	function createAddanimalForm() {
		global $animalToAdd, $formIsValid;
		?>
		<form action="update.php" method="post">
		<table>
			<tr><td align="right" style="padding-right: 5px;">Animal Name</td><td align="left"><input type="text" name="aName" value="<?php echo ((isset($animalToAdd["aName"]) && ($formIsValid == false)) ? $animalToAdd["aName"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Species</td><td align="left"><input type="text" name="Species" value="<?php echo ((isset($animalToAdd["Species"]) && ($formIsValid == false)) ? $animalToAdd["Species"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Weight</td><td align="left"><input type="text" name="Weight" value="<?php echo ((isset($animalToAdd["Weight"]) && ($formIsValid == false)) ? $animalToAdd["Weight"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Cost</td><td align="left"><input type="text" name="Cost" value="<?php echo ((isset($animalToAdd["Cost"]) && ($formIsValid == false)) ? $animalToAdd["Cost"] : "") ?>"></td></tr>
			<tr><td></td><td><input type="submit" value="Update"></td></tr>
			</table>
		</form>
		<?php
	}
	
	function createanimalList($animals) {
		echo "<table style='width:100%; text-align:center;'>";
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
		while ($row = mysqli_fetch_array($animals, MYSQL_ASSOC)) {
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

	function getanimals($condb) {
		// Currently defaults to limit of 25 animals. Need to add pagination, or change LIMIT in the query
		$query = "SELECT * FROM Animal";
		$result = mysqli_query($condb, $query);
		return $result;
	}
	
	function handleAddanimal() {
		GLOBAL $animalToAdd, $formIsValid;
		
		if (isset($_POST["aName"]) && $_POST["aName"] != "")
			$animalToAdd["aName"] = $_POST["aName"];
		else {
			$formIsValid = false;
			addToMessages("Animal name cannot be empty");
		}
		if (isset($_POST["Species"]) && $_POST["Species"] != "") 
			$animalToAdd["Species"] = $_POST["Species"];
		else {
			$formIsValid = false;
			addToMessages("Species cannot be empty");
		}
		if (isset($_POST["Weight"]) && $_POST["Weight"] != "") 
			$animalToAdd["Weight"] = $_POST["Weight"];
		else {
			$formIsValid = false;
			addToMessages("Weight cannot be empty");
		}
		if (isset($_POST["Cost"]) && $_POST["Cost"] != "") 
			$animalToAdd["Cost"] = $_POST["Cost"];
		else {
			$formIsValid = false;
			addToMessages("Cost cannot be empty");
		}
	}

?>
<html>
<head>
	<title>Update or Add Database</title>
	<!-- Importing css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/zoo.css" >
</head>

<body>
	<?php include("common_layout.php"); ?>
	<?php
	include "connectfunc.php";
	$condb = conn_db();

	$animalToAdd = array();
	$IsValid = true;

	?>
	<div class="col-md-4"></div>
  <div class="col-md-8">


<h1>Animal Database Management</h1><br>

<?php
	
	function printAnimals($condb) {
		$query = "SELECT * FROM Animal";
		$result = $condb->query($query);

		echo "<table style='width:100%; text-align:left;'>";
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
	}				printAnimals($condb);

	?>


<br>
<h3>Update or Add Animal</h3>
<p>* : Only weight and cost can be updated. </p>
<!-- Add animal Form -->
<form action="update.php" method="POST">
		<table>
			<tr><td align="right" style="padding-right: 5px;">Animal Name</td><td align="left"><input type="text" name="aName" value="<?php echo ((isset($animalToAdd["aName"]) && ($IsValid == false)) ? $animalToAdd["aName"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Species</td><td align="left"><input type="text" name="Species" value="<?php echo ((isset($animalToAdd["Species"]) && ($IsValid == false)) ? $animalToAdd["Species"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Gender</td><td align="left"><input type="text" name="Gender" value="<?php echo ((isset($animalToAdd["Gender"]) && ($IsValid == false)) ? $animalToAdd["Gender"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Weight</td><td align="left"><input type="text" name="Weight" value="<?php echo ((isset($animalToAdd["Weight"]) && ($IsValid == false)) ? $animalToAdd["Weight"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Diet</td><td align="left"><input type="text" name="Diet" value="<?php echo ((isset($animalToAdd["Diet"]) && ($IsValid == false)) ? $animalToAdd["Diet"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Birthday</td><td align="left"><input type="text" name="Birthday" value="<?php echo ((isset($animalToAdd["Birthday"]) && ($IsValid == false)) ? $animalToAdd["Birthday"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Habitat Name</td><td align="left"><input type="text" name="hName" value="<?php echo ((isset($animalToAdd["hName"]) && ($IsValid == false)) ? $animalToAdd["hName"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Supplier ID</td><td align="left"><input type="text" name="aSuppID" value="<?php echo ((isset($animalToAdd["aSuppID"]) && ($IsValid == false)) ? $animalToAdd["aSuppID"] : "") ?>"></td></tr>
			<tr><td align="right" style="padding-right: 5px;">Cost</td><td align="left"><input type="text" name="Cost" value="<?php echo ((isset($animalToAdd["Cost"]) && ($IsValid == false)) ? $animalToAdd["Cost"] : "") ?>"></td></tr>
			<tr><td></td><td><input type="submit" value="Update"></td></tr>
			</table>
		</form>

<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		GLOBAL $animalToAdd, $IsValid, $condb;
		//need to do validity check here
		check();
		if ($IsValid)
			addanimal($condb, $animalToAdd);
	}


	function addanimal($condb, $animal) {

		$checkexist = ( "SELECT count(*) FROM Animal WHERE aName='" . "$animal[aName]". "'" . "AND Species ='" . "$animal[Species]". "'");
		$isexist = $condb->query($checkexist);
		$row_array=$isexist->fetch_array(MYSQLI_ASSOC);
		if ($row_array['count(*)'] != 0){
			echo "There has the animal.". "<br />";
			$statement = $condb->prepare("UPDATE Animal SET Weight=?, Cost=? WHERE aName=? AND Species=?");
		$statement->bind_param("iiss",$animal["Weight"],$animal["Cost"],$animal["aName"], $animal["Species"]);
			$result = $statement->execute();	
			if ($result)
				echo "Animal information updates successfully". "<br />";
			else {
				echo "Unknown error encountered while updating animal" . "<br />";
			}
		}else{
			echo "There is no such animal in the database. So we will add it to the database". "<br />";
			$insert = $condb->prepare("INSERT INTO Animal (aName, Species, Gender, Weight, Diet, Birthday, hName, aSuppID, Cost) VALUES 
			(?,?,?,?,?,?,?,?,?)");
			$insert->bind_param("sssisssii",$animal["aName"], $animal["Species"], $animal["Gender"], $animal["Weight"], $animal["Diet"],$animal["Birthday"], $animal["hName"],$animal["aSuppID"], $animal["Cost"]);
			$insert->execute();
		}
	}

		function check() {
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
		if (isset($_POST["Cost"]) && $_POST["Cost"] != "" &&($_POST["Cost"] > 0)) 
			$animalToAdd["Cost"] = $_POST["Cost"];
		else {
			$IsValid = false;
			echo "<br>" ."Cost cannot be empty";
		}
		$animalToAdd["Gender"] = $_POST["Gender"];
		$animalToAdd["Diet"] = $_POST["Diet"];
		$animalToAdd["Birthday"] = $_POST["Birthday"];
		$animalToAdd["hName"] = $_POST["hName"];
		$animalToAdd["aSuppID"] = $_POST["aSuppID"];
	}
		dconn_db($condb);

?>

</div>
</body>
</html>


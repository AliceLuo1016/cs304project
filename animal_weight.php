<html>
<head>
<title>Animal Weights</title>
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

function weightMax_query($condb) {
	$query = "SELECT Gender, avg_weight
	FROM (SELECT Gender, avg(Weight) as avg_weight
			FROM animal
			GROUP BY Gender ) as genderavg
	WHERE avg_weight = (SELECT max(avg_weight)
						FROM (SELECT Gender, avg(weight) as avg_weight
								FROM animal
								GROUP BY Gender) as genderavg2);";
	$result = $condb->query($query);
	$row = $result->fetch_array(MYSQL_BOTH);
	echo "The heaviest gender is " . $row[0] . " with an average weight of " . $row[1] . !"<br />";
} 

function weightMin_query($condb) {
	$query = "SELECT Gender, avg_weight
	FROM ( SELECT Gender, avg(Weight) as avg_weight
			FROM animal
			GROUP BY Gender ) as genderavg
	WHERE avg_weight = (SELECT min(avg_weight)
						FROM (SELECT Gender, avg(weight) as avg_weight
								FROM animal
								GROUP BY Gender) as genderavg2);";
	$result = $condb->query($query);
	$row = $result->fetch_array(MYSQL_BOTH);
	echo "The lightest gender is " . $row[0] . " with an average weight of " . $row[1] . !"<br />";
} 
$condb = conn_db();
?>

<h1>Animal BMI Checker </h1>
<form action="<?php $_PHP_SELF ?>" method="POST">
Which gender, on average, weighs...<br><br>
<button name="maximum" type ="submit" value="maximum">THE MOST?</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button name="minimum" type ="submit" value="minimum">THE LEAST?</button>
</form>

<?php
if(isset($_POST["maximum"])) {
	weightMax_query($condb);
} else if (isset($_POST["minimum"])) {
	weightMin_query($condb);
}

dconn_db($condb);

?>


</body>
</html>





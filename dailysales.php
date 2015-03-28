<html>
<head>
<title>Daily Balance Reports</title>
<!-- Importing css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link rel="stylesheet" href="css/zoo.css" >
</head>

<body>
<?php include("common_layout.php"); ?>

<?php
// get the functions to connect to db
include "connectfunc.php";

function foodsales_query($condb) {
	$query = "SELECT SUM(balance), SUM(hotdog_stock)
	FROM food_stand";
	$result = $condb->query($query);
	$row = $result->fetch_array(MYSQL_BOTH);
	echo "Food stands made a total of $" . $row[0] . " today. There are " . $row[1] . " unsold hotdogs remaining. <br />";
} 

function ticketsales_query($condb) {
	$query = "SELECT SUM(price), SUM(quantity)
	FROM ticketpurchase";
	$result = $condb->query($query);
	$row = $result->fetch_array(MYSQL_BOTH);
	echo "The zoo made a total of $" . $row[0] . " from ticket sales today. We sold " . $row[1] . " tickets. <br />";
} 


$condb = conn_db();
?>


<h1>Daily Balance Reports </h1>
<form action="<?php $_PHP_SELF ?>" method="POST">
<button name="food" type ="submit" value="food">Show total food stand balance</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button name="ticket" type ="submit" value="ticket">Show total ticket balance</button>
</form>

<?php
if(isset($_POST["food"])) {
	foodsales_query($condb);
} else if (isset($_POST["ticket"])) {
	ticketsales_query($condb);
}

dconn_db($condb);
?>
</body>

</html>





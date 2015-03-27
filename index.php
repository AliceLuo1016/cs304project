
<?php 
include "connectfunc.php";
session_start();

$tup;
function update_mem_count($condb) {
	$query = "SELECT COUNT(*) FROM member";
	$result = $condb->query($query);
	global $tup;
	
	if($result->num_rows > 0) {
		$rowone = $result->fetch_array(MYSQLI_NUM);
		$tup = $rowone[0];
		$result->free();
	}
	
}

$condb = conn_db();
update_mem_count($condb);
if (isset($_POST["update_count"])) {
    update_mem_count($condb);
}
dconn_db($condb);
?>

<html>

<head>
  <title>PseudoZoo</title>

	<!-- Importing css -->
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/zoo.css" >

</head>

<body>
  <?php include("common_layout.php"); ?>
      <div class="welcomeMsg">
      <div style="width:100%; text-align:center; padding-top:50px; padding-bottom:30px;">
        <h2 style="font-size: 1.4em;"> WELCOME! <br /> <br /> THIS IS OUR ZOO DATABASE. </h2>
      <form>
			Member Count: <input type = "submit" value = "Update" name = "update_count">
			<?php 
			  global $tup;
			  echo $tup;
			?>
			</form><br>
			<img src="lion.jpg" alt="filler"  style="width:550px;height:300px">
	  </div>
  </div>
</body>

</html>

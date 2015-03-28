<html>

<head>
  <title>PseudoZoo</title>

  <!-- Importing css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/zoo.css" >

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>

</head>

<body>

  <?php 
  include("common_layout.php"); 
  ?>

   <?php 
      include "connectfunc.php";
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

      <div style="width:80%; text-align:center; padding-top:50px; padding-bottom:30px;">
        <span style="font-family:Garamond;font-size:48px;font-style:normal;font-weight:bold;color:2E8B57;">Welcome to Our PseudoZoo!</span>
      <form>
      Member Count: <input class="btn" type = "submit" value = "Update" name = "update_count">

      <?php 
        global $tup;
        echo $tup;
      ?>
      </form><br>
      <img src="http://fc01.deviantart.net/fs71/i/2012/113/b/d/deer_png_by_lg_design-d4xe5hn.png" alt="filler"  style="width:550px;height:300px">
    </div>


</body>

</html>





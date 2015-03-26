<html>


<head>
  <title>PseudoZoo</title>

	<!-- Importing css -->
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/zoo.css" >

</head>

<body>

	<!-- top navigation -->
  <nav class="navbar navbar-default navbar-fixed-top" role="banner" style="background: #2E8B57;">
      <div class="container">

        <div class="navbar-header">
          <a href="index.php" class="navbar-brand" style="color: #fff" onMouseOver="this.style.backgroundColor='#3CB371'"
          onMouseOut="this.style.backgroundColor='#2E8B57'"><b>PseudoZoo</b></a>
        </div>

        <nav class="collapse navbar-collapse" role="navigation">
					<ul class="nav navbar-nav pull-right">
          <ul class="nav navbar-nav">
            <li>
              <a href="about.php" style="color: #fff;" onMouseOver="this.style.backgroundColor='#3CB371'"
              onMouseOut="this.style.backgroundColor='#2E8B57'">About</a>
            </li>

						<li>
              <a href="login.php" style="color: #fff;" onMouseOver="this.style.backgroundColor='#3CB371'"
              onMouseOut="this.style.backgroundColor='#2E8B57'">Sign In</a>
            </li>

          </ul>
				</ul>
        </nav>

      </div>
    </nav>

  <br>
  <br>
  <br>
  <br>

  <div class="row">
  <div class="col-xs-12 col-md-8">
      <div class="welcomeMsg">
      <div style="width:100%; text-align:center; padding-top:50px; padding-bottom:30px;">
        <h2 style="font-size: 1.4em;"> WELCOME! <br /> <br /> THIS IS OUR ZOO DATABASE. </h2>
      </div>
  </div>
</div>

  <div class="col-md-4">
  <div class="list-group" style="width:80%">
  <br>
  <label> Display </label>
  <a href="animals.php" class="list-group-item">Animals</a>
  <a href="habitat.php" class="list-group-item">Habitats</a>
  <a href="performance.php" class="list-group-item">Performances</a>
  <br>
  <label> Customer Service </label>
  <a href="membership.php" class="list-group-item">Membership Application</a>
  <a href="comments.php" class="list-group-item">Comments</a>
  <br>
  <label> Query </label>
  <a href="animal_suppTrace.php" class="list-group-item">Supplier Animal Trace</a>
  </div>
  </div>
</div>



</body>

</html>



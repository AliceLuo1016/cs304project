 <?php session_start();?>

<style>
body  {
    font-color:#2E8B57;
    font-family: Arial, Helvetica, sans-serif;
}
</style>

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

    <?php
        echo "Welcome to our zoo: ".$_SESSION["username"]."<br />";
          if (isset($_SESSION["username"]) && $_SESSION["username"] != NULL) {
            echo ('

              <label> Animal Information Center </label>
              <a href="animal_suppTrace.php" class="list-group-item">Supplier Animal Trace</a>
              <a href="update.php" class="list-group-item">Database Update</a>
              <a href="animal_weight.php" class="list-group-item">Animal Weights</a>
              <br>
              <label> Trainer Tools </label>
              <a href ="fire_trainer.php" class="list-group-item"> Fire a Trainer</a>
              <a href ="dailysales.php" class="list-group-item"> Daily Reports</a>
              <br>
              <a href ="logout.php" class="list-group-item"> Log Out</a>
            ');
          }
        ?>
  
  </div>
  </div>
</div>
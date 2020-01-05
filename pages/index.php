<?php 

require('./../bases/base.php');

$cookie_name = 'user_id';
if(!isset($_COOKIE[$cookie_name])) {
	// echo "Cookie named '" . $cookie_name . "' is not set!";
	$go = true;
} else {

	// echo "Cookie '" . $cookie_name . "' is set!<br>";
	// echo "Value is: " . $_COOKIE[$cookie_name];
	$go = false;
}

$all_users = $conn->query('SELECT * FROM users');
$m = 0;
foreach($all_users as $aa){
	$m -= -1;
}
$all_users = $m;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lost Friends</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
  <style>*{font-family: 'Ubuntu';}</style>

</head>
<body>

<div class="jumbotron text-center">
  <h1>Lost Friends</h1>
  <p>What About Being together after tens of years, <?php echo''.$all_users ; ?> friends waiting for you.</p> 
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Find old firends</h3>
      <p>Write anything that you know about your firends in order to find theme.</p>
      <p>e.g. School Name , City , Friend name, Grade, more of what you know about him/her</p>
    </div>
    <div class="col-sm-4">
      <h3>Wait for old friends</h3>
      <p>Cant Find your old friends!! , no problem register to our website so your firends find you</p>
      <p>Let your firends find you register now and wait for theme to search you (they come for you)</p>
    </div>
    <div class="col-sm-4">
      <h3>Who We Are ?</h3>        
      <p><b>Khalid Obaide</b> the one who felt being far from friends for years. </p>
      <p>hope you find your firends , when you don't know anything about theme.</p>
    </div>
  </div>
</div>
<br><br><br><br>
<hr>

<div class="container">
    <h2>Find now:</h2>
    <p>Please Search using the standard and exact name for the schools and cities.</p>
    <div class="">
        <form action="./../pages/search.php" method="post" class="was-validated">
            <div class="form-group">
              <label for="uname">School Name:</label>
              <input type="text" class="form-control" id="uname" placeholder="Enter School" name="school" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
              <label for="pwd">City:</label>
              <input type="text" class="form-control" id="pwd" placeholder="Enter City" name="city" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="pwd">Date:</label>
                <input type="date" class="form-control" id="pwd" placeholder="Enter Date" name="date" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
            <button type="submit" class="btn btn-primary">Find Friends</button>
          </form>
    </div>
  </div>

  <?php 
	if(!$go){
		echo '<br><br><br><hr>';
		echo '<center>Made By <b>Khalid Obaide</b></center>';
		die();
	}

  ?>
  <br><br><br><hr>
  <div class="container">
    <h2>Register & wait:</h2>
    <p>You will add as much school as you want later on, when you register.</p>
    <div class="">
        <form action="../handles/signup.php" method="post" class="was-validated">
            <div class="form-group">
                <label for="uname">Full Name:</label>
                <input type="text" class="form-control" id="uname" placeholder="Enter Name" name="name" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>

            <div class="form-group">
              <label for="email">Email Adress:</label>
              <input type="email" class="form-control" id="uname" placeholder="Enter Email" name="email" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            
            <div class="form-group">
                <label for="pswd">Password:</label>
                <input type="password" class="form-control" id="uname" placeholder="Enter Password" name="password" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
              

              <div class="form-group">
                <label for="pswd">Confirm Password:</label>
                <input type="password" class="form-control" id="uname" placeholder="Enter Password" name="re_password" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
            
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
    </div>
  </div>
  <br><br><br><hr>

  <div class="container">
    <h2>Login :</h2>
    <div class="">
        <form action="../handles/login.php" method="post" class="was-validated">
            <div class="form-group">
                <label for="uname">username:</label>
                <input type="text" class="form-control" id="uname" placeholder="Enter Email" name="email" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
 
            <div class="form-group">
                <label for="pswd">Password:</label>
                <input type="password" class="form-control" id="uname" placeholder="Enter Password" name="password" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
              
           
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
    </div>
  </div>
  <br><br><br><hr>


<p class="text-center">Made By <b>Khalid Obaide</b></p>
</body>
</html>

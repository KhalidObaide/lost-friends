<?php 

include('./../bases/base.php');


if ($conn->connect_error) {
	echo 'We Cant connect to server right now, please try again !! ';
	die();
} 



// Try To Get the arguments
if (isset($_POST['school']) && isset($_POST['city']) && isset($_POST['date'])){
	// Go On
	echo '';
}else{
	echo 'Missing Arguments';
	die();
}

$school = $_POST['school'];
$city = $_POST['city'];
$date = substr($_POST['date'], 0, 4);


if($school == '' || $city == '' || $date == ''){
	echo 'please fill the form correct !';
	die();
}

// The Search Engine Down Here
$all_schools = $conn->query('SELECT * FROM togethers');
$all_users = $conn->query('SELECT * FROM users');
// First Find all Schools with same City, name, date
$by_city = filter('city', $city, $all_schools);
$by_name = filter('name', $school, $all_schools);
$by_date = filter('date', $date, $all_schools);

$result = []; // Array For Rows of database
foreach($by_name as $nn){array_push($result, $nn);}
foreach($by_city as $nn){array_push($result, $nn);}
foreach($by_date as $nn){array_push($result, $nn);}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Back Together</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Back Together</h1>
  <p>What About being together after tens of years.</p>
</div>

<div class="container">
    <h2>Maybe This : </h2>        
    <table class="table table-dark table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>School Name</th>
          <th>City</th>
          <th>Date</th>
          <th>Info</th>
        </tr>
      </thead>
      <tbody>
	<?php
	$printed = [];
	

	$no = False;
	foreach($by_name as $nn){
		foreach($printed as $pr){
			if ($pr == $nn['user']){
				$no = True;
			}else
			{
				$no = False;
			}
		}
	if(!$no){
		$got_user = check('id', $nn['user'], $all_users);
		echo '
		<tr>
		  <td>'.$got_user['name'].'</td>
		  <td>'.$nn['name'].'</td>
		  <td>'.$nn['city'].'</td>
		  <td>'.$nn['date'].'</td>
		  <td><a href="./../pages/user.php?user_id='.$nn['user'].'" class="btn btn-info">Info</a></td>
		</tr>
';
		array_push($printed, $got_user['id']);	
	}}

	foreach($by_city as $nn){
		foreach($printed as $pr){
			if ($pr == $nn['user']){
				$no = True;
			}else
			{
				$no = False;
			}
		}
	if(!$no){
	$got_user = check('id', $nn['user'], $all_users);
	echo '
	<tr>
	  <td>'.$got_user['name'].'</td>
	  <td>'.$nn['name'].'</td>
	  <td>'.$nn['city'].'</td>
	  <td>'.$nn['date'].'</td>
	  <td><a href="./../pages/user.php?user_id='.$nn['user'].'" class="btn btn-info">Info</a></td>
	</tr>
	';	
	array_push($printed, $got_user['id']);	
	}}


?>
     </tbody>
    </table>
</div>

<br><br><hr>
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

<br><br><br><hr>
<p class="text-center">Made By <b>Khalid Obaide</b></p>
</body>
</html>
<style>

*{
    font-family: 'Ubuntu';
}

</style>

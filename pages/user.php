<?php

require('./../bases/base.php');


if(isset($_GET['user_id'])){
	$user_id = $_GET['user_id'];
}else{
	echo 'This Page is not avalible';
	die();
}

$sql = 'SELECT * from users';
$all_users = $conn->query($sql);

$user = check('id', $user_id, $all_users);

if(!$user){
	echo 'User Does not Exists';
	die();
}elseif($user == 'N'){
	echo 'No User Until Now';
	die();
}

$sql = 'SELECT * from contacts';
$all_contacts = $conn->query($sql);

$got = filter('for_id', $user['id'], $all_contacts);
$user_contacts = [];

foreach($got as $g){
	array_push($user_contacts, [$g['web_name'], $g['account']]);	
}


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
<h1><?php echo ''.$user['name'];  ?></h1>
</div>




<!-- The Add Contact Modal -->
<div class="modal fade" id="gotFriend">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Let Him Know:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
            <div class="">
                <form action="./../handles/found.php" method="post" class="was-validated">
                    <div class="form-group">
                      <input type="name" class="form-control" id="uname" placeholder="Enter Name" name="name" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
		    <input type="hidden" name="user_id" value="<?php echo''.$user['id']; ?>"/>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="5" id="comment" placeholder="Message"></textarea>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                      </div> 

                    <button type="submit" class="btn btn-primary">I Am Here</button>
                  </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>



<div class="container">
    <h2>Schools : </h2>        
    <table class="table table-dark table-hover">
      <thead>
        <tr>
          <th>School Name</th>
          <th>City</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Libyan School Damai</td>
          <td>Kuala Lumpur</td>
          <td>2017, 2018, 2019, 2020</td>
        </tr>
        <tr>
          <td>Ehaalaulome</td>
          <td>Herat</td>
          <td>2014, 2015, 2016</td>
        </tr>
        <tr>
          <td>Iendasazan</td>
          <td>Herat</td>
          <td>2012, 2013, 2014</td>
        </tr>
      </tbody>
    </table>
</div>

<br><br><hr>

<div class="container">
    <h2>Contact Info : </h2>          
    <table class="table table-dark table-hover">
      <thead>
        <tr>
          <th>Website Name</th>
          <th>Username</th>
        </tr>
      </thead>
      <tbody>
	
	<?php 
	foreach($user_contacts as $uc){
	
		echo '<tr><td>'.$uc[0].'</td><td>'.$uc[1].'</td></tr>';
	}
	?>

     </tbody>
    </table>
</div>

<br><br><hr>
<div class="container">
    <h2>Thanks : </h2>
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#gotFriend">Let him know</a>
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

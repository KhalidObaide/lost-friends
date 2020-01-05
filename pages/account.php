<?php 

require('./../bases/base.php');

$cookie_name = 'user_id';
if(!isset($_COOKIE[$cookie_name])) {
	// echo "Cookie named '" . $cookie_name . "' is not set!";
	echo 'Please Login !!';
	die();

} else {

	// echo "Cookie '" . $cookie_name . "' is set!<br>";
	// echo "Value is: " . $_COOKIE[$cookie_name];
}

$sql = "SELECT * FROM users";
$all_users = $conn->query($sql);

$self_id = $_COOKIE[$cookie_name];
$all_contacts = filter('for_id', $self_id, $conn->query('SELECT * FROM contacts'));
$all_schools = filter('user', $self_id, $conn->query('SELECT * FROM togethers'));

$user_contacts = [];
foreach($all_contacts as $g){
	array_push($user_contacts, [$g['web_name'], $g['account']]);	
}




$all_founds = $conn->query('SELECT * from messages');
$found = 0;
foreach($all_founds as $ff){
	$found -= -1;
}

$user = check('id', $_COOKIE[$cookie_name], $all_users);
if(!$user){
	echo 'Something is wrong with your login info please try logging again !';
	die();
}elseif ($user == 'N'){
	echo 'How the fuck you logged in bro ??';
	die();
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
<h1><?php echo '' . $user['name'];  ?></h1>
  <p>
	<?php 
		foreach($all_schools as $ac){
			echo ' '.$ac['name']. ', ';
		}
	
	?>
  </p> 
</div>



<!-- The Add School Modal -->
<div class="modal fade" id="addNew">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">New School:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
            <div class="">
                <form action="./../handles/add_school.php" method="post" class="was-validated">
                    <div class="form-group">
                      <input type="text" class="form-control" id="uname" placeholder="Enter School" name="school" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
		    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" id="pwd" placeholder="Enter City" name="city" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
		    </div>

		    <div class="form-group">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter Grade" name="grade" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
		      </div>


                    <div class="form-group">
                        <input type="date" class="form-control" id="pwd" placeholder="Enter Date" name="date" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
		      </div>

                    <button type="submit" class="btn btn-primary">Add Now</button>
                  </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



  <!-- Remove School Modal -->
<div class="modal fade" id="remove">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Remove School:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
	<div class="modal-body">

	<?php 
		foreach($all_schools as $ac){
			echo '<div>
				'.$ac['name'].'
				<a href="../handles/remove_school.php?school_id='.$ac['id'].'" class="btn btn-danger">Delete</a>
				</div><br>';
		
		}
	
?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>


<!-- Found Friend Messages Modal -->
<?php 
foreach($all_founds as $ff){
	echo '
	<div class="modal fade" id="message'.$ff['id'].'">
	    <div class="modal-dialog">
	      <div class="modal-content">

		<div class="modal-header">
		<h4 class="modal-title">'.$ff['from_name'].'</h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		
		<div class="modal-body">

		<div>
		'.
		$ff['body']
		.'
		</div>

		</div>
		<div class="modal-footer">

		<a href="./../handles/remove_message.php?message_id='.$ff['id'].'" class="btn btn-warning">Delete</a>

		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
		
	      </div>
	    </div>
	</div>
	';
}

?>

<!-- Found Friends Modal -->
<div class="modal fade" id="foundFriends">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Found Friends:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
	<div class="modal-body">

	<?php
		foreach($all_founds as $ff){
			echo '<div>' . $ff['from_name'];
			echo '<a href="" data-toggle="modal" data-dismiss="modal" data-target="#message'. $ff['id'] .'" class="btn btn-info" >Info</a>';
			echo '</div><br>';
		}
	
	?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>


<!-- The Add Contact Modal -->
<div class="modal fade" id="addContact">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">New Contact Adress:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
            <div class="">
                <form action="./../handles/add_contact.php" method="post" class="was-validated">
                    <div class="form-group">
                      <input type="text" class="form-control" id="uname" placeholder="Enter Website Name" name="web_name" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter Username" name="account" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                      </div>
                    <button type="submit" class="btn btn-primary">Add Now</button>
                  </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


  <!-- remove contact Modal -->
<div class="modal fade" id="removeContact">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Remove address:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
	<?php 

		foreach($all_contacts as $contact){
			echo '<div>'.$contact['web_name'].'
				<a 
					class="btn btn-danger" 
	href="./../handles/remove_contact.php?web_name='.$contact['web_name'].'">
					Delete
				</a>
			</div><br>';
		}
	?>
	</div>


        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>


<div class="container">
    <h2>Info & Edit:</h2>
    <div class="text-center">
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addNew">Add New School</a>
        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#remove">Remove an School</a>
	<a href="#" class="btn btn-info" data-toggle="modal" data-target="#foundFriends">Found Friends (<?php echo''.$found; ?>)</a>
        <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addContact">Add Contact address</a>
        <a href="#" class="btn btn-warning text-white" data-toggle="modal" data-target="#removeContact">remove Contact address</a>
     	<a href="../handles/logout.php" class="btn btn-danger">Log out</a>
     </div>
    
</div>
<br><br><br><hr>
<div class="container">
    <h2>Schools : </h2>
    <p>you can delete or add new schools form the <code>Info & Edit</code> Section.</p>            
    <table class="table table-dark table-hover">
      <thead>
        <tr>
          <th>School Name</th>
          <th>City</th>
	  <th>Date</th>
	  <th>Grade</th>
        </tr>
      </thead>
      <tbody>

	<?php 
		foreach($all_schools as $sc){
			echo '<tr>
			<td>'.$sc['name'].'</td>
			<td>'.$sc['city'].'</td>
			<td>'.$sc['date'].'</td>
			<td>'.$sc['grade'].'</td>	
			<tr>';
		}

	?>
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


<br><br><br><hr>
<p class="text-center">Made By <b>Khalid Obaide</b></p>
</body>
</html>
<style>

*{
    font-family: 'Ubuntu';
}

</style>

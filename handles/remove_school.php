<?php 

include('./../bases/base.php');

$cookie_name = 'user_id';
if(!isset($_COOKIE[$cookie_name])) {
	// echo "Cookie named '" . $cookie_name . "' is not set!";
	echo 'Please Login !!';
	die();

}

$self_id = $_COOKIE[$cookie_name];

if ($conn->connect_error) {
	echo 'We Cant connect to server right now, please try again !! ';
	die();
} 



// Try To Get the arguments
if (isset($_GET['school_id'])){
	// Go On
	echo '';
}else{
	echo 'Missing Arguments';
	die();
}

$school_id = $_GET['school_id'];

if($school_id == ''){
	echo 'please fill the form correct !';
	die();
}

$all_schools = filter('user', $self_id, $conn->query('SELECT * FROM togethers'));
$find = check('id', $school_id, $all_schools);

if ($find == 'N'){
	echo "You don't have any Schools until now";
	die();
}elseif (!$find){
	echo "Cannot Find " . $school_id . " to Delete. ";
	die();
}

$find = $find['id'];

// After Getting Arguments save the data
$sql = "DELETE FROM togethers WHERE id=".$find."";

if ($conn->query($sql) === TRUE){
	$conn->close();
}else{
	echo 'Problem with Connecting. ';
	die();
}

echo 'Deleted School <br>Redirecting ...';
echo page('../pages/account.php', 0);

?>

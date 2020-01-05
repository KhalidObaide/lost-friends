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
if (isset($_GET['web_name'])){
	// Go On
	echo '';
}else{
	echo 'Missing Arguments';
	die();
}

$web_name = $_GET['web_name'];

if($web_name == ''){
	echo 'please fill the form correct !';
	die();
}

$all_contacts = filter('for_id', $self_id, $conn->query('SELECT * FROM contacts'));
$find = check('web_name', $web_name, $all_contacts);

if ($find == 'N'){
	echo "You don't have any Contact Adress until now";
	die();
}elseif (!$find){
	echo "Cannot Find " . $web_name . " to Delete. ";
	die();
}

$find = $find['id'];

// After Getting Arguments save the data
$sql = "DELETE FROM contacts WHERE id=".$find."";

if ($conn->query($sql) === TRUE){
	$conn->close();
}else{
	echo 'Problem with Connecting. ';
	die();
}

echo 'Added Contact Adress.<br>Redirecting ...';
echo page('../pages/account.php', 0);

?>

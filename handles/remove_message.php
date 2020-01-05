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
if (isset($_GET['message_id'])){
	// Go On
	echo '';
}else{
	echo 'Missing Arguments';
	die();
}

$message_id = $_GET['message_id'];

if($message_id == ''){
	echo 'please fill the form correct !';
	die();
}

$all_messages = filter('to_id', $self_id, $conn->query('SELECT * FROM messages'));
$find = check('id', $message_id, $all_messages);

if ($find == 'N'){
	echo "You don't have any Messages until now";
	die();
}elseif (!$find){
	echo "Cannot Find " . $message_id . " to Delete. ";
	die();
}

$find = $find['id'];

// After Getting Arguments save the data
$sql = "DELETE FROM messages WHERE id=".$find."";

if ($conn->query($sql) === TRUE){
	$conn->close();
}else{
	echo 'Problem with Connecting. ';
	die();
}

echo 'removed message Adress.<br>Redirecting ...';
echo page('../pages/account.php', 0);

?>

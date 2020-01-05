<?php 

include('./../bases/base.php');


if ($conn->connect_error) {
	echo 'We Cant connect to server right now, please try again !! ';
	die();
} 



// Try To Get the arguments
if (isset($_POST['name']) && isset($_POST['message']) && isset($_POST['user_id'])){
	// Go On
	echo '';
}else{
	echo 'Missing Arguments';
	die();
}

$name = $_POST['name'];
$message = $_POST['message'];
$user_id = $_POST['user_id'];

if($name == '' || $message == '' || $user_id == ''){
	echo 'please fill the form correct !';
	die();
}

// After Getting Arguments save the data
$sql = "INSERT INTO messages (from_name, body , to_id) VALUES ('$name', '$message', '$user_id')";


if($conn->query($sql) === TRUE){
	$conn->close();
}else{
	echo 'Something is not right, Please Try Again Later';
	//echo '<br>'.$conn->error;
	$conn->close();
	die();
}



echo 'You Messaged Him.<br>Redirecting ...';
echo page('../pages/index.php', 3000);

?>

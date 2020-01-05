<?php 

include('../bases/base.php');

if ($conn->connect_error) {
	echo 'We Cant connect to server right now, please try again !! ';
	die();
} 



// Try To Get the arguments
if (isset($_POST['email']) && isset($_POST['password'])){
	// Go On
	echo '';
}else{
	echo 'Missing Arguments';
	die();
}

$email = $_POST['email'];
$password = $_POST['password'];

if($email == '' || $password == ''){
	echo 'please fill the form correct !';
	die();
}
$password = md5($password);

// After Getting Arguments check data 
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$check = check('email', $email , $result);

if($check == false){
	echo 'This User Does not Exists. ';
	die();
}elseif ($check == 'N'){
	echo 'We Currently Dont have any users';
	die();
}
$user = $check;

// If We Got the user by email 
if ($password == $user['password']){
	$cookie_name = 'user_id';
	$cookie_value = $user['id'];

	setcookie($cookie_name, $cookie_value, time()+(86400 * 30*30), "/"); // One month
	echo 'You signed in';
	echo page('../pages/account.php', 1000);

}else{
	echo 'Password Wrong, Please Try Again<br>Redirecting ...';
	echo page('../', 2000);
}

?>

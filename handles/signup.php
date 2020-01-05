<?php 

include('./../bases/base.php');


if ($conn->connect_error) {
	echo 'We Cant connect to server right now, please try again !! ';
	die();
} 



// Try To Get the arguments
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['re_password'])){
	// Go On
	echo '';
}else{
	echo 'Missing Arguments';
	die();
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$re_password = $_POST['re_password'];


if($name == '' || $email == '' || $password == '' || $password != $re_password){
	echo 'please fill the form correct !';
	die();
}
$password = md5($password);


// After Getting Arguments save the data
$schools = '';

$sql = "INSERT INTO users (name, email , password, schools) VALUES ('$name', '$email', '$password', '$schools')";

if($conn->query($sql) === TRUE){
	$all_users = $conn->query('SELECT * FROM users');
	$user = check('email', $email, $all_users);
	$self_id = $user['id'];

	$sqll = "INSERT INTO contacts (web_name, account, for_id) VALUES ('Email', '$email', '$self_id')";
	if ($conn->query($sqll) === TRUE){
		$conn->close();
	}else{
		echo 'Problem with Connecting. ';
		die();
	}
}else{
	
	echo 'Something is not right, Please Try Again Later';
	//echo '<br>'.$conn->error;
	$conn->close();
	die();
}



echo 'You Signed Up.<br>Redirecting ...';
echo page('../pages/index.php', 5000);

?>

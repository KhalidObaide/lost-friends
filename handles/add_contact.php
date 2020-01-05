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
if (isset($_POST['web_name']) && isset($_POST['account'])){
	// Go On
	echo '';
}else{
	echo 'Missing Arguments';
	die();
}

$web_name = $_POST['web_name'];
$account = $_POST['account'];


if($web_name == '' || $account == ''){
	echo 'please fill the form correct !';
	die();
}

// After Getting Arguments save the data
$sql = "INSERT INTO contacts (web_name, account, for_id) VALUES ('$web_name', '$account', '$self_id')";
if ($conn->query($sql) === TRUE){
	$conn->close();
}else{
	echo 'Problem with Connecting. ';
	die();
}

echo 'Added Contact Adress.<br>Redirecting ...';
echo page('../pages/account.php', 0);

?>

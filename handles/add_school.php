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
if (isset($_POST['school']) && isset($_POST['city']) && isset($_POST['grade']) && isset($_POST['date'])) {
	// Go On
	
}else{
	echo 'Missing Arguments';
	die();
}

$school = $_POST['school'];
$city = $_POST['city'];
$grade = $_POST['grade'];
$date = substr($_POST['date'], 0, 4);

if($school == '' || $city == '' || $date == ''  || $grade == '' ){
	echo 'please fill the form correct !';
	die();
}

// After Getting Arguments save the data
$sql = "INSERT INTO togethers (name, city, date, grade, user) VALUES ('$school', '$city', '$date', '$grade', '$self_id')";

if ($conn->query($sql) === TRUE){
	$conn->close();
}else{
	echo 'Problem with Connecting. ';
	die();
}

echo 'Added New School.<br>Redirecting ...';
echo page('../pages/account.php', 0);

?>

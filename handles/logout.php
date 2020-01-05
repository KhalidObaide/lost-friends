<?php 

require('./../bases/base.php');


unset($_COOKIE['user_id']);
setcookie('user_id', null, -1, '/'); 

echo 'You Logged out !! <br>Redirecting ...';
echo page('./../pages/index.php', 1000);

?>

<?php 

$db_server = 'localhost';
$db_name = 'lost';
$db_username = 'root';
$db_password = '';

// Create connection
$conn = new mysqli($db_server, $db_username, $db_password, $db_name);

// Helper functions
function check($by, $have,  $data){
	$find = 'N';	
	foreach($data as $row){
		if($row[$by] == $have){
			$got = $row;
			$find = true;
			break;
		}else{
			$find = false;
			}
	}

	if ($find == false){
		return false;
	}else{
		return $got;
	}
}

function filter($by, $have,  $data){
	$list = [];
	foreach($data as $row){
		if($row[$by] == $have){
			array_push($list, $row);
		}
	}
	return $list;
}


function page($page, $time){
	return '<script> setTimeout(function(){window.location.href="'.$page.'"}, '.$time.');</script>';

}



?>

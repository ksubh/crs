<?php

session_start();


$rows=array();


if(isset($_SESSION["userstatus"])) {
	unset($_SESSION["uid"]);
	unset($_SESSION["name"]);
	unset($_SESSION["userstatus"]);
	$rows[]="You are now logged out";
	
}
else{
	$rows[]="You are not logged in";
}


echo json_encode($rows);

?>

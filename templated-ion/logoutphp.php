<?php

session_start();


$rows=array();


if(isset($_SESSION["status"])) {
	unset($_SESSION["uid"]);
	unset($_SESSION["status"]);
	$rows[]="You are now logged out";
	
	//header('Location:newfiletesting.html');
}
else{
	$rows[]="You are not logged in";
}


echo json_encode($rows);

?>

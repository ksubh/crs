<?php

session_start();


$rows=array();

if(isset($_SESSION["status"])) {
	$rows[0]="You are already logged in";
	//header('Location:newfiletesting.html');
}
else{
	$rows[0]="You are not logged in";
}


echo json_encode($rows);

?>
<?php

session_start();


$rows=array();

if(isset($_SESSION["userstatus"])) {
	$rows[0]=$_SESSION["name"]." You are already logged in";
	$rows[1]="ali";
}
else{
	$rows[0]="You are not logged in";
	$rows[1]="nli";
}


echo json_encode($rows);

?>
<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');


$sql = "update admin set insession = 0 , ipaddress = NULL where ipaddress='".$ip."';";


$result = mysqli_query($link,$sql);

$rows = array();
if ($result){
	$rows[]="Removed";
}
else{
	$rows[]="An Error Occured. Please try again";
}



echo json_encode($rows);



?>

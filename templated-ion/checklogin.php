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
 
$sql = "select * from admin where insession = 1 AND ipaddress='".$ip."';";


$result = mysqli_query($link,$sql);
$rows = array();

$rc = 0;
while($r = mysqli_fetch_assoc($result)) {
	$rc+=1;
	if ($rc<=1){
	$rows[]=$r['id'];	
	}
	else{
		$rows[0]="Multiple Admins Logged in";
		$sql3 = "update admin set insession = 0 ,ipaddress= NULL WHERE ipaddress='".$ip."';";
		$result3 = mysqli_query($link,$sql3);
		break;
	
	}
	
}
if ($rc==0){
	$rows[]="No Admin Logged in";
}



echo json_encode($rows);


?>

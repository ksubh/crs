<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$s0= $_POST['uid'];
$s1= $_POST['pass'];  
$s2= $_POST['a1'];     
$s3= $_POST['a2'];
$s4= $_POST['a3'];


$sql = "select * from admin where id=".$s0." AND password = '".$s1."'AND answer1 = '".$s2."'AND answer2='".$s3."' AND answer3='".$s4."';";


$result = mysqli_query($link,$sql);

$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

	$numval =0;
while($r = mysqli_fetch_assoc($result)) {
	$numval+=1;
	
	$sql21 = "select * from admin where id<>".$s0." AND insession=1 AND ipaddress='".$ip."';";
	$result21 = mysqli_query($link,$sql21);
	$numlog21 = 0;
	while($r31 = mysqli_fetch_assoc($result21)) {
		$numlog21+=1;
	}

	$sql2 = "select * from admin where id=".$s0." AND insession=1;";
	$result2 = mysqli_query($link,$sql2);
	$numlog2 = 0;
	while($r3 = mysqli_fetch_assoc($result2)) {
		$numlog2+=1;
	}

	$sql3 = "select * from admin where id=".$s0." AND insession=1 AND ipaddress='".$ip."';";
	$result3 = mysqli_query($link,$sql3);
	$numlog3 = 0;
	while($r5 = mysqli_fetch_assoc($result3)) {
		$numlog3+=1;
	}

	if ($numlog21!=0){
		$rows[0]="You are logged in from another id";
	}

	else if ($numlog2==0 && $numlog3==0){
		$sql1 = "update admin set insession = 1 , ipaddress ='".$ip."'where id=".$s0.";";
		$result1 = mysqli_query($link,$sql1);
		$rows[0]="Login Succesful";
	}
	else if ($numlog2!=0 && $numlog3==0){
		$rows[0]="You are logged in from another location. Please log out and try again";
	}
	else if ($numlog2!=0 && $numlog3!=0){
		$rows[0]="You are aready logged in. No need to fill the details again";
	}


	
	
}

if ($numval==0){
	$rows[0]="Login Failed";
}


echo json_encode($rows);

// $hint = "";


// $sql = "SELECT * FROM  t1 WHERE uid=".$q.";";
// $result = mysqli_query($link,$sql);
// if($result){
// 	$row = mysqli_fetch_array($result);
// 	while($row){
    
//     echo $row[1];
//     echo "\n<br />";
//     $row = mysqli_fetch_array($result);
// }
    
    
// } else{
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }
 
// mysqli_close($link);

?>

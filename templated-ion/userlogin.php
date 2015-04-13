<?php

session_start();


$rows=array();


$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}



$s0= $_POST['search0'];
$s1= $_POST['search1'];


$sql = "select * from user where emailid= '".$s0."';";


$result = mysqli_query($link,$sql);
$r = mysqli_fetch_assoc($result);

if(is_array($r)) {
	$rows[0]="Welcome ".$s1;
	$rows[1]="lip";
	$_SESSION["userstatus"] = "authorized";
	$_SESSION["uid"] = $r['UID'];
	$_SESSION["name"] = $r['name'];
}
else{

	//get a new UID
	$uid=1;
	$sql1 = "select max(UID) as num from user ;";
	$result1 = mysqli_query($link,$sql1);
	$r1 = mysqli_fetch_assoc($result1);
	if ($r1['num']!==null){
		$uid = $r1['num']+1;
	}
	
	$sql2 = "insert into user values( ".$uid." , '".$s0."','".$s1."');";
	$result2 = mysqli_query($link,$sql2);

	$rows[0]="Welcome ".$s1;
	$rows[1]="lia";
	$_SESSION["userstatus"] = "authorized";
	$_SESSION["uid"] = $uid;
	$_SESSION["name"] = $s1;
}

echo json_encode($rows);

?>
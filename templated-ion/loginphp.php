<?php

session_start();


$rows=array();

if(isset($_SESSION["status"])) {
	$rows[]="You are already logged in";
	//header('Location:newfiletesting.html');
}

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}



$s0= $_POST['search0'];
$s1= $_POST['search1'];  
$s2= $_POST['search2'];     
$s3= $_POST['search3'];
$s4= $_POST['search4'];


$sql = "select * from admin where id=".$s0." AND password = '".$s1."'AND answer1 = '".$s2."'AND answer2='".$s3."' AND answer3='".$s4."';";


$result = mysqli_query($link,$sql);
$r = mysqli_fetch_assoc($result);

if(is_array($r)) {
	$rows[]="You are now logged in";
	$_SESSION["status"] = "authorized";
	$_SESSION["uid"] = $row['id'];
	//header("Location:newfiletesting.html");
}
else{
	$rows[]="invalid UID or Password";
}

echo json_encode($rows);

?>
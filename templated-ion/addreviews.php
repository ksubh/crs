<?php

session_start();

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}


$ov= $_POST['ov'];
$work= $_POST['work'];
$inte= $_POST['inte'];
$gr= $_POST['gr'];
$ar= $_POST['ar'];
$rev= $_POST['rev'];
$cid= $_POST['cid'];

 

$uid = $_SESSION["uid"];

$rows=array($ov,$work,$inte,$gr,$ar,$rev,$cid,$uid);
if(isset($_SESSION["userstatus"])) {
	$rows[]=$_SESSION["name"]." You are already logged in";
	$rows[]="ali";
}
else{
	$rows[]="You are not logged in";
	$rows[]="nli";
}

//add ratings
$sql1 = "insert into rating values(".$uid.",".$cid.",".$ar.",".$gr.",".$inte.",".$work.",".$ov.");";
$result1 = mysqli_query($link,$sql1);
$rows[]= $result1;

//add courses done
$sql2 = "insert into coursesdone values(".$uid.",".$cid.");";
$result2 = mysqli_query($link,$sql2);
$rows[]= $result2;

//add reviews
$sql3 = "insert into reviews values(".$uid.",".$cid.",'".$rev."',0,0,0);";
$result3 = mysqli_query($link,$sql3);
$rows[]= $result3;

echo json_encode($rows);


//mysqli_close($link);

?>

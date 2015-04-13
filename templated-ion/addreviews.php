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
	$rows[0]=$_SESSION["uid"]." You are already logged in";
	$rows[1]="ali";
}
else{
	$rows[0]="You are not logged in";
	$rows[1]="nli";
}

//check if added
$sql14 = "select COUNT(*) as ift from rating where UID = ".$uid." AND CID = ".$cid.";";
$result14 = mysqli_query($link,$sql14);
$r14 = mysqli_fetch_assoc($result14);
$rows[]= $r14['ift'];

//add ratings
if ($r14['ift']==0){
$sql1 = "insert into rating values(".$uid.",".$cid.",".$ar.",".$gr.",".$inte.",".$work.",".$ov.");";
$result1 = mysqli_query($link,$sql1);
$rows[]= $result1;
}

//check if in courses done
$sql15 = "select COUNT(*) as ift from coursesdone where UID = ".$uid." AND CID = ".$cid.";";
$result15 = mysqli_query($link,$sql15);
$r15 = mysqli_fetch_assoc($result15);
$rows[]= $r15['ift'];

//add courses done
if ($r15['ift']==0){
$sql2 = "insert into coursesdone values(".$uid.",".$cid.");";
$result2 = mysqli_query($link,$sql2);
$rows[]= $result2;
}

//check if in review
$sql16 = "select COUNT(*) as ift from reviews where UID = ".$uid." AND CID = ".$cid.";";
$result16 = mysqli_query($link,$sql16);
$r16 = mysqli_fetch_assoc($result16);
$rows[]= $r16['ift'];

//add reviews
if ($r16['ift']==0 and $rev!=''){
$sql3 = "insert into reviews values(".$uid.",".$cid.",'".$rev."',0,0,0);";
$result3 = mysqli_query($link,$sql3);
$rows[]= $result3;
}

echo json_encode($rows);


//mysqli_close($link);

?>

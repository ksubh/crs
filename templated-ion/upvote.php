<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

$user= $_POST['user'];
$cid= $_POST['cid'];

$rows = array($user,$cid);
 

//add upvote
$sql1 = "update reviews set likes = likes+1 where CID = ".$cid." AND UID = ".$user." ;";
$result1 = mysqli_query($link,$sql1);
$rows[]= $result1;


echo json_encode($rows);


//mysqli_close($link);

?>

<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

$rows = array();

$uid= $_POST['user'];
$cid= $_POST['cid'];

 

//add upvote
$sql1 = "update reviews set dislikes = dislikes+1 where CID = ".$cid." AND UID=".$uid.";";
$result1 = mysqli_query($link,$sql1);
$rows[]= $result1;


echo json_encode($rows);


//mysqli_close($link);

?>

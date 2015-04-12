<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$s0= $_POST['uid'];
$s1= $_POST['cid'];  



$sql = "delete from reviews WHERE UID = ".$s0 ." AND CID = ".$s1 .";";


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

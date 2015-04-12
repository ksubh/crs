<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

$s0= $_POST['search0'];

$rows = array("oranges");

$sql1 = "update courses set prompt = prompt+1 where CID=".$s0.";";
$result1 = mysqli_query($link,$sql1);



echo json_encode($rows);


?>

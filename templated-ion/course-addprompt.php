<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

$s0= $_POST['search0'];
$s1= $_POST['search1']; 

$rows = array("apples");

$sql1 = "select COUNT(*) as totval from newcourses where shortname='".$s0."' AND instructor='".$s1."';";
$result1 = mysqli_query($link,$sql1);
while($r1 = mysqli_fetch_assoc($result1)) {
	$num = $r1['totval'];
}


if ($num==0){
	$sql2 = "insert into newcourses values( '".$s0."' ,'".$s1."',1);";
	$result2 = mysqli_query($link,$sql2);
}
else{

 
$sql3 = "update newcourses set prompt= prompt+1 where shortname='".$s0."' AND instructor='".$s1."';";
$result3 = mysqli_query($link,$sql3);
}






echo json_encode($rows);


?>

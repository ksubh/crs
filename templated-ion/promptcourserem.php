<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sqlusercount = "SELECT COUNT(*) as count1 FROM user;";
$resultusercount = mysqli_query($link,$sqlusercount);
$rusercount = mysqli_fetch_assoc($resultusercount);
$usercount = $rusercount['count1'];

// $serious = round($usercount/5);
// $medium = round($usercount/10);
// $low = round($usercount/20);


// $serious = 15;
// $medium = 10;
// $low = 5;


 
$sqls = "select COUNT(*) as serious from courses where prompt > 15 ;";
$sqlm = "select COUNT(*) as medium from courses where prompt > 10 AND prompt<=15;";
$sqll = "select COUNT(*) as low from courses where prompt > 5 AND prompt<=10;";

$sql = "select * from courses order by prompt DESC;";

$results = mysqli_query($link,$sqls);
$resultm = mysqli_query($link,$sqlm);
$resultl = mysqli_query($link,$sqll);
$result = mysqli_query($link,$sql);



$rows = array();

$rs = mysqli_fetch_assoc($results);
$rows[] = $rs['serious'];
$rm = mysqli_fetch_assoc($resultm);
$rows[] = $rm['medium'];
$rl = mysqli_fetch_assoc($resultl);
$rows[] = $rl['low'];

while($r = mysqli_fetch_assoc($result)) {
	$rows[]=$r;
}



echo json_encode($rows);


?>

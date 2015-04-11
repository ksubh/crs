<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$s0= $_POST['cid'];


$stack = array("orange");


//$sql = "select * from reviews where CID = ".$s0." order by likes;";

$sql = "select reviews.UID as UID,reviews.CID as CID, reviews.review as review, reviews.likes as likes, reviews.report as report, 
reviews.dislikes as dislikes, userpage.UID as userUID , userpage.name as username
from reviews inner join userpage on reviews.UID = userpage.UID WHERE 
CID = ".$s0." order by reviews.likes;";


$result = mysqli_query($link,$sql);

$rows = array();
while($r = mysqli_fetch_assoc($result)) {
	$sql2 = "select * from rating where CID = ".$s0." AND UID=".$r['UID'].";";
	$result2 = mysqli_query($link,$sql2);
	$r2 = mysqli_fetch_assoc($result2);
	$r['ov']=$r2['ov'];
	$r['ar']=$r2['ar'];
	$r['gr']=$r2['gr'];
	$r['work']=$r2['work'];
	$r['interest']=$r2['interest'];


	$rows[] = $r;
}



echo json_encode($rows);

// $hint = "";


// $sql = "SELECT * FROM  t1 WHERE uid=".$q.";";
// $result = mysqli_query($link,$sql);
// if($result){
// 	$row = mysqli_fetch_array($result);
// 	while($row){
    
//     echo $row[1];
//     echo "\n<br />";
//     $row = mysqli_fetch_array($result);
// }
    
    
// } else{
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }
 
// mysqli_close($link);

?>

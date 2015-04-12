<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

$shortname= $_POST['shortname'];
$instructor= $_POST['instructor'];
$name= $_POST['name'];
$L= $_POST['L'];
$T= $_POST['T'];
$P= $_POST['P'];
$credits= $_POST['credits'];
$L = intval($L);
$T = intval($T);
$P = intval($P);
$credits = intval($credits);
$content= $_POST['content'];
$slot= $_POST['slot'];
 
$rows=array();

$sql = "select courses.name as name, courses.shortname as shortname, courses.L as L, courses.T as T, courses.P as P, courses.credits as credits, 
courses.CID as CID, courses.IID as IID, courses.content as content, courses.slot as slot, instructor.IID as insIID, instructor.name as instructor 
from courses inner join instructor on courses.IID = instructor.IID WHERE 
courses.shortname = '".$shortname ."' AND instructor.name = '".$instructor ."'; ";


$result = mysqli_query($link,$sql);


$num = 0;
while ($r = mysqli_fetch_assoc($result)){
	$num+=1;
}

if ($num>0){
	$rows[]="This course exists";	
}
else{
	$sql1 = "select IID from instructor WHERE name = '".$instructor."';";
	$result1 = mysqli_query($link,$sql1);
	$r1 = mysqli_fetch_assoc($result1);
	$iid = $r1['IID'];
	$cid = 100;
	$sql2 = "insert into courses values('".$name."','".$shortname."',".$iid.",".$cid.",'".$slot."','".$content."',".$L.",".$T.",".$P.",".$credits.");";
	//$test2 = "insert into courses (CID) values(100);";
	$result2 = mysqli_query($link,$sql2);
	$rows[]= "Successfully Added the Course";
	
	
}


echo json_encode($rows);


//mysqli_close($link);

?>

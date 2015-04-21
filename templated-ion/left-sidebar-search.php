<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$s0= $_POST['search0'];
$s1= $_POST['search1'];  
$s2= $_POST['search2'];     
$s3= $_POST['search3'];
$s4= $_POST['search4'];
$s5= $_POST['search5'];
$s6= $_POST['search6'];
$s7= $_POST['search7'];
$s8= $_POST['search8'];

$stack = array("orange");


$sql = "select courses.name as name, courses.shortname as shortname, courses.L as L, courses.T as T, courses.P as P, courses.credits as credits, 
courses.CID as CID, courses.IID as IID, courses.content as content, courses.slot as slot, instructor.IID as insIID, instructor.name as instructor 
from courses inner join instructor on courses.IID = instructor.IID
inner join 
(select CID, avg(ar) as ar,avg(gr) as gr,avg(interest) as interest,avg(work) as work,avg(ov) as ov from rating group by CID)
avgrating
on avgrating.CID = courses.CID
WHERE 
courses.shortname LIKE '%".$s0 ."%".$s1."%' AND courses.name LIKE '%".$s2 ."%' AND instructor.name LIKE '%".$s3 ."%' 
AND courses.credits >=".$s6." AND courses.credits <= ".$s7."
AND courses.slot LIKE '".$s8."%'
ORDER by avgrating.".$s4." ".$s5." ;";


//$sql = "SELECT * FROM courses WHERE shortname LIKE 'CSL%';";
$result = mysqli_query($link,$sql);

$rows = array();
while($r = mysqli_fetch_assoc($result)) {
	//$r['credits']=$r['L'];
	// $sql1 = "select name from instructor where IID=".$r['IID'].";";
	// $result1 = mysqli_query($link,$sql1);
	// $r1 = mysqli_fetch_assoc($result1);
	// $r['instructor']=$r1['name'];

	$sql1 = "select CID, avg(ar) as ar,avg(gr) as gr,avg(interest) as interest,avg(work) as work,avg(ov) as ov from rating where CID=".$r['CID'].";";
	$result1 = mysqli_query($link,$sql1);
	$r1 = mysqli_fetch_assoc($result1);
	$r['ar']=$r1['ar'];
	$r['gr']=$r1['gr'];
	$r['interest']=$r1['interest'];
	$r['work']=$r1['work'];
	$r['ov']=$r1['ov'];

	$sql2 = "SELECT COUNT(*) as revnum FROM reviews where CID=".$r['CID'].";";
	$result2 = mysqli_query($link,$sql2);
	$r2 = mysqli_fetch_assoc($result2);
	$r['revnum']=$r2['revnum'];

	//$r['instructor']="magic";

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

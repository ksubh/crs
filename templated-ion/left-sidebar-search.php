<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$s1= $_POST['search0'];
$s1= $_POST['search1'];  
$s2= $_POST['search2'];     
$s3= $_POST['search3'];

$stack = array("orange");
$str1 = "";

// if !(empty($s0)) {
// 	array_push($stack,"s1 is empty");
// 	$str1 = $str1+ "shortname LIKE '""CSL%'";
//     //echo 's1 is empty';
// }
// if (empty($s1)) {
// 	array_push($stack,"s1 is empty");
// 	$str1 = $str1+ "shortname LIKE 'CSL%'";
//     //echo 's1 is empty';
// }
// if (empty($s2)) {
// 	array_push($stack, "s2 is empty");
// 	$str1 = $str1+ "shortname LIKE 'CSL%'";
//     //echo 's2 is empty';
// }
// if (empty($s3)) {
//     array_push($stack, "s3 is empty");
//     $str1 = $str1+ "shortname LIKE 'CSL%'";
// 	//echo 's3 is empty';
// }  

$sql = "select courses.name as name, courses.shortname as shortname, courses.L as L, courses.T as T, courses.P as P, courses.credits as credits, 
courses.CID as CID, courses.IID as IID, courses.content as content, courses.slot as slot, instructor.IID as insIID, instructor.name as instructor 
from courses inner join instructor on courses.IID = instructor.IID WHERE shortname LIKE 'CSL%';";
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

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



//check if course exists
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

	//check if instructor exists
	$sql1 = "select IID from instructor WHERE name = '".$instructor."';";
	$result1 = mysqli_query($link,$sql1);
	
	$numins = 0;
	while ($r1 = mysqli_fetch_assoc($result1)){
		$iid = $r1['IID'];
		$numins+=1;
	}

	if ($numins==0){
		//if not add him to the table
		$sql5 = "select MAX(IID) as maxval from instructor;";
		$result5 = mysqli_query($link,$sql5);
		$r5 = mysqli_fetch_assoc($result5);
		$iid = $r5['maxval']+1;
		
		$sql7 = "insert into instructor values ('".$instructor."',".$iid.");";
		$result7 = mysqli_query($link,$sql7);

	}


	//add the course

	//new CID
	$sql52 = "select MAX(CID) as maxval from courses;";
	$result52 = mysqli_query($link,$sql52);
	$r52 = mysqli_fetch_assoc($result52);
	$cid = $r52['maxval']+1;

	
	$sql2 = "insert into courses values('".$name."','".$shortname."',".$iid.",".$cid.",'".$slot."','".$content."',".$L.",".$T.",".$P.",".$credits.",0);";
	//$test2 = "insert into courses (CID) values(100);";
	$result2 = mysqli_query($link,$sql2);
	$rows[]= "Successfully Added the Course";

	//remove course from prompt
	$sql3 = "delete from newcourses WHERE shortname = '".$shortname ."' AND instructor = '".$instructor ."';";
	$result3 = mysqli_query($link,$sql3);
	
	
}


echo json_encode($rows);


//mysqli_close($link);

?>

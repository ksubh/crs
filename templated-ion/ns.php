<?php

$link = mysqli_connect("localhost", "root", "nautilus", "crstry");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$q = $_REQUEST["q"];

$hint = "";


// attempt insert query execution
$sql = "SELECT * FROM  courses ";
$result = mysqli_query($link,$sql);
if($result){
	while ($row = mysql_fetch_array($result)) {
		echo $row
	}
    
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);

// $q = $_REQUEST["q"];

// $hint = "Hola";

// echo $hint;
// echo "doit";
?>

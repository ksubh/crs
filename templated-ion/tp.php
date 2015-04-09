<?php
$servername = "localhost";
$username = "root";
$password = "nautilus";
$dbname = "crstry";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$q = $_REQUEST["q"];

$sql = "SELECT uid,cid,ov,ar,gr FROM rating Order by $q DESC ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "CID: " . $row["cid"]. "  UID: " . $row["uid"]. "  Overall: " . $row["ov"]"  Attendance: " . $row["ar"]"  Grouping: " . $row["gr"] "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
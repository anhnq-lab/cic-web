<?php 
$servername = "localhost";
$username = "cic15787_cic_fs";
$password = "@V7w8ja6";
$dbname = "cic15787_cic_fs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO fs_news (title)
VALUES ('Nguyễn Ngọc Duy Anh')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
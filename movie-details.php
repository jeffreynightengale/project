<?php require_once("header.php"); ?>


  <body>
    <h2>Movie Details</h2>
  <?php
  $servername = "localhost";
$username = "";
$password = "";
$dbname = "";
    
      
  $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "Select M.movieID, title, image from Movie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>

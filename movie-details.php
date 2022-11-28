<?php require_once("header.php"); ?>


  <body>
    
  
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

$sql = "Select movieID, title, image, starring, director, duration, summary from Movie where movieID=? ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<h1>Movie details here<h1>

  
   


        
        

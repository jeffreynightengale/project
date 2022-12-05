<?php require_once("header.php"); ?>
  <body class="text-center">
    <h2>Movies Showing</h2>
    
    <div class="row row-cols-1 row-cols-md-3 g-4">
  <?php
$servername = "localhost:3306";
$username = "jeffreyn_user1";
$password = "0w_zeP}]OVy0";
$dbname = "jeffreyn_project";
    
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "Select movieID, Title, Image from Movie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
    <div class="col">
width: 15rem; height: 30rem;
     <div id="card" class="card">
         <img  src=<?=$row["Image"]?> class="card-img-top" style="height: 30vw;" alt="...">
  <div  class="card-body">
    <a class="card-title" href="movie-details.php?id=<?=$row["movieID"]?>"><?=$row["Title"]?></a
  </div>
      </div>
  </div>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>

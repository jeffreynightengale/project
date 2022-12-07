<?php require_once("header-admin.php"); ?>


  <body>
       <?php
$servername = "localhost:3306";
$username = "jeffreyn_user1";
$password = "0w_zeP}]OVy0";
$dbname = "jeffreyn_project";
    
      
  $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
    ?>
    
      <h2>Employee</h2>
    
<table class="table table-striped">
  <thead>
    <tr>
  
            <th> Title</th>
            <th> Starring </th>
            <th> Director </th>
            <th> Duration </th>
            <th> Summary</th>
       <th> Image </th>
            <th> Trailer</th>
    </tr>
  </thead>
  <tbody>
    <?php
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
       case 'Add':
      $sqlAdd = "insert into Movie (Title, Starring, Director, Duration, Summary, Image, Trailer) value (?, ?, ?, ?, ?, ?, ?)";
      $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("sssssss", $_POST['mTitle'], $_POST['mStarring'], $_POST['mDirector'], $_POST['mDuration'], $_POST['mSummary'], $_POST['mImage'], $_POST['mTrailer']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">Movie added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Movie set Title=?, Starring=?, Director=?, Duration=?, Summary=?, Image=?, Trailer=? where movieID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sssssssi", $_POST['mTitle'], $_POST['mStarring'], $_POST['mDirector'], $_POST['mDuration'], $_POST['mSummary'], $_POST['mImage'], $_POST['mTrailer'], $_POST['mid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Movie edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Movie where MovieID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['mid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Movie deleted.</div>';
      break;
  }
}

$sql = "Select movieID, Title, Image, Starring, Director, Duration, Summary from Movie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["Title"]?></td>
    <td><?=$row["Starring"]?></td>
       <td><?=$row["Director"]?></td>
        <td><?=$row["Duration"]?></td>
                <td><?=$row["Summary"]?></td>
                    <td><?=$row["Image"]?></td>
                <td><?=$row["Trailer"]?></td>

 <td>
  </body>
    <?php require_once("footer.php"); ?>

}
    }

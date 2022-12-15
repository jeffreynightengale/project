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

$sql = "Select movieID, Title, Image, Starring, Director, Duration, Summary, Trailer from Movie";
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
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editMovie<?=$row["movieid"]?>">
                Edit
              </button>
              <div class="modal fade" id="editMovie<?=$row["movieid"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMovie<?=$row["movieid"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editMovie<?=$row["movieid"]?>Label">Edit Movie</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editMovie<?=$row["movieid"]?>Name" class="form-label">Title</label>
                          <input type="text" class="form-control" id="editManager<?=$row["movieid"]?>Name" aria-describedby="editMovie<?=$row["movieid"]?>Help" name="mTitle" value="<?=$row['Title']?>">
                          <div id="editMovie<?=$row["movieid"]?>Help" class="form-text">Enter the new title.</div>
                          <div class="mb-3">
                           <label for="editMovie<?=$row["movieid"]?>Name" class="form-label">Starring</label>
                          <input type="text" class="form-control" id="editManager<?=$row["movieid"]?>Name" aria-describedby="editMovie<?=$row["movieid"]?>Help" name="mStarring" value="<?=$row['Starring']?>">
                          <div id="editMovie<?=$row["movieid"]?>Help" class="form-text">Add actors.</div>
                            <input type="hidden" name="mid" value="<?=$row['movieid']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="mid" value="<?=$row["movieid"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
          </tr>

    }
   <?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
   <?php require_once("footer.php"); ?>

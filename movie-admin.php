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
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
 
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
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editMovie<?=$row["movieID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editMovie<?=$row["movieID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMovie<?=$row["movieID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editMovie<?=$row["movieID"]?>Label">Edit Movie</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editMovie<?=$row["movieID"]?>Name" class="form-label">Title</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>Name" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="mTitle" value="<?=$row['Title']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Enter the new title.</div>
                          <div class="mb-3">
                           <label for="editMovie<?=$row["movieID"]?>Starring" class="form-label">Starring</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>Name" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="mStarring" value="<?=$row['Starring']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Add actors.</div>
                             <div class="mb-3">
                          <label for="editMovie<?=$row["movieID"]?>Director" class="form-label">Director</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>Director" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="mDirector" value="<?=$row['Director']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Enter the new director.</div>
                          <div class="mb-3">
                           <label for="editMovie<?=$row["movieID"]?>Duration" class="form-label">Duration</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>Duration" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="mDuration" value="<?=$row['Duration']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Edit duration.</div>
                             <div class="mb-3">
                          <label for="editMovie<?=$row["movieID"]?>Summary" class="form-label">Summary</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>Summary" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="mSummary" value="<?=$row['Summary']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Enter the new summary.</div>
                          <div class="mb-3">
                           <label for="editMovie<?=$row["movieID"]?>Image" class="form-label">Image</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>Image" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="mImage" value="<?=$row['Image']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Add image url.</div>
                            <label for="editMovie<?=$row["movieID"]?>Trailer" class="form-label">Trailer</label>
                          <input type="text" class="form-control" id="editMovie<?=$row["movieID"]?>Name" aria-describedby="editMovie<?=$row["movieID"]?>Help" name="mTrailer" value="<?=$row['Trailer']?>">
                          <div id="editMovie<?=$row["movieID"]?>Help" class="form-text">Add trailer.</div>000
                            <input type="hidden" name="mid" value="<?=$row['movieID']?>">
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
                <input type="hidden" name="mid" value="<?=$row["movieID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
          </tr>
   <?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
     </tbody>
      </table>
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMovie">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addMovie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMovieLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addMovieLabel">Add Movie</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="movieTitle" class="form-label">Movie Title</label>
                  <input type="text" class="form-control" id="movieTitle" aria-describedby="nameHelp" name="mTitle">
                  <div id="nameHelp" class="form-text">Enter the movie's title.</div>
                </div>
                <div class="mb-3">
                  <label for="movieStarring" class="form-label">Movie Starring</label>
                  <input type="text" class="form-control" id="movieStarring" aria-describedby="nameHelp" name="mStarring">
                  <div id="nameHelp" class="form-text">Enter the movie's cast.</div>
                </div>
                <div class="mb-3">
                  <label for="movieDirector" class="form-label">Movie Director</label>
                  <input type="text" class="form-control" id="movieDirector" aria-describedby="nameHelp" name="mDirector">
                  <div id="nameHelp" class="form-text">Enter the movie's director.</div>
                </div>
                <div class="mb-3">
                  <label for="movieDuration" class="form-label">Movie Duration</label>
                  <input type="text" class="form-control" id="movieDuration" aria-describedby="nameHelp" name="mDuration">
                  <div id="nameHelp" class="form-text">Enter the movie's duration (ex. #h #m).</div>
                </div>
                <div class="mb-3">
                  <label for="movieSummary" class="form-label">Movie Summary</label>
                  <input type="text" class="form-control" id="movieSummary" aria-describedby="nameHelp" name="mSummary">
                  <div id="nameHelp" class="form-text">Enter the movie's summary.</div>
                </div>
                <div class="mb-3">
                  <label for="movieImage" class="form-label">Movie Image</label>
                  <input type="text" class="form-control" id="movieImage" aria-describedby="nameHelp" name="mImage">
                  <div id="nameHelp" class="form-text">Enter the movie's picture.</div>
                </div>
                <div class="mb-3">
                  <label for="movieTrailer" class="form-label">Movie Trailer</label>
                  <input type="text" class="form-control" id="movieTrailer" aria-describedby="nameHelp" name="mTrailer">
                  <div id="nameHelp" class="form-text">Enter the movie's trailer.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
   <?php require_once("footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>

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
      $sqlAdd = "insert into Ticket (Showtime, movieID, Seat, memberID, foodID) value (?, ?, ?, ?, ?)";
      $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("sisii", $_POST['tShowtime'], $_POST['tMovieid'], $_POST['tSeat'], $_POST['tMemberid'], $_POST['tFoodid']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">Ticket now in system.</div>';
      break;
         case 'Edit':
      $sqlEdit = "update Ticket set Showtime=?, movieID=?, Seat=?, memberID=?, foodID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
    $stmtAdd->bind_param("sisii", $_POST['tShowtime'], $_POST['tMovieid'], $_POST['tSeat'], $_POST['tMemberid'], $_POST['tFoodid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Ticket edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Ticket where ticketID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['tid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Ticket deleted.</div>';
      break;
  }
     }
    ?>
    
      <h2>Employee</h2>  
    </tbody>
      </table>
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTicket">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addTicket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTicketLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addTicketLabel">Add Ticket</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="ticketShowtime" class="form-label">Showtime</label>
                  <input type="text" class="form-control" id="ticketShowtime" aria-describedby="nameHelp" name="tShowtime">
                  <div id="nameHelp" class="form-text">Enter the showtime.</div>
                </div>
                  <div class="mb-3">
                            <label for="MovieList" class="form-label">Movie</label>
                            <select class="form-select" aria-label="Select Movie" id="movieList" name="tMovieid" >
                          <?php
                              $ticketaddSql = "select Title, movieID from Movie order by Title";
                              $ticketaddResult = $conn->query($ticketaddSql);
                              while($ticketaddRow = $ticketaddResult->fetch_assoc()) {
                         ?>
                               <option value="<?=$ticketaddRow['movieID']?>"><?=$ticketaddRow['Title']?></option>
                         <?php
                              }
                         ?>
                           </select>
                       </div>
             
                <div class="mb-3">
                <label for="ticketSeat" class="form-label">Seat</label>
                  <input type="text" class="form-control" id="ticketSeat" aria-describedby="nameHelp" name="tSeat">
                  <div id="nameHelp" class="form-text">Enter the seat.</div>
                </div>
                <div class="mb-3">
                            <label for="MemberList" class="form-label">Member</label>
                            <select class="form-select" aria-label="Select Member" id="memberList" name="tMemberid" >
                          <?php
                              $ticketaddSql = "select Name, memberID from Reward order by Name";
                              $ticketaddResult = $conn->query($ticketaddSql);
                              while($ticketaddRow = $ticketaddResult->fetch_assoc()) {
                         ?>
                               <option value="<?=$ticketaddRow['memberID']?>"><?=$ticketaddRow['Name']?></option>
                         <?php
                              }
                         ?>
                           </select>
                       </div>
                 <div class="mb-3">
                            <label for="FoodList" class="form-label">Snack</label>
                            <select class="form-select" aria-label="Select Snack" id="foodList" name="fid" >
                          <?php
                              $snackaddSql = "select Food_name, foodID from Menu order by Food_name";
                              $snackaddResult = $conn->query($snackaddSql);
                              while($snackaddRow = $snackaddResult->fetch_assoc()) {
                         ?>
                               <option value="<?=$snackaddRow['foodID']?>"><?=$snackaddRow['Food_name']?></option>
                         <?php
                              }
                         ?>
                           </select>
                       </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Showtime</th>
            <th>Seat</th>
            <th>Member ID</th>
      <th>Movie</th>
    </tr>
  </thead>
  <tbody>
    <?php
 
$sql = "Select * from Ticket T Join Movie M on M.movieID=T.movieID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["Showtime"]?></td>
    <td><?=$row["Seat"]?></td>
       <td><?=$row["memberID"]?></td>
    <td><?=$row["Title"]?></td>
    
    
    
    
        <td>
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editTicket<?=$row["ticketID"]?>">
                    Edit
                  </button>
                  <div class="modal fade" id="editTicket<?=$row["ticketID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTicket<?=$row["ticketID"]?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editTicket<?=$row["ticketID"]?>Label">Edit Ticket</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="">
                            <div class="mb-3">
                              <label for="editTicket<?=$row["ticketID"]?>Showtime" class="form-label">Showtime</label>
                              <input type="text" class="form-control" id="editTicket<?=$row["ticketID"]?>Showtime" aria-describedby="editTicket<?=$row["ticketID"]?>Help" name="tShowtime" value="<?=$row['Showtime']?>">
                              <div id="editTicket<?=$row["ticketID"]?>Help" class="form-text">Enter the movie's showtime.</div>
                            </div>
                           <div class="mb-3">
                              <label for="editSeat<?=$row["ticketID"]?>Seat" class="form-label">Seat</label>
                              <input type="text" class="form-control" id="editTicket<?=$row["ticketID"]?>Seat" aria-describedby="editTicket<?=$row["ticketID"]?>Help" name="tSeat" value="<?=$row['Seat']?>">
                              <div id="editTicket<?=$row["ticketID"]?>Help" class="form-text">Enter the ticket's seat.</div>
                            </div>


 <div class="mb-3">
                            <label for="MovieList" class="form-label">Movie</label>
                            <select class="form-select" aria-label="Select Movie" id="movieList" name="tMovieid" value="<?=$row['movieID']?>">
                          <?php
                              $ticketeditSql = "select Title, movieID from Movie order by Title";
                              $ticketeditResult = $conn->query($ticketeditSql);
                              while($ticketeditRow = $ticketeditResult->fetch_assoc()) {
                                 if ($eventRow['movieID'] == $row['movieID']) {
                                  $selText = " selected";
                                } else {
                                  $selText = "";
                                }
                                
                         ?>
                               <option value="<?=$ticketeditRow['movieID']?>"><?=$ticketeditRow['Title']?></option>
                         <?php
                              }
                         ?>
                           </select>
                       </div>
<div class="mb-3">
                            <label for="MemberList" class="form-label">Member</label>
                            <select class="form-select" aria-label="Select Member" id="memberList" name="tMemberid" value="<?=$row['memberID']?>">
                          <?php
                              $tickeditSql = "select Name, memberID from Reward order by Name";
                              $tickeditResult = $conn->query($tickeditSql);
                              while($tickeditRow = $tickeditResult->fetch_assoc()) {
                                 if ($eventRow['memberID'] == $row['memberID']) {
                                  $selText = " selected";
                                } else {
                                  $selText = "";
                                }
                                
                         ?>
                               <option value="<?=$tickeditRow['memberID']?>"><?=$tickeditRow['Name']?></option>
                         <?php
                              }
                         ?>
                           </select>
                       </div>
<div class="mb-3">
                            <label for="FoodList" class="form-label">Snack</label>
                            <select class="form-select" aria-label="Select Snack" id="foodList" name="tFoodid" value="<?=$row['foodID']?>">
                          <?php
                              $snackeditSql = "select Food_name, foodID from Menu order by Food_name";
                              $snackeditResult = $conn->query($snackeditSql);
                              while($snackeditRow = $snackeditResult->fetch_assoc()) {
                                 if ($eventRow['foodID'] == $row['foodID']) {
                                  $selText = " selected";
                                } else {
                                  $selText = "";
                                }
                                
                         ?>
                               <option value="<?=$snackeditRow['foodID']?>"><?=$snackeditRow['Food_name']?></option>
                         <?php
                              }
                         ?>
                           </select>
                       </div>

                 

                            <input type="hidden" name="tid" value="<?=$row['ticketID']?>">
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
                <input type="hidden" name="tid" value="<?=$row["ticketID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
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

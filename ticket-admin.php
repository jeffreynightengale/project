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
    $stmtAdd->bind_param("ss", $_POST['tShowtime'], $_POST['tMovieid'], $_POST['tSeat'], $_POST['tMemberid'], $_POST['tFoodid']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">Ticket now in system.</div>';
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
                  <label for="movieID" class="form-label">Movie ID</label>
                  <input type="text" class="form-control" id="movieID" aria-describedby="nameHelp" name="tMovieid">
                  <div id="nameHelp" class="form-text">Enter the movie ID.</div>
                </div>
                <label for="ticketSeat" class="form-label">Seat</label>
                  <input type="text" class="form-control" id="ticketSeat" aria-describedby="nameHelp" name="tSeat">
                  <div id="nameHelp" class="form-text">Enter the seat.</div>
                </div>
                <div class="mb-3">
                  <label for="memberID" class="form-label">Member ID</label>
                  <input type="text" class="form-control" id="memberID" aria-describedby="nameHelp" name="tMemberid">
                  <div id="nameHelp" class="form-text">Enter the member ID.</div>
                </div>
              <label for="foodID" class="form-label">Food ID</label>
                  <input type="text" class="form-control" id="foodID" aria-describedby="nameHelp" name="tFoodid">
                  <div id="nameHelp" class="form-text">Enter the food ID.</div>
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
      <th>Movie ID</th>
    </tr>
  </thead>
  <tbody>
    <?php
 
$sql = "Select * from Ticket";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["Showtime"]?></td>
    <td><?=$row["Seat"]?></td>
       <td><?=$row["memberID"]?></td>
    <td><?=$row["movieID"]?></td>
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

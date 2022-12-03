<?php require_once("header.php"); ?>


  <body>
      
<table class="table table-striped">
  <thead>
   
    <tr>
            <th> Title</th>
            <th> Starring </th>
            <th> Director </th>
                  <th> Duration </th>

                  <th> Summary</th>
    
    </tr>
  </thead>
  
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
      $sqlAdd = "insert into Ticket (MovieID, MemberID, FoodID, seat, showtime) value (?, ?, ?, ?, ?, ?)";
      $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("iiiss", $_POST['mid'], $_POST['meid'], $_POST['fid'], $_POST['Tseat'], $_POST['Tshowtime']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">Ticket Purchased!</div>';
      break;
 
  }
}
    
    
   $mid = $_GET['id'];
  
$sql = "Select movieID, Title, Image, Starring, Director, Duration, Summary from Movie where movieID=" . $mid;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>

   <tbody>
    
      <tr>
    <td><?=$row["Title"]?></td>
    <td><?=$row["Starring"]?></td>
       <td><?=$row["Director"]?></td>
        <td><?=$row["Duration"]?></td>
                <td>$<?=$row["Summary"]?></td>


    </tr>   
                     
                     
                     
                     

<?php
  }
} else {
  echo "0 results";
}
  

?>
      </tbody>
    </table>
    
    
    
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTicket">
Buy Ticket      </button>
      <!-- Modal -->
      <div class="modal fade" id="addTicket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTicketLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addTicketLabel">Buy Ticket</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="modal-body">
   <form method="post" action="">
       <div class="mb-3">
               <label for="Showtime" class="form-label">Showtime</label>
               <input type="text" class="form-control" id="showtime" aria-describedby="nameHelp" name="Tshowtime">
               <div id="nameHelp" class="form-text">Enter the time of the movie</div>
       </div>

       <div class="mb-3">
               <label for="Seat" class="form-label">Seat</label>
               <input type="text" class="form-control" id="seat" aria-describedby="nameHelp" name="Tseat">
               <div id="nameHelp" class="form-text">Enter your seat number</div>
       </div>
       <div class="mb-3">
                            <label for="MemberList" class="form-label">Member</label>
                            <select class="form-select" aria-label="Select Member" id="memberList" name="meid" >
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
                            <select class="form-select" aria-label="Select Snack" id="FoodList" name="fid" >
                          <?php
                              $ticketsaddSql = "select Food, FoodID from Menu order by Food";
                              $ticketsaddResult = $conn->query($ticketsaddSql);
                              while($ticketsaddRow = $ticketsaddResult->fetch_assoc()) {
                         ?>
                               <option value="<?=$ticketsaddRow['FoodID']?>"><?=$ticketsaddRow['Food']?></option>
                         <?php
                              }
                         ?>
                           </select>
                       </div>
                           <input type="hidden" name="mid" value="<?=$mid ?>">
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
       <?
      $conn->close();
?>


        
             <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>

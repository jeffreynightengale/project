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
      $sqlAdd = "insert into Reward (Email, Name) value (?, ?)";
      $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("ss", $_POST['mEmail'], $_POST['mName']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">Member added.</div>';
      break;
         case 'Edit':
      $sqlEdit = "update Reward set Email=?, Name=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ss", $_POST['mEmail'], $_POST['mName']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Member edited.</div>';
      break;
        case 'Delete':
      $sqlDelete = "delete from Reward where memberID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['mid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Member deleted.</div>';
      break;
  }
     }
    ?>
    
      <h2>Employee</h2>  
    </tbody>
      </table>
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMember">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMemberLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addMemberLabel">Add Member</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="memberName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="memberName" aria-describedby="nameHelp" name="mName">
                  <div id="nameHelp" class="form-text">Enter the member's name.</div>
                </div>
                <div class="mb-3">
                  <label for="memberEmail" class="form-label">Email</label>
                  <input type="text" class="form-control" id="memberEmail" aria-describedby="nameHelp" name="mEmail">
                  <div id="nameHelp" class="form-text">Enter the member's email.</div>
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
      <th>Member ID</th>
            <th>Email</th>
            <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php
 
$sql = "Select * from Reward";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["memberID"]?></td>
    <td><?=$row["Email"]?></td>
       <td><?=$row["Name"]?></td>
      <td>
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editReward<?=$row["memberID"]?>">
                    Edit
                  </button>
                  <div class="modal fade" id="editReward<?=$row["memberID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editReward<?=$row["memberID"]?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editReward<?=$row["memberID"]?>Label">Edit Member</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="">
                            <div class="mb-3">
                              <label for="editReward<?=$row["memberID"]?>Name" class="form-label">Member Name</label>
                              <input type="text" class="form-control" id="editReward<?=$row["memberID"]?>Name" aria-describedby="editReward<?=$row["memberID"]?>Help" name="mName" value="<?=$row['Name']?>">
                              <div id="editReward<?=$row["memberID"]?>Help" class="form-text">Enter the member's name.</div>
                            </div>
                           <div class="mb-3">
                              <label for="editReward<?=$row["memberID"]?>Email" class="form-label">Email</label>
                              <input type="text" class="form-control" id="editReward<?=$row["memberID"]?>Email" aria-describedby="editReward<?=$row["memberID"]?>Help" name="mEmail" value="<?=$row['Email']?>">
                              <div id="editReward<?=$row["memberID"]?>Help" class="form-text">Enter the member's email.</div>
                            </div>
    
    
                            <input type="hidden" name="mid" value="<?=$row['memberID']?>">
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
                <input type="hidden" name="mid" value="<?=$row["memberID"]?>" />
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>

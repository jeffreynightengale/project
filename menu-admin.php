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
      $sqlAdd = "insert into Menu (Food_name, Price, image) value (?, ?, ?)";
      $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("sss", $_POST['mFood'], $_POST['mPrice'], $_POST['mImage']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">Food added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Menu set Food_name=?, Price=?, image=? where foodID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sssi", $_POST['mFood'], $_POST['mPrice'], $_POST['mImage'], $_POST['mid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Food edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Menu where foodID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['mid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Food deleted.</div>';
      break;
  }
     }
    ?>
    
      <h2>Employee</h2>   
<table class="table table-striped">
  <thead>
    <tr>
            <th>Food</th>
            <th>Price</th>
       <th>Image</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
 
$sql = "Select foodID, Food_name, Price, image from Menu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["Food_name"]?></td>
    <td><?=$row["Price"]?></td>
       <td><?=$row["Image"]?></td>
 <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editMenu<?=$row["foodID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editMenu<?=$row["foodID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMenu<?=$row["foodID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editMenu<?=$row["foodID"]?>Label">Edit Menu</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editMenu<?=$row["foodID"]?>Name" class="form-label">Food</label>
                          <input type="text" class="form-control" id="editMenu<?=$row["foodID"]?>Name" aria-describedby="editMenu<?=$row["foodID"]?>Help" name="mFood" value="<?=$row['Food_name']?>">
                          <div id="editMenu<?=$row["foodID"]?>Help" class="form-text">Enter the new food name.</div>
                          <div class="mb-3">
                           <label for="editMenu<?=$row["foodID"]?>Price" class="form-label">Price</label>
                          <input type="text" class="form-control" id="editMenu<?=$row["foodID"]?>Price" aria-describedby="editMenu<?=$row["foodID"]?>Help" name="mPrice" value="<?=$row['Price']?>">
                          <div id="editMenu<?=$row["foodID"]?>Help" class="form-text">Change price.</div>
                          <div class="mb-3">
                           <label for="editMenu<?=$row["foodID"]?>image" class="form-label">Image</label>
                          <input type="text" class="form-control" id="editMenu<?=$row["foodID"]?>image" aria-describedby="editMenu<?=$row["foodID"]?>Help" name="mImage" value="<?=$row['image']?>">
                          <div id="editMenu<?=$row["foodID"]?>Help" class="form-text">Add image url.</div>
                            <input type="hidden" name="mid" value="<?=$row['foodID']?>">
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
                <input type="hidden" name="mid" value="<?=$row["foodID"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMenu">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addMenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addMenuLabel">Add Menu Item</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="foodName" class="form-label">Food</label>
                  <input type="text" class="form-control" id="foodName" aria-describedby="nameHelp" name="mName">
                  <div id="nameHelp" class="form-text">Enter the food.</div>
                </div>
                <div class="mb-3">
                  <label for="menuPrice" class="form-label">Price</label>
                  <input type="text" class="form-control" id="menuPrice" aria-describedby="nameHelp" name="mPrice">
                  <div id="nameHelp" class="form-text">Enter the food's cost.</div>
                </div>
                <div class="mb-3">
                  <label for="menuImage" class="form-label">Food Image</label>
                  <input type="text" class="form-control" id="menuImage" aria-describedby="nameHelp" name="mImage">
                  <div id="nameHelp" class="form-text">Enter the food's picture.</div>
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

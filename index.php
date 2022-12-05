<?php require_once("header.php"); ?>
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
    $stmtAdd->bind_param("ss", $_POST['rEmail'], $_POST['rName']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">Member Added!</div>';
      break;
 
  }
}
?>

<div class="text-center">
  <img src="RHJ.png" class="rounded">
</div>
<p class="text-bg-primary p-3 text-center">Welcome to RHJ Movie Theater! This website shows our movies playing, menu, and how to get to our theater.</p>
<div class="text-center">
  <h1>Featured Movie:</h1>
</div>
<div class="text-center">
  <img src="https://m.media-amazon.com/images/M/MV5BNTM4NjIxNmEtYWE5NS00NDczLTkyNWQtYThhNmQyZGQzMjM0XkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_FMjpg_UX1000_.jpg" style="height: 30vw;" class="rounded">
</div>

    
    
    <div class="text-center">
     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMember">
        Become a Member!
      </button>
</div>
        
      <!-- Modal -->
      <div class="modal fade" id="addMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMemberLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addMemberLabel">Become a Member</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" aria-describedby="nameHelp" name="rName">
    <div id="nameHelp" class="form-text">Enter your name</div>
  </div>
    
       <div class="mb-3">
    <label for="Email" class="form-label">Email</label>
    <input type="text" class="form-control" id="Email" aria-describedby="nameHelp" name="rEmail">
    <div id="nameHelp" class="form-text">Enter your email address</div>
  </div>
   
               
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


       <iframe width="560" height="315" src="https://www.youtube.com/watch?v=RlOB3UALvrQ" frameborder="0" ></iframe>




          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


</body>
    <?php require_once('footer.php'); ?>

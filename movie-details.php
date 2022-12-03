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



      
     <th></th>
     <th></th>
    
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

$sql = "Select movieID, Title, Image, Starring, Director, Duration, Dummary from Movie where movieID=? ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>

   <tbody>
    
      <tr>
    <td><?=$row["Title"]?></td>
    <td><?=$row["Starring"]?></td>
       <td>$<?=$row["Director"]?></td>
        <td>$<?=$row["Duration"]?></td>
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
       <?
      $conn->close();
?>


        
        
</body>

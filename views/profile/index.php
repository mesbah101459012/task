<?php
require_once('../../controllers/AuthController.php');
require_once('../../HijriDateLib/hijri.class.php');
require_once('../../controllers/DataHandlingController.php');
require_once('../../controllers/DataValidationController.php');
require_once('../../controllers/DBController.php');
AuthController::gustAuth('../../index.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "makaseb";

$userEmail=$_SESSION['userEmail'];
//connecting to database
$connectDb= new ConnectDb($servername,$username,$password,$dbname);

$conn=$connectDb->connectdb();
//get data user
$sql = "SELECT * FROM `users` WHERE userEmail ='$userEmail'";
$result=$connectDb->select($conn,$sql);



require_once('../../includes/header.php');
require_once('../../includes/nav.php');


if ($result->num_rows > 0) {
  // output data of each row
  $userData= $result->fetch_assoc();

  $create_at=$userData['created_at'];


//convert the date 
$hijriDate=new hijri\datetime($create_at);
$date= $hijriDate->format('   D _j _M _Y ||  H:i:s');


}
?>
<div class="text-center mt-5"><h1 class="text-primary">Welcome </h1></div>
<div class="text-center mt-5"><p class="text-dark">User name:  <?php echo ($userData['userName']) ?></p></div>
<div class="text-center mt-5"><p class="text-dark">User email:  <?php echo ($userData['userEmail']) ?></p></div>
<div class="text-center mt-5"><p class="text-dark">User joined date:  <?php echo ($date) ?></p></div>




<?php

require_once('../../includes/footer.php');


?>


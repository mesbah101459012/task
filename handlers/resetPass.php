<?php 



session_start();
require_once '../vendor/autoload.php';
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');


//data to reset password
$userEmail=DataHandlingController::handleData('email','Email is require');
$userEmail=DataValidationController::testInput($userEmail);

if (!filter_var($userEmail,FILTER_VALIDATE_EMAIL )) {
    array_push(DataHandlingController::$errs,"Invalid email format");
  }
  if(!empty(DataHandlingController::$errs))
  {
      echo (json_encode(DataHandlingController::$errs)); 
      die();
  }
  

//search if email is exist


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "makaseb";


  $connectDb= new ConnectDb($servername,$username,$password,$dbname);

  $conn=$connectDb->connectdb();
  
  $sql = "SELECT * FROM `users` WHERE userEmail ='$userEmail'";
  $result=$connectDb->select($conn,$sql);
  if($result->num_rows == 0){
      $conn->close();
      array_push(DataHandlingController::$errs,"The email you just enterd is not exist");
      echo (json_encode(DataHandlingController::$errs)); 
      die();
  }
  else{

    //if email is exist set access_tocken to make sure no attacker change any email
    $access_token=uniqid();
    $sql = "UPDATE `users` SET `access_token` = '$access_token' WHERE `userEmail` ='$userEmail'";
    $result=$connectDb->select($conn,$sql);
 
    }

/*******
 * 
 * PHPmailer library to send mails with cradintials "i will use mail trap to do it"
 * for access to my mail trap  account to get reset password link
 * url: https://mailtrap.io/
 * email: mzgh10111213@gmail.com
 * password: mzgh10111213@gmail.com
 *
******/


// Start with PHPMailer class 
use PHPMailer\PHPMailer\PHPMailer;
// create a new object
$mail = new PHPMailer();
// configure an SMTP (from mailtrap website)
$mail->isSMTP();
$mail->Host = 'sandbox.smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Username = '9c133dd7610d47';
$mail->Password = '7073871097ffd8';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 2525;


$mail->setFrom('Makaseb@Makaseb.com', ' Makaseb');
$mail->addAddress("$userEmail", 'Me');
$mail->Subject = 'Reset your password';
// Set HTML 
$mail->isHTML(TRUE);
$mail->Body = "<html><h1 >reset your Password</h1>To reset your password click: </br> <a href='http://localhost/task/views/resetPass/index.php?access_token=$access_token'>Reset your password</a></html>";
$mail->AltBody = 'Hi there, we are happy to confirm your booking. Please check the document in the attachment.';

// send the message
if(!$mail->send()){
    array_push(DataHandlingController::$errs,"The email you just enterd is not exist");
      echo (json_encode(DataHandlingController::$errs)); 
      die();
} else {
  //success massage will show after send mail (wait about 10 secends after click reset password button)
  
    $success['success']=true;
    $success['successMsg']='The reset like had been send to your email (Mailtrap account)';
    echo (json_encode($success));
    die();
}


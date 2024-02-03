<?php 

session_start();
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "makaseb";




//to 1-set userEmail using method handlData and 2-test it by trim it and remove lashes and turn it to htmlspecialchars 3-filter it to invalid input
$userEmail=DataHandlingController::handleData('userEmailLogin','Email is require');
$userEmail=DataValidationController::testInput($userEmail);

if (!filter_var($userEmail,FILTER_VALIDATE_EMAIL )) {
    array_push(DataHandlingController::$errs,"Invalid email format");
  }





//to 1-set password  using method handlData and 2-test it by trim it and remove lashes and turn it to htmlspecialchars 3-hash password using function password_hash in php

$userPassword=DataHandlingController::handleData('userPasswordLogin','Password is require');
$userPassword=DataValidationController::testInput($userPassword);
$userPassword=DataValidationController::hashPass($userPassword);


//if there an error during handling inputs or validation  it will return errors to ajax 
if(!empty(DataHandlingController::$errs))
{
    echo (json_encode(DataHandlingController::$errs)); 
    die();
}



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
    
    $userData=$result->fetch_assoc();
    if($userData['password']!=$userPassword)
    {
        array_push(DataHandlingController::$errs,"The password is incorrect");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
    }
    else{
        $_SESSION['userEmail']=$userEmail;
        $_SESSION['loggedin']=true;

        $registered['loggedin']=true;
        $registered['redirect']='./views/dashboard';
        echo (json_encode($registered));
        die();
    }

   

}
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
$userEmail=DataHandlingController::handleData('userEmail','Email is require');
$userEmail=DataValidationController::testInput($userEmail);

if (!filter_var($userEmail,FILTER_VALIDATE_EMAIL )) {
    array_push(DataHandlingController::$errs,"Invalid email format");
  }



//to 1-set userName using method handlData and 2-test it by trim it and remove lashes and turn it to htmlspecialchars 3-filter it to invalid input

$userName=DataHandlingController::handleData('userName','User name  is require');
$userName=DataValidationController::testInput($userName);

if (!preg_match("/^[a-zA-Z-' ]*$/",$userName)) {
    array_push(DataHandlingController::$errs,"Invalid user name format");
  }

//to 1-set password using method handlData and 2-test it by trim it and remove lashes and turn it to htmlspecialchars 3-hash password using function password_hash in php

$userPassword=DataHandlingController::handleData('userPassword','Password is require');
$userPassword=DataValidationController::testInput($userPassword);
$userPassword=DataValidationController::hashPass($userPassword);


//if there an error during handling inputs or validation  it will return errors to ajax 
if(!empty(DataHandlingController::$errs))
{
    echo (json_encode(DataHandlingController::$errs)); 
    die();
}


//connecting to database
$connectDb= new ConnectDb($servername,$username,$password,$dbname);

$conn=$connectDb->connectdb();
//testing if the email is exist !! if exist return err
$sql = "SELECT * FROM `users` WHERE userEmail ='$userEmail'";
$result=$connectDb->select($conn,$sql);
if($result->num_rows > 0){
    $conn->close();
    array_push(DataHandlingController::$errs,"The email you just enterd is exist");
    echo (json_encode(DataHandlingController::$errs)); 
    die();
}
else{
    //if email not exist insert user data and redirect to dashboard
    $sqlToAddUser="INSERT INTO `users` ( `userName`, `userEmail`, `password`) VALUES ( '$userName', '$userEmail', '$userPassword')";
    $connectDb->insert($conn,$sqlToAddUser);
    $conn->close();

    //storing emain in to session to get its data from database anytime
    $_SESSION['userEmail']=$userEmail;
    $_SESSION['loggedin']=true;

    $registered['registered']=true;
    $registered['redirect']='./views/dashboard';
    echo (json_encode($registered));
    die();
}






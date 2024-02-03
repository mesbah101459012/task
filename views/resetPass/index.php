
<?php 
require_once('../../controllers/AuthController.php');
require_once('../../includes/header.php');

//if the user logged in it will redirect him to dashboard
AuthController::userAuth('../dashboard');

//access token which came from like that sent to email
if(isset($_GET['access_token']))
{
    $access_token=$_GET['access_token'];
}
else{
    $access_token=null;
}

?>



<div class="container">

    <div class="text-center mt-5">
        <h5 class="modal-title" >Reset your password</h5>
    </div>
    <div class="modal-body">

    <!-- reset password form -->
        <form id="resetPassword" method="POST"  >
            <div id="resetPassErrs" class="form-text bg-danger text-white"></div>
            <div id="successMsg" class="form-text bg-success text-white text-center"></div>
    
            <div class="mb-3">
                <label for="userEmail" class="form-label"> New password</label>
                <input type="password" name="password"  class="form-control" aria-describedby="emailHelp">
                <input type="text" hidden name="access_token"  value="<?php echo($access_token)?>" class="form-control" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Reset</button>
        </form>
    </div>
</div>

<?php 

require_once('../../includes/footer.php');



?>
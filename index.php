
<?php 
require_once('./controllers/AuthController.php');
require_once('./includes/header.php');
AuthController::userAuth('./views/dashboard');


?>


    
     

    <main >

        <div class="container">
            <div class="text-center mt-5">
                <h2 class="text-dark">Welcom to <span class="text-primary ">Makaseb</span></h2>
            </div>

            <form class="my-2" id='loginForm' method="post" >
                <div id="loginErrs" class="form-text bg-danger text-white"></div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email address</label>
                    <input type="email" name="userEmailLogin" id="userEmailLogin"  class="form-control" aria-describedby="emailHelp">
                    <div id="emailErr" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="userPassword" class="form-label">Password</label>
                    <input type="password" name="userPasswordLogin" id="userPasswordLogin"  class="form-control" >
                    <div id="passwordErr" class="form-text text-danger"></div>

                </div>
                
                <button id="submit" class="btn btn-primary d-inline mr-4">Login</button>
                <p class="text-primary text-decoration-none cursor-pointer mx-4 d-inline" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#showRegisterForm">forget your password?</p>

                
            </form>

            <!-- Button trigger Register modal -->
            <button class=" btn btn-success text-white text-decoration-none px-5 mt-3" data-bs-toggle="modal" data-bs-target="#showLoginForm" id=''>Register</button>
            <!-- Button trigger Register modal -->

        </div>




        <!-- Register Modal -->
        <div class="modal fade" id="showLoginForm" tabindex="-1" aria-labelledby="showLoginFormLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showLoginFormLabel">Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="registerForm" method="POST" >
 
                        <div id="Errs" class="form-text bg-danger text-white"></div>

                            <div class="mb-3">
                                <label for="userName" class="form-label">User Name</label>
                                <input type="text" name="userName"  class="form-control"  aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Email address</label>
                                <input type="text" name="userEmail"  class="form-control" aria-describedby="emailHelp">
                                <div id="emailErr" class="form-text text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <label for="userPassword" class="form-label">Password</label>
                                <input type="password" name="userPassword"  class="form-control" >
                                <div id="passwordErr" class="form-text text-danger"></div>

                            </div>
                            
                            <button type="submit" class="btn btn-primary" id="regiser">Register</button>
                        </form> 
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Register Modal -->


        <!-- forget password modal -->
        <div class="modal fade" id="showRegisterForm" tabindex="-1" aria-labelledby="showRegisterFormLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showRegisterFormLabel">Reset your password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="resetPasswordForm" method="POST"  >
                    <div id="resetPassErrs" class="form-text bg-danger text-white"></div>
                    <div id="successMsg" class="form-text bg-success text-white text-center"></div>

                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email address</label>
                            <input type="email" name="email"  class="form-control" aria-describedby="emailHelp">
                            <div id="emailErr" class="form-text text-danger"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </form>
                </div>
                
                
                </div>
            </div>
        </div>
        <!-- forget password modal -->
    </main>

<?php 

require_once('./includes/footer.php');



?>
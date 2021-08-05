  
<!-- header section -->
<?php
  ob_start();
  include "includes/header.php";
  // include "admin/inc/connect.php";
  session_start();
?>
     <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" name=" first_Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" name="last_Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="re_password">
                                    </div>
                                </div>
                                <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button type="">
                                <hr>
                                <a href="" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!--- registration code start here--->

            <?php
                if ( isset($_POST['register'])) {
                  $first_Name             = mysqli_real_escape_string($db,$_POST['first_Name']); 
                  $last_Name              = mysqli_real_escape_string($db,$_POST['last_Name']);
                  $email                 = mysqli_real_escape_string($db,$_POST['email']);
                  $password              = mysqli_real_escape_string($db,$_POST['password']);
                  $re_password           = mysqli_real_escape_string($db,$_POST['re_password']);

                  if ($password == $re_password) {

                     $hass = sha1($password);

                  // Insert New Data into the DB
                      $query1 = "INSERT INTO users (first_Name, last_Name, email, password) VALUES ('$first_Name', '$last_Name','$email', '$hass')";

                      
                      $result1 = mysqli_query($db,$query1);



                      if ($result1) {

                        header("Location: index.php");
                      }
                      else
                      {
                        die(" Database connection error " . mysqli_error($db));
                      }

                    
                       }
                     }
               ?>
    </div>

    <!-- footer section -->
<?php
  include "includes/footer.php";
?>
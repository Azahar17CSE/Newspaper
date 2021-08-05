<!-- header section -->
<?php
  ob_start();
  include "includes/header.php";
  // include "admin/inc/connect.php";
  session_start();
?>

        <section id="cta" class="section">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-4 col-md-12">
                        <div class="newsletter-widget text-center align-self-center">
                            
                            <form class="form-inline" method="post">
                                <input type="text" name="email" placeholder="Add your email here.." required class="form-control" />
                                
                                <input type="password" name="password" placeholder="Enter Your Pssword here.." required class="form-control" />
                                <button type="" class="btn btn-info" name="login_btn">LogIn</button>
                                
                            </form>         
                        </div><!-- end newsletter -->
                    </div>
                </div>
            </div>
        </section>

  <?php 
        if(isset($_POST['login_btn'])){

           $user_email    = $_POST['email'];
           $password = $_POST['password'];

           $hassed_password = sha1($password);
            

            $query = "SELECT * FROM users WHERE email ='$user_email'";
            $result = mysqli_query($db,$query);
            $i = 0;

            while($row = mysqli_fetch_assoc($result)){
                $_SESSION['user_id']        = $row['user_id'];
                $_SESSION['first_Name']     = $row['first_Name'];
                $_SESSION['last_Name']      = $row['last_Name'];
                $_SESSION['username']       = $row['username'];
                $_SESSION['address']        = $row['address'];
                $_SESSION['email']          = $row['email'];
                $password                   = $row['password'];
                $_SESSION['phone_number']   = $row['phone_number'];
                $_SESSION['user_photo']     = $row['user_photo'];
                $_SESSION['status']         = $row['status'];
                $_SESSION['user_rule']      = $row['user_rule'];
                $i++;

                if ($_SESSION['email']  == $user_email && $password == $hassed_password) 
                {
                     header("Location: index.php");
                }

                else if ($email == $user_email || $password == $hassed_password)
                 {
                    header("Location: login.php");
                 }
                 else
                 {
                    header("Location: login.php");
                 }
        }

    }
    ?>

<!-- footer section -->
<?php
  include "includes/footer.php";
?>
<?php
include("inc/header.php");
?>
 <!-- body content start-->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Your Profile</h1>
                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-md-3">
                            <div class="card shadow mb-4" style="width: 24rem;">
                                <div class="card-header py-3">
                                    <h3 class="m-0 font-weight-bold text-primary text-center">Your Profile</h3>
                                </div>
                                <div class="card-body user-profile">
                                    <?php 
                                        $user_id = $_SESSION['user_id'];

                                        $query = "SELECT * FROM users WHERE user_id = '$user_id'";

                                        $result = mysqli_query($db,$query);

                                        while ( $row = mysqli_fetch_assoc($result)) {
                                            $user_id              = $row['user_id'];
                                            $username             = $row['username'];
                                            $username             = $row['username'];
                                            $email                = $row['email'];
                                            $password             = $row['password'];
                                            $phone_number         = $row['phone_number'];
                                            $address              = $row['address'];
                                            $status               = $row['status'];
                                            $user_rule            = $row['user_rule'];
                                            $user_photo           = $row['user_photo'];

                                         } 
                                    ?>
                                    <img src="img/users/<?php echo $user_photo; ?>" class="img-fluid">
                                    <h2><span>Name:</span> <?php echo "$username"; ?></h2>
                                    <h4><span>UserName: </span><?php echo "$username"; ?></h4>
                                    <h4><span>Email: </span><?php echo "$email"; ?></h4>
                                    <h4><span>Phone: </span><?php echo "$phone_number"; ?></h4>
                                    <h4><span>Address: </span><?php echo "$address"; ?></h4>
                                    <h4><span>Status: </span><?php echo "$status"; ?></h4>
                                    
                                </div>
                            </div>
                        </div>
            </div>
         <!-- /.content-header -->

        </div>
      <!-- /.container-fluid -->
    </div>
    <!-- Main content -->
 </div>
  <!-- body content end-->
<?php
include("inc/footer.php");
?>
<?php
include("inc/header.php");
?>
<!-- Begin Page Content -->
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="card">
    				<div class="card-header" style="background: #4e73df; color: white;">
    					<h4>Add new user</h4>
    				</div>
    				<div class="card-body" >
    					<form method="POST" enctype="multipart/form-data">
    						<div class="form-group">
								<label for="">First Name</label>
								<input type="text" name="firstname" class="form-control" placeholder="Enter Your first name">
							</div>
							<div class="form-group">
								<label for="">Last Name</label>
								<input type="text" name="lastname" class="form-control" placeholder="Enter Your last name">
							</div>
							<div class="form-group">
								<label for="">Usser Name</label>
								<input type="text" name="ussername" class="form-control" placeholder="Enter Your user name">
							</div>
							<div class="form-group">
								<label for="">Address</label>
								<input type="text" name="address" class="form-control" placeholder="Enter Your address">
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="email" name="email" class="form-control" placeholder="Enter Your email address">
							</div>
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" name="password" class="form-control" placeholder="Enter Your password">
							</div>
							<div class="form-group">
								<label for="">Phone No</label>
								<input type="number" name="phone" class="form-control" placeholder="Enter Your phone number">
							</div>
							<div class="form-group">
								<label for="">Insert Your Photo</label>
								<input type="file" name="img" class="form-control" placeholder="INsert Your photo">
							</div>
								<button type="submit" name="add_user_btn" class="btn btn-primary">Add Usser Info</button>
							</form>
    				</div>
    				
    			</div>
    			<!---Insert into the database--->
    			<?php
    				if (isset($_POST['add_user_btn'])){
    					$firstname 			= $_POST['firstname'];
    					$laststname 		= $_POST['lastname'];
    					$ussername  		= $_POST['ussername'];
    					$address 			= $_POST['address'];
    					$email 				= $_POST['email'];
    					$password   		= $_POST['password'];
    					$phone 				= $_POST['phone'];
    					$image				= $_FILES['img']['name']; //file name
    					$image_size			= $_FILES['img']['size']; //file size

    					$image_tmp			= $_FILES['img']['tmp_name']; //tmp file

    					
    					
                        $explode = explode(".",$image);
                        $end = end($explode);
    					
                        $extn = strtolower($end);

    					

    					$extension = array("jpg","png","jpeg");


                        if(in_array($extn,  $extension) === false)
                        {
                            echo "this is not img";
                        }
                        else
                        
                        {
                            //password encryption
                        $hashpassword = sha1($password);
                        //add randome number before img
                        $random = rand(0,10000);

                        $update_image_name = $random."_".$image;

                        //tmp->move to the main folder
                        move_uploaded_file($image_tmp, "img/users/".$update_image_name);

                         //send the info into the database

                        $query = "INSERT INTO users (first_Name, last_Name, username, address, email, password, phone_number, user_photo, user_rule) VALUES ('$firstname', '$laststnames', '$ussername', '$address', '$email', '$hashpassword', '$phone', '$update_image_name', '1')";

                        
                        $result = mysqli_query($db,$query);
                        if ($result)
                         {
                            header('location: user.php');
                        }
                        else
                        {
                            echo "error";
                        }
                     }                       

                    }
    				
    			 ?>
    			
    		</div>
    		
    	</div>
    </div>
    <!-- /.container-fluid -->
    </div>
<!-- End of Main Content -->
<?php
include("inc/footer.php");
?>
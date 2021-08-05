<?php
	include("inc/header.php");
?>
<!-- Begin Page Content -->
    <div class="container-fluid">
    	<?php
    		if(isset($_GET['update_id'])){
    			$update_id = $_GET['update_id'];
    			
    			$query = "SELECT * FROM users WHERE user_id='$update_id'";
        		$result = mysqli_query($db,$query);
        		while($row = mysqli_fetch_assoc($result)){
        			$user_id        = $row['user_id'];
        			$first_Name     = $row['first_Name'];
        			$last_Name      = $row['last_Name'];
        			$username       = $row['username'];
        			$address   	    = $row['address'];
        			$email   	    = $row['email'];
        			$password       = $row['password'];
        			$phone_number   = $row['phone_number'];
        			$user_photo     = $row['user_photo'];
        			$status   	    = $row['status'];
        			$user_rule    	= $row['user_rule'];
        		}
        	?>
        		<div class="card">
        			<div class="card-header" style="background: #4e73df; color: white;">
    				<h4>Update user Information</h4>
    			</div>
        		<div class="card-body" >
    					<form method="POST" enctype="multipart/form-data">
    						<div class="form-group">
								<label for="">First Name</label>
								<input type="text" name="firstname" value="<?php echo $first_Name;?>" class="form-control" placeholder="Enter Your first name">
							</div>
							<div class="form-group">
								<label for="">Last Name</label>
								<input type="text" name="lastname" value="<?php echo $last_Name;?>"class="form-control" placeholder="Enter Your last name">
							</div>
							<div class="form-group">
								<label for="">Usser Name</label>
								<input type="text" name="ussername" value="<?php echo $username;?>" class="form-control" placeholder="Enter Your user name">
							</div>
							<div class="form-group">
								<label for="">Address</label>
								<input type="text" name="address" value="<?php echo $address;?>" class="form-control" placeholder="Enter Your address">
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="email" name="email" value="<?php echo $email;?>" class="form-control" placeholder="Enter Your email address">
							</div>
							<!-- <div class="form-group">
								<label for="">Password</label>
								<input type="password" name="password" value="<?php echo $username;?>" class="form-control" placeholder="Enter Your password">
							</div> -->
							<div class="form-group">
								<label for="">Phone No</label>
								<input type="number" name="phone" value="<?php echo $phone_number;?>" class="form-control" placeholder="Enter Your phone number">
							</div>
							<div class="form-group">
								<lavel for="exampleFormControlSelect1">Select post Status</lavel>
								<select class="form-control" id="exampleFormControlSelect1" name="update_status">

									<?php if ($status == 1){
										echo "<option value='1'>Approved</option> <br>
										<option value='0'>Pending</option>";

									} 
									else
									{
										echo "<option value='0'>Pending</option> <br>
										<option value='1'>Approved</option>";
									}
									?>
										
									
									
							
									
								</select>
							</div>
							<div class="form-group">
								<label for="">Insert Your Photo</label>
								<input type="file" name="img" class="form-control" placeholder="INsert Your photo">
								<img src="img/users/<?php echo $user_photo;?>" width="80px";>
							</div>
								<button type="submit" name="update_user_btn" class="btn btn-primary">update Usser Info</button>
							</form>
    			</div>
        		</div>
        	<?php
    		}
    	 ?>
    </div>
    <!-- /.container-fluid -->

<?php
	 if (isset($_POST['update_user_btn'])) {

	 	$firstname          = $_POST['firstname'];
		$laststname 		= $_POST['lastname'];
		$ussername  		= $_POST['ussername'];
		$address 			= $_POST['address'];
		$email 				= $_POST['email'];
		$update_status   	= $_POST['update_status'];
		$phone 				= $_POST['phone'];

		$image = $_FILES['img']['name']; //file name
    	$image_size = $_FILES['img']['size']; //file size

    	// update image

    	if(!empty('$image')){
    		$image_tmp			= $_FILES['img']['tmp_name'];
    		$explode = explode(".",$image);
            $end = end($explode);
    					
            $extn = strtolower($end);


    					

    		$extension = array("jpg", "png", "jpeg");

    		if(in_array($extn, $extension) ===  false)
    		{
    			echo "uploaded file is not an image";
    			header("Locstion: user.php");
    		}
    		else

    		{

	    			 //delete the file
	            "SELECT user_photo FROM users WHERE user_id = '$update_id;";
	            $result = mysqli_query($db,$query);

	            while ($row = mysqli_fetch_assoc($result)) {
	                $del_img = $row['user_photo'];

	            }
	            unlink("img/users/".$del_img);

	            //update the file

    			$random = rand(0,10000);
    			$update_image_name = $random."_".$image;
    			move_uploaded_file($image_tmp, "img/users/".$update_image_name);

    			$query = "UPDATE users SET first_Name = '$firstname', last_Name = '$laststname', username = '$ussername', address = '$address', email = '$email', phone_number = '$phone', user_photo ='$update_image_name', status='$update_status' WHERE user_id='$update_id'";



    			$result = mysqli_query($db,$query);



				if ($result) {
					header('location: user.php');
				}
				else{
					echo "update error";
				}
    		}

    		
 			}else
 			{
 				$query = "UPDATE users SET first_Name= '$firstname',last_Name = '$laststname', username = '$ussername', address= '$address', email = '$email', phone_number = '$phone', user_photo ='$update_image_name', status='$update_status' WHERE user_id='$update_id'";

 				echo "$query";
    			$result = mysqli_query($db,$query);

				if ($result) {
					header('location: user.php');
				}
				else{
					echo "update user error";
				}
 			}

		
	 }
		
    ?>
    </div>
<!-- End of Main Content -->
<?php
include("inc/footer.php");
?>

<?php
	include("inc/header.php");
?>
<!-- Begin Page Content -->
    <div class="container-fluid">
    	<!-- update post code here -->
    	<?php
    		if(isset($_GET['edit_id'])){
    			$update_id = $_GET['edit_id'];
    			
    			$query = "SELECT * FROM post WHERE post_id='$update_id'";
        		$result = mysqli_query($db,$query);
        		while($row = mysqli_fetch_assoc($result)){
                    $post_id        = $row['post_id'];
        			$post_title     = $row['post_title'];
        			$post_des       = $row['post_des'];
        			$post_date      = $row['post_date'];
        			$post_thumbnail = $row['post_thumbnail'];
        			$user_id        = $row['user_id'];
                    $post_status    = $row['post_status'];
        			$cat_id2        = $row['cat_id'];
        		}
        	?>
    	<!-- body code here--->

    	<div class="row">
    		<div class="col-md-12">
    			<div class="card">
    				<div class="card-header" style="background: #4e73df; color: white;">
    					<h4>Update Post Information </h4>
    				</div>
    				<div class="card-body" >
    					<form method="POST" enctype="multipart/form-data">
    						<div class="form-group">
								<label for="">Edit Post Title</label>
								<input type="text" name="postitle" value="<?php echo $post_title;?>" class="form-control">
							</div>
							<div class="form-group">
								<label for="">Edit Post Description</label>
								<textarea type="text" rows="10" name="postdesc" class="form-control"><?php echo $post_des;?></textarea>
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
								<lavel for="exampleFormControlSelect1">Select post category</lavel>
								<select class="form-control" name="category_id" id="exampleFormControlSelect1">

									<?php 
										$query ="SELECT * FROM category";
										$result = mysqli_query($db,$query);

										while ($row = mysqli_fetch_assoc($result)) {
											$cat_id = $row['cat_id'];
											$cat_name = $row['cat_name'];

											?>

												<option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?> </option>
											<?php 
										}
										
									?>
																		
								</select>
							</div>
							<div class="form-group">
								<label for="">Insert Your Photo</label>
								<input type="file" name="img" class="form-control" placeholder="INsert Your photo">
								<img src="img/post/<?php echo $post_thumbnail;?>" width="80px";>
							</div>
								<button type="submit" name="update_post_btn" class="btn btn-primary">update Post Info</button>
							</form>
    			</div>
    				
    			</div>
    			
    		</div>
    		
    	</div>
    	<?php
    		}
    	 ?>
    </div>
    <!-- /.container-fluid -->
    </div>
<!-- End of Main Content -->

<?php
	 if (isset($_POST['update_post_btn'])) {

	 	$post_title 		 =	$_POST['postitle'];
		$post_desc 			 =  $_POST['postdesc'];
		$category_id  		 = $_POST['category_id'];
		$update_status   	 = $_POST['update_status'];

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
    			header("Locstion: post.php");
    		}
    		else

    		{

	    			 //delete the file
	            "SELECT post_thumbnail FROM post WHERE post_id = '$update_id;";
	            $result = mysqli_query($db,$query);

	            while ($row = mysqli_fetch_assoc($result)) {
	                $del_img = $row['post_thumbnail'];

	            }
	            unlink("img/post/".$del_img);

	            //update the file

    			$random = rand(0,10000);
    			$update_image_name = $random."_".$image;
    			move_uploaded_file($image_tmp, "img/post/".$update_image_name);

    			$query = "UPDATE post SET posttitle = '$post_title', postdesc = '$post_desc', status='$update_status', category_id ='$category_id' WHERE post_id='$update_id'";



    			$result = mysqli_query($db,$query);



				if ($result) {
					header('location: post.php');
				}
				else{
					echo "update error";
				}
    		}

    		
 			}
 			else
 			{
 				$query = "UPDATE post SET posttitle = '$post_title', postdesc = '$post_desc', status='$update_status', category_id ='$category_id' WHERE post_id='$update_id'";

    			$result = mysqli_query($db,$query);

				if ($result) {
					header('location: post.php');
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

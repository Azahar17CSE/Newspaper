<?php
ob_start();
include("inc/header.php");

$loged_user_id = $_SESSION['user_id'];
?>
<!-- Begin Page Content -->
    <div class="container-fluid">

    	<!-- body code here--->

    	<div class="row">
    		<div class="col-md-12">
    			<div class="card">
    				<div class="card-header" style="background: #4e73df; color: white;">
    					<h4>Add new post </h4>
    				</div>
    				<div class="card-body" >
    					<form method="POST" enctype="multipart/form-data">
    						<div class="form-group">
								<label for="">Post Title</label>
								<input type="text" name="post_title" class="form-control" placeholder="Enter Your post title">
							</div>
							<div class="form-group">
								<label for="">Post Description</label>
								<textarea type="text" rows="10" name="post_des" class="form-control" placeholder="Enter Your last name"></textarea>
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
								<label for="">Thambnail</label>
								<input type="file" name="thumbnail" class="form-control" placeholder="INsert Your photo">
							</div>
								<button type="submit" name="add-btn" class="btn btn-primary">Add New Post</button>
							</form>
    				</div>
    				
    			</div>
    			
    		</div>
    		
    	</div>

    </div>
    <!-- /.container-fluid -->
    </div>
<!-- End of Main Content -->

<?php
	
	if (isset($_POST['add-btn'])) 
	{
		$post_title =	mysqli_real_escape_string($db, $_POST['post_title']);
		$post_desc  =	mysqli_real_escape_string($db, $_POST['post_des']);
		$category_id   = $_POST['category_id'];

		$image	    = $_FILES['thumbnail']['name']; //file name
    	$image_size	= $_FILES['thumbnail']['size']; //file size

    	$image_tmp	= $_FILES['thumbnail']['tmp_name']; //tmp file

    	if (!empty($post_title) && !empty($post_desc) && !empty($category_id) && !empty($image))
    	{
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
            	$random = rand(0,10000);

	            $update_image_name = $random."_".$image;

	            //tmp->move to the main folder
	            move_uploaded_file($image_tmp, "img/post/".$update_image_name);

	             $query = "INSERT INTO post (post_title, post_des, post_date, post_thumbnail, user_id, cat_id) VALUES ('$post_title', '$post_desc', now(), '$update_image_name', '$loged_user_id', '$category_id')";



	              $result = mysqli_query($db, $query);
	              

	            if ($result) 
	            {
	            	echo "successfully submitted";

	            	header("Location: post.php");
	            }
	            else
	            {
	            	//echo ("conntection failed". mysqli_query($db));
	            }

            }

    	}

    	else
    	{
    		//let redirect to this page
    	}

	}
?>

<!----add new post/insert a new post into db----->

<?php
include("inc/footer.php");
?>
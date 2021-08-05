<?php
include("inc/header.php");
?>
<!-- Begin Page Content -->
    <div class="container-fluid">
    	<!--body code here -->
    	<div class="row">
    		<div class="col-md-12 text-center">
    			<h1>All Category Information</h1>
    			<hr>
    		</div>
    	</div>
    	<div class="row">
    		<!--left collum -->
    		<div class="col-md-6">
    			<div class="card">
    				<div class="card-header" style="background: #4e73df; color: white;">
    					<h4>Add new Category</h4>
    				</div>
    				<div class="card-body">
    					<form method="POST">
							<div class="form-group">
								<label for="">Add Category</label>
								<input type="text" name="cat_name" class="form-control" placeholder="Enter a new Category">
							</div>
							<div class="form-group">
								<label for="">Category Short Description</label>
								<input type="text" name="cat_description" class="form-control" placeholder="Category Description(limit:255)">
							</div>
								<button type="submit" name="cat_submit" class="btn btn-primary">Submit</button>
						</form>
    				</div>
    				<?php 
    					if(isset($_POST['cat_submit'])){

    						$cat_name         = $_POST['cat_name'];
    						$cat_description  = $_POST['cat_description'];

    						$query = "INSERT INTO category(cat_name, cat_description) VALUES('$cat_name', '$cat_description')";
    						$result = mysqli_query($db,$query);

    						if($result){
    							header('location:category.php');
    						}
    						else{
    							echo "category not inserted".mysql_error($db);
    						}

    					}
    				?>
    			</div>

    			<!---edit category option sart here--->
    			<?php 
    				if(isset($_GET['edit_id'])){
    					$cat_edit_id = $_GET['edit_id'];
    					$query  = "SELECT * FROM category WHERE cat_id='$cat_edit_id'";
    					$result = mysqli_query($db,$query);

    					while($row = mysqli_fetch_assoc($result)){
    						$edit_cat_name 			= $row['cat_name'];
    						$edit_cat_description 	= $row['cat_description'];
    					}

    				?>
    					<div class="card" style="margin: 40px 0 0 0">
    						<div class="card-header" style="background: #4e73df; color: white;">
    							<h4>Edit category</h4>
    						</div>
    						<div class="card-body">
    							<form method="POST">
								<div class="form-group">
								<label for="">Edit Category</label>
								<input type="text" name="edit_cat_name" value="<?php echo "$edit_cat_name" ?>" class="form-control" placeholder="Enter a new Category">
								</div>
								<div class="form-group">
									<label for="">Category Short Description</label>
									<input type="text" name="edit_cat_description" value="<?php echo "$edit_cat_description" ?>" class="form-control" placeholder="Enter Category Description(limit:255)">
								</div>
									<button type="submit" name="edit_cat_submit" class="btn btn-primary">Submit</button>
								</form>
    						</div>
                            <!---category values update here--->
                            <?php 
                            if(isset($_POST['edit_cat_submit'])){
                                $edit_cat_name          = $_POST['edit_cat_name'];
                                $edit_cat_desc          = $_POST['edit_cat_description'];

                                $query ="UPDATE category SET cat_name='$edit_cat_name', cat_description='$edit_cat_desc' WHERE cat_id='$cat_edit_id'";
                                $result = mysqli_query($db,$query);
                                if($result){
                                    header('location:category.php');
                                }
                                else{
                                    echo "category value update error".mysqli_error($db);
                                }
                            }

                            ?>
    						
    					</div>
    				<?php
    				}
    			?>
    			
    		</div>
    		<!-- right Collum-->
    		<div class="col-md-6">
    			<div class="card">
    				<div class="card-header" style="background: #4e73df; color: white;">
    					<h4>All Category List:</h4>
    				</div>
    				<div class="card-body">
    					<table class="table text-center">
  						<thead>
    						<tr>
								<th scope="col">Serial</th>
								<th scope="col">Category_Name</th>
								<th scope="col">Category_Desc</th>
								<th scope="col">Action</th>
  						  	</tr>
  						</thead>
  						<tbody>
  						<?php 
  							$query  = "SELECT * FROM category";
  							$result = mysqli_query($db,$query);
  							$i=0;
  							while($row = mysqli_fetch_assoc($result)){

  								$cat_id = $row['cat_id'];
  								$cat_name = $row['cat_name'];
  								$cat_description = $row['cat_description'];
  								$i++;
  							?>
  							
  								<tr>
									<th scope="row"><?php echo "$i"; ?></th>
									<td><?php echo "$cat_name"; ?></td>
									<td><?php echo "$cat_description"; ?></td>
									<td>
										<ul>
											<li><a href="category.php?edit_id=<?php echo "$cat_id" ?>"><i class="fas fa-pen"></i></a></li>
											<li><a href="category.php?cat_id=<?php echo "$cat_id" ?>"><i class="fas fa-trash-alt"></i></a></li>

										</ul>
									</td>
    							</tr>
    						<?php
  							}
  						?>
    						
  						</tbody>
						</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- /.container-fluid -->
<!----category delete functionality here---->
    <?php 

    	if(isset($_GET['cat_id'])){
    		$del_id 	= $_GET['cat_id'];
            $table ='category'; $table_id='cat_id'; $redirect_page='category.php';

    		delete($del_id, $table, $table_id, $redirect_page);
    	}
    ?>
    </div>
<!-- End of Main Content -->
<?php
include("inc/footer.php");
?>
<?php
include("inc/header.php");
?>
<!-- Begin Page Content -->
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-12 text-center">
    			<h1>All User Information</h1>
    			<hr>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-12">
    			 <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background: #4e73df; color: white;">
                            <h6 class="m-0 font-weight-bold">View All Ussers</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            
                                            <th>first_Name</th>
                                            <th>last_Name</th>
                                            <th>username</th>
                                            <th>address</th>
                                            <th>email</th>
                                            <th>phone_number</th>
                                            <th>user_photo</th>
                                            <th>status</th>
                                            <th>user_rule</th>  
                                            <th>Action</th>  
                                        </tr>
                                    </thead>
                                   <!--  ---
                                    <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>user_photo</th>
                                            <th>first_Name</th>
                                            <th>last_Name</th>
                                            <th>username</th>
                                            <th>address</th>
                                            <th>email</th>
                                            <th>phone_number</th>
                                            <th>status</th>
                                            <th>user_rule</th>  
                                        </tr>
                                    </tfoot>
                                    ----- -->
                                    <tbody>
                                    	<!---read all user info from database--->
                                    	<?php 
                                    		$query = "SELECT * FROM users";
                                    		$result = mysqli_query($db,$query);
                                    		$i = 0;

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
                                    			$i++;

                                    			?>
                                    				<tr>
			                                            <td><?php echo $i; ?></td>
			                                            <td><?php echo $first_Name ?></td>
			                                            <td><?php echo $last_Name  ?></td>
			                                            <td><?php echo $username ?></td>
			                                            <td><?php echo $address ?></td>
			                                            <td><?php echo $email ?></td>
			                                            
			                                            <td><?php echo $phone_number ?></td>
			                                            <td>
                                                            <img src="img/users/<?php echo $user_photo;?>" width="80px";>
                                                        </td>
			                                            <td>
                                                    <?php 

                                                        if ($status == 0) {
                                                            //pending

                                                            echo '<div class="badge badge-danger">Pending</div>';
                                                                
                                                            
                                                        }
                                                        else
                                                        {
                                                            //Approved
                                                            echo '<div class="badge badge-success">Approved</div>';
                                                        }

                                                    ?>
                                                </td>
			                                            <td><?php echo $user_rule ?></td>
			                                            <td>
															<ul>
																<li><a href="update.php?update_id=<?php echo "$user_id" ?>"><i class="fas fa-pen"></i></a></li>
																<li><a href="user.php?del_user=<?php echo "$user_id"?>"><i class="fas fa-trash-alt"></i></a></li>

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
    </div>
    <!-- /.container-fluid -->

    <!--delete user code here--->
    <?php 
        if (isset($_GET['del_user'])){
            $del_id = $_GET['del_user'];
            $table ='users'; $table_id='user_id'; $redirect_page='user.php';

            //delete the file
            "SELECT user_photo FROM users WHERE user_id = '$del_id;";
            $result = mysqli_query($db,$query);

            while ($row = mysqli_fetch_assoc($result)) {
                $del_img = $row['user_photo'];

            }
            unlink("img/users/".$del_img);

            delete($del_id,$table,$table_id,$redirect_page);
        }
    ?>
    </div>
<!-- End of Main Content -->
<?php
include("inc/footer.php");
?>
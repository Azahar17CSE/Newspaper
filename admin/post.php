<?php
include("inc/header.php");

?>
<!-- Begin Page Content -->
    <div class="container-fluid">
    	<div class="card">
			<div class="card-header py-3" style="background: #4e73df; color: white;">
	            <h6 class="m-0 font-weight-bold">View All Post</h6>
	         </div>
    		<div class="card-body">
    			<div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Thumbnail</th>
                                            <th>Catname</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Action</th>
	                                        
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Thumbnail</th>
                                            <th>Catname</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Username</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                    	<?php
                                    		$query = "SELECT * FROM post";


                                    		$result = mysqli_query($db,$query);
                                    		$i=0;

                                    		while($row = mysqli_fetch_assoc($result)){
                                                $post_id        = $row['post_id'];
                                    			$post_title     = $row['post_title'];
                                    			$post_des       = $row['post_des'];
                                    			$post_date      = $row['post_date'];
                                    			$post_thumbnail = $row['post_thumbnail'];
                                    			$user_id        = $row['user_id'];
                                                $post_status    = $row['post_status'];
                                    			$cat_id2        = $row['cat_id'];
                                    			$i++;
                                    		?>
                                    		<tr>
	                                            <td><?php echo $i;?></td>
	                                            <td>
                                                    <img src="img/post/<?php echo $post_thumbnail;?>"width="60px">

                                                </td>
	                                            <td>

                                                    <?php 
                                                        $query1 = "SELECT cat_name FROM category WHERE cat_id='$cat_id2'";
                                                        $result1 = mysqli_query($db,$query1);
                                                        while ($row = mysqli_fetch_array($result1)) {
                                                            $cat_tittle = $row['cat_name'];

                                                            echo "$cat_tittle";

                                                        }

                                                    ?>
                                                        
                                                </td>
	                                            <td><?php echo $post_title;?></td>
	                                            <td><?php echo substr($post_des,0,100);?></td>
	                                            <td><?php echo $post_date;?></td>
	                                            <td>
                                                    
                                                    <?php 
                                                        $query3 = "SELECT username FROM users WHERE user_id='$user_id'";
                                                        $result3 = mysqli_query($db,$query3);
                                                        while ($row = mysqli_fetch_array($result3)) {
                                                            $username = $row['username'];

                                                            echo "$username";
                                                            
                                                        }


                                                        

                                                    ?>
                                                        
                                                </td>
                                                <td>
                                                    <?php 

                                                        if ($post_status == 0) {
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
                                               
	                                            
                                            	<td class="cat-action">
													<ul>
													<a href="update_post.php?edit_id=<?php echo "$post_id"?>"><i class="fas fa-pen"></i></a>
													<a href="post.php?delete_post=<?php echo "$post_id" ?>"><i class="fas fa-trash-alt"></i></a>
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
    <!-- /.container-fluid -->

    <!--delete post code--->
    <?php 
        if (isset($_GET['delete_post'])){
            $del_id = $_GET['delete_post'];
            $table ='post'; $table_id='post_id'; $redirect_page='post.php';

            //delete the file
            "SELECT post_thumbnail FROM post WHERE post_id = '$del_id;";
            $result = mysqli_query($db,$query);

            while ($row = mysqli_fetch_assoc($result)) {
                $del_img = $row['post_thumbnail'];

            }
            unlink("img/post/".$del_img);

            delete($del_id,$table,$table_id,$redirect_page);
        }
    ?>
</div>
<!-- End of Main Content -->
<?php
include("inc/footer.php");
?>
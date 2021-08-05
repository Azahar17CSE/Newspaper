 <div class="sidebar">
                            <div class="widget">
                                <h2 class="widget-title">Recent Posts</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">

                                        <!-- siderbar dynamic -->
                                        <?php 
                                            $query = "SELECT * FROM post WHERE post_status = 1 ORDER BY post_id DESC LIMIT 3";

                                            $result = mysqli_query($db,$query);
                                            $count = 0;
                                            while($row = mysqli_fetch_assoc($result)){
                                                $post_id        = $row['post_id'];
                                                $post_title     = $row['post_title'];
                                                $post_des       = $row['post_des'];
                                                $post_date      = $row['post_date'];
                                                $post_thumbnail = $row['post_thumbnail'];
                                                $user_id        = $row['user_id'];
                                                $post_status    = $row['post_status'];
                                            ?>
                                                <a href="single.php?p_id=<?php echo $post_id; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                                    <div class="w-100 justify-content-between">
                                                        <img src="admin/img/post/<?php echo "$post_thumbnail"; ?>" alt="" class="img-fluid float-left">
                                                        <h5 class="mb-1"><?php echo "$post_title"; ?></h5>
                                                        <small><?php echo "$post_date"; ?></small>
                                                    </div>
                                                </a>
                                            <?php
                                            }
                                        ?>
                                       
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->

                           <!--  <div id="" class="widget">
                                <h2 class="widget-title">Advertising</h2>
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="upload/banner_03.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="widget">
                                <h2 class="widget-title">Instagram Feed</h2>
                                <div class="instagram-wrapper clearfix">
                                    <a class="" href="#"><img src="upload/small_09.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/small_01.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/small_02.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/small_03.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/small_04.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/small_05.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/small_06.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/small_07.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/small_08.jpg" alt="" class="img-fluid"></a>
                                </div>
                            </div> -->
                            <div class="widget">
                                <h2 class="widget-title">Popular Categories</h2>
                                <div class="link-widget">
                                    <ul>
                                        <!-- show category front page -->
                                        <?php 
                                            $query ="SELECT * FROM category ORDER BY cat_name ASC";
                                            $result =mysqli_query($db,$query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $cat_id = $row['cat_id'];
                                                $cat_name = $row['cat_name'];
                                                $cat_description = $row['cat_description'];

                                            $query2 ="SELECT * FROM post WHERE cat_id ='$cat_id'";
                                            $result2 =mysqli_query($db,$query2);
                                            $count = mysqli_num_rows($result2);
                                            ?>
                                                <li><a href="#"><?php echo "$cat_name"; ?><span>(<?php echo "$count"; ?>)</span></a></li>
                                            <?php 
                                            }
                                        ?>
                                        
                                    </ul>
                                </div><!-- end link-widget -->
                            </div><!-- end widget -->

                             <div class="widget">
                                <h2 class="widget-title">Popular Posts</h2>
                                <div class="link-widget">
                                    <ul>
                                        <!-- show category front page -->
                                        <?php 
                                            $query ="SELECT * FROM category ORDER BY cat_name ASC";
                                            $result =mysqli_query($db,$query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $cat_id = $row['cat_id'];
                                                $cat_name = $row['cat_name'];
                                                $cat_description = $row['cat_description'];

                                            $query2 ="SELECT * FROM post WHERE cat_id ='$cat_id'";
                                            $result2 =mysqli_query($db,$query2);
                                            $count = mysqli_num_rows($result2);
                                            ?>
                                                <li><a href="#"><?php echo "$cat_name"; ?><span>(<?php echo "$count"; ?>)</span></a></li>
                                            <?php 
                                            }
                                        ?>
                                        
                                    </ul>
                                </div><!-- end link-widget -->
                            </div><!-- end widget -->
                        </div><!-- end sidebar -->
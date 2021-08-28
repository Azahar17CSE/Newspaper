<!-- header section -->
<?php
  include "includes/header.php";
?>
        <section id="cta" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 align-self-center">
                        <h2>A Digital Online Newspaper Website</h2>
                        <p class="lead"> Aenean ut hendrerit nibh. Duis non nibh id tortor consequat cursus at mattis felis. Praesent sed lectus et neque auctor dapibus in non velit. Donec faucibus odio semper risus rhoncus rutrum. Integer et ornare mauris.</p>
                        <a href="#" class="btn btn-primary">Try for free</a>
                    </div>
                 
                </div>
            </div>
        </section>

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-custom-build">
                                <!-- read all post -->
                                <?php

                                  if (isset($_GET['id'])) {
                                      $catname = $_GET['id'];

                                      $catSelectID = "SELECT * FROM category WHERE cat_name = '$catname'";

                                      $catresult = mysqli_query($db,$catSelectID);


                                      while ( $row = mysqli_fetch_assoc($catresult))
                                      {

                                                     $cat_id            = $row['cat_id'];
                                                     $cat_name          = $row['cat_name'];
                                                     $cat_des           = $row['cat_description'];
                                                     // $parent_id         = $row['parent_id'];
                                                     // $status            = $row['status'];
                                          
                                      }      


                                  $query = "SELECT * FROM post WHERE cat_id = '$cat_id' ORDER BY post_id DESC ";
                                  $result =mysqli_query($db,$query);

                                  $count = mysqli_num_rows($result);

                                  if( $count <= 0 )
                                  {
                                  echo '<div class="alert alert-info"> OPPSS!! No post Found Yet..</div>';
                                  }

                                  else
                                  {

                                  while($row = mysqli_fetch_assoc($result)){
                                    $post_id        = $row['post_id'];
                                    $post_title     = $row['post_title'];
                                    $post_des       = $row['post_des'];
                                    $post_date      = $row['post_date'];
                                    $post_thumbnail = $row['post_thumbnail'];
                                    $user_id        = $row['user_id'];
                                    $post_status    = $row['post_status'];
                                    $cat_id2        = $row['cat_id'];
                                    ?>
                                        <div class="blog-box wow fadeIn">
                                          <div class="post-media">
                                              <a href="single.php?p_id=<?php echo $post_id; ?>" title="">
                                                  <img src="admin/img/post/<?php echo "$post_thumbnail"; ?>" alt="" class="img-fluid">
                                                  <div class="hovereffect">
                                                      <span></span>
                                                  </div>
                                                  <!-- end hover -->
                                              </a>
                                          </div>
                                          <!-- end media -->
                                          <div class="blog-meta big-meta text-center">

                                             <!--  <div class="post-sharing">
                                                  <ul class="list-inline">
                                                      <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                                      <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                                      <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                                  </ul>
                                              </div> -->

                                              <h4><a href="marketing-single.html" title=""><?php echo "$post_title"; ?></a></h4>
                                              <p><?php echo substr($post_des, 0, 300); ?>
                                                <a href="single.php?p_id=<?php echo $post_id; ?>">Read More....</a>
                                              </p>
                                              <small><a href="marketing-category.html" title="">

                                                 <?php 
                                                        $query1 = "SELECT cat_name FROM category WHERE cat_id='$cat_id2'";
                                                        $result1 = mysqli_query($db,$query1);
                                                        while ($row = mysqli_fetch_array($result1)) {
                                                            $cat_tittle = $row['cat_name'];

                                                            echo "$cat_tittle";

                                                        }

                                                    ?>
                                              </a></small>
                                              <small><a href="marketing-single.html" title="">
                                                <?php echo "$post_date"; ?>
                                                
                                              </a></small>
                                              <small><a href="#" title="">By
                                                 <?php 
                                                        $query3 = "SELECT username FROM users WHERE user_id='$user_id'";
                                                        $result3 = mysqli_query($db,$query3);
                                                        while ($row = mysqli_fetch_array($result3)) {
                                                            $username = $row['username'];

                                                            echo "$username";

                                                            
                                                        }  

                                                    ?>
                                                </a></small>
                                              <small><a href="#" title=""><i class="fa fa-eye"></i> 2291</a></small>
                                          </div><!-- end meta -->
                                      </div><!-- end blog-box -->

                                      <hr class="invis">
                                    <?php
                                  }
                                 
                                  }
                                }
                                ?>

                                
                            </div>
                        </div>

                        <hr class="invis">

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                       <!-- sidebar section connect to sidebar.php -->
                       <?php 
                        include "includes/sidebar.php";
                       ?>

                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

<!-- footer section -->
<?php
  include "includes/footer.php";
?>

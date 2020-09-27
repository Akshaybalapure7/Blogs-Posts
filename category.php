 <?php

  include "include/db.php";
  include "include/header.php";

?>
    <!-- Navigation -->
   
<?php

  include "include/navigation.php";

?>




<?php

if(isset($_GET['category']))
                {
                    $the_post_id=$_GET['category'];
                }
                
                 $query="SELECT * FROM posts WHERE  post_category_id ='$the_post_id'";
                 $query=mysqli_query($connection ,$query) or die("Query Failed" .mysqli_error($connection));
                  



?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php
                
               
                  while($row=mysqli_fetch_array($query))
                    {
                         $post_id=$row['post_id'];
                         $post_title=$row['post_title'];
                         $post_author=$row['post_author'];
                         $post_date=$row['post_date'];
                         $post_img=$row['post_img'];
                         $post_content=  substr($row['post_content'],0,100);
                    ?>
                       
                        <h1 class="page-header">
                              Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        
                       <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                        </h2>
                        
                           <p class="lead">
                            by <a href="author.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                        </p>
                        
                        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                        <hr>
                        
                        <img class="img-responsive" style='height:250px; width:600px;' src="Images/<?php echo $post_img; ?>" alt="">
                        <hr>
                        
                        <p> <?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                       
                        
                         
        <?php }  ?>
                

               
            </div>

            <!-- Blog Sidebar Widgets Column -->
                <?php include "include/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "include/footer.php"; ?>
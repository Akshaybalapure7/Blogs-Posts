 <?php include "includes/header.php" ?>

    <div id="wrapper">
    
<?php
  $session=session_id();  
  $time=time();
  $time_out_in_seconds=60;
  $time_out=$time - $time_out_in_seconds;

   $query="SELECT * FROM users_online WHERE session = '$session'";
   $send_query=mysqli_query($connection , $query);  
   $count= mysqli_num_rows($send_query) ;
    echo $count;

   if($count == NULL){
       mysqli_query($connection , "INSERT INTO users_online(session , time)  VALUES ($session , $time) ");
   }
   else{
       mysqli_query($connection , " UPDATE users_online SET time ='$time' WHERE session = '$session'");
   }
   $users_online_query= mysqli_query($connection,"SELECT * FROM users_online WHERE time > '$time'");
   
   $users_count= mysqli_num_rows($users_online_query);
 
  ?>
           
        <!-- Navigation -->
       <?php include "includes/navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin 
                            <small><?php  echo $_SESSION['firstname'];?></small>
                       
                             <?php// echo $users_count; ?>
                         
                           </h1>
                         
                           
                         
                        
                    </div>
                </div>
     <!-- /.row -->

                     
     <!-- /.row -->
                
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
        <?php 
                                 
           $query="SELECT * FROM posts";
           $post_query=mysqli_query($connection , $query);
           $post_count=mysqli_num_rows($post_query);
           
           echo "<div class='huge'>{$post_count}</div>"                     
       ?>
                                          
                                   
                 
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            
<?php 
                                 
           $query="SELECT * FROM comments";
           $comment_query=mysqli_query($connection , $query);
           $comment_count=mysqli_num_rows($comment_query);
           
           echo "<div class='huge'>{$comment_count}</div>"                     
 ?>  
                            
                            
                              <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            
                                                        
<?php 
                                 
           $query="SELECT * FROM users";
           $user_query=mysqli_query($connection , $query);
           $user_count=mysqli_num_rows($user_query);
           
           echo "<div class='huge'>{$user_count}</div>"                     
 ?>  
                            
                            
                            
                             
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                               
                                                        
<?php 
                                 
           $query="SELECT * FROM categories";
           $category_query=mysqli_query($connection , $query);
           $category_count=mysqli_num_rows($category_query);
           
           echo "<div class='huge'>{$category_count}</div>"                     
 ?>     
                               
                                 <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="category.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
         <!-- /.row -->
           
<?php 
                                 
           $query="SELECT * FROM posts WHERE post_status='draft'";
           $select_all_draft_posts=mysqli_query($connection , $query);
           $draft_post_count= mysqli_num_rows($select_all_draft_posts);
           
          /* $query="SELECT * FROM comments WHERE comment_status=uapproved";
           $unapproved_comments=mysqli_query($connection , $query);
           $unapproved_comment_count= mysqli_num_rows($unapproved_comments);
            
           $query="SELECT * FROM users WHERE user_role= Subscriber";
           $subscriber=mysqli_query($connection , $query);
           $subscriber_count= mysqli_num_rows($subscriber);*/
                                
 ?>
           
           
           
           
           <div class="row">
               
            <script type="text/javascript">
                  google.charts.load('current', {'packages':['bar']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Data', 'Count'  ],
                       
                         <?php 
                                $element_text=['Active posts','Draft Post',   'comments','users','category'];
                                $element_count=[$post_count ,$draft_post_count, $comment_count, $user_count ,  $category_count];

                                for($i=0;$i<5;$i++)
                                {
                                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}] ,";
                                }

                        ?>
                        
                     // ['Posts', 1000 ],
                       
                    ]);

                    var options = {
                      chart: {
                        title: ' ',
                        subtitle: ' ',
                      }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                  }
            </script>
            <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
         </div>

           
           
           
           
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
   <!-- /#wrapper -->
   <?php include "includes/footer.php" ?>

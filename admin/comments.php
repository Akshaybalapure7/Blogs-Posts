<?php include "includes/header.php" ?>

    <div id="wrapper">
           
        <!-- Navigation -->
       <?php include "includes/navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">
                            Welcome to admin 
                            <small><?php echo $_SESSION['username'];?></small>
                      </h1>

                      <?php
                        
                            if(isset($_GET['sourse']))
                            {
                                $sourse= $_GET['sourse'];
                                
                            }
                            else{
                               $sourse=''; 
                            }

                            switch($sourse){
                                    case "add_post";
                                    include "includes/add_post.php";
                                    break;
                                    
                                    case "edit_post";
                                    include "includes/edit_post.php";
                                    break;
                                    
                                    case 200;
                                    echo "NICE 200";
                                    break;
                                    
                                    default:
                                       include "includes/view_all_comments.php";
                                       break;
                            }
    
                       ?>
                      
                      

                    </div>
             </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
   <!-- /#wrapper -->
   <?php include "includes/footer.php" ?>

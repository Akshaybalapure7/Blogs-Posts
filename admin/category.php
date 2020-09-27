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
                        
                        <div class="col-xs-6">
                           
                           <?php 
                            
                             insert_categories();
                            
                            ?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <lable for="cat_title">Add Category</lable>
                                    <input type="text" class="form-control " name="cat_title" >
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                                </div>
                                                  
                            </form>
                             <?php 
                                 
                               if(isset($_GET['edit']))
                                 {
                                     $cat_id=$_GET['edit'];
                                     include "includes/update_category.php";
                                 }

                            ?>
                            
                        </div>
                        <div class="col-xs-6">
                               
                                <table class="table table-bordered table-hover">
                                    <thead>
                                       <tr>
                                            <th>ID</th>
                                            <th>Category Title</th>
                                            <th>Delete</th>
                                            <th>Edit</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                 <?php   
                                        // Find all categories
                                        
                                         findAllcategories();
                                        ?> 
                                        
                                        <?php // Delete query
                                              deleteCategories();
                                        ?>
                                       
                                    </tbody>
                                </table>
                        </div>

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

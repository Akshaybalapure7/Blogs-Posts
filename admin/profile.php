<?php include "includes/header.php" ?>
<?php
    
    if(isset($_SESSION['username']))
         {
             $username=$_SESSION['username'];
             
             $query="SELECT * FROM users WHERE username='$username'";
             $select_user_profile_query=mysqli_query($connection,$query);
             while($row=mysqli_fetch_assoc($select_user_profile_query))
             {
                 $user_firstname=$row['user_firstname'];
                 $user_lastname=$row['user_lastname'];
                 $user_role=$row['user_role'];
                 $username=$row['username'];
                 $user_email=$row['user_email'];

    //              $post_Image=$_FILES['image']['name'];
    //              $post_Image_Tmp=$_FILES['image']['tmp_name'];
        

                // $user_password=$row['user_password'];
             }
         }
?>    
<?php 
 
       
        if(isset($_POST['update_profile'])){
           
            $user_firstname=escape($_POST['user_firstname']);
            $user_lastname= escape($_POST['user_lastname']);
            $user_name= escape($_POST['username']);
            $user_role=escape($_POST['user_role']);    
            $user_email=escape($_POST['user_email']);
           // $user_password=escape($_POST['user_password']);
            
            $query=" UPDATE users SET user_firstname='$user_firstname', user_lastname='$user_lastname', username='$user_name' , user_role='$user_role' WHERE username='$username'";
            
            $select_user_profile=mysqli_query($connection , $query);
            if(!$select_user_profile)
            {
                die("Query Failed" . mysqli_error($connection));
            }
            else{
                echo "Query Update Successfully";
                    }
        }

?>    
    
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
                            <small>Author</small>
                      </h1>

<form action=""  method="POST" enctype="multipart/form-data">
   
            <div class="form-group">
                 <label for="firstname">First Name</label>
                 <input  value=<?php echo $user_firstname; ?> type="text" class="form-control" name="user_firstname">
             </div>


             <div class="form-group">
                 <label for="lastname">Last Name</label>
                 <input  value=<?php echo $user_lastname; ?> type="text" class="form-control" name="user_lastname">
             </div>


             <div class="form-group">
                 <label for="user_role">User role</label>
                 <select name="user_role"  class="form-control">
                     <option value="admin"><?php echo $user_role; ?></option>
                    <?php 
                         if($user_role=="Admin")
                         {
                               echo "<option value='Subscriber'>Subscriber</option>";
                         }
                         else {
                               echo  "<option value='Admin'>Admin</option>";
                         }


                     ?>

                 </select>
             </div>


             <div class="form-group">
                 <label for="Username">Username</label>
                 <input value=<?php echo $username; ?> type="text" class="form-control" name="username">
             </div>


             <div class="form-group">
                 <label for="Email">Email</label>
                 <input value=<?php echo $user_email; ?> type="email" class="form-control" name="user_email">
             </div>

          <!--    <div class="form-group">
                 <label for="Passsword">Password</label>
                  <input value=<?php //echo $user_password; ?> type="password" class="form-control" name="user_password">
             </div> -->

             <div class="form-group">
                 <input type="submit" class="btn btn-primary" name="update_profile" value="Update profile">
             </div>

    
</form>
                      
                      

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

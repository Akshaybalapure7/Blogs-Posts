 <?php
      if(isset($_GET['edit_user']))
      {
           $the_user_id=$_GET['edit_user'];
          
           $query="SELECT * FROM users WHERE user_id=$the_user_id";
                              $select_users_query= mysqli_query($connection , $query);
                              while($row = mysqli_fetch_assoc( $select_users_query))
                              {
                                $user_id=$row['user_id'];
                                $username=$row['username'];
                                $user_password=$row['user_password'];
                                $user_firstname=$row['user_firstname'];
                                $user_lastname=$row['user_lastname'];
                                $user_email=$row['user_email'];
                                $user_image=$row['user_image'];
                                $user_role=$row['user_role'];
                              }
                                
      }







        if(isset($_POST['edit_user']))
        {
             $user_firstname=escape($_POST['user_firstname']);
             $user_lastname=escape($_POST['user_lastname']);
             $user_role=escape($_POST['user_role']);
             $username=escape($_POST['username']);
             $user_email=escape($_POST['user_email']);
             //$user_password=escape($_POST['user_password']);

//              $post_Image=$_FILES['image']['name'];
//              $post_Image_Tmp=$_FILES['image']['tmp_name'];
            

            $query="SELECT randsalt FROM users";
            $the_randsalt_query=mysqli_query($connection, $query);
            if(!$the_randsalt_query){
                die("Query Failed". mysqli_error($connection));
            }
            
            // $row=mysqli_fetch_array($the_randsalt_query);
            // $salt=$row['randsalt'];
            // $hashed_password=crypt($user_password , $salt);
                           
              $query="UPDATE users SET user_firstname='$user_firstname', user_lastname='$user_lastname', user_role='$user_role', username='$username', user_email='$user_email'  WHERE user_id=' $the_user_id' ";
              
              $user_edit_query = mysqli_query($connection, $query);
            
              if(!$user_edit_query){
                  die(" <h4>Query Failed</h4> " . mysqli_error($connection));
              }
              else{
                  echo "<h5>Update Query Successfully</h5>";
              }
              
              
        }

?>






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
             <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
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
     
     <!-- <div class="form-group">
         <label for="Passsword">Password</label>
          <input value=<?php //echo $user_password; ?> type="password" class="form-control" name="user_password">
     </div> -->
     
     <div class="form-group">
         <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
     </div>
 
    
</form>
 <?php

        if(isset($_POST['creat_user']))
        {
             $user_firstname=escape($_POST['user_firstname']);
             $user_lastname=escape($_POST['user_lastname']);
             $user_role=escape($_POST['user_role']);
             $username=escape($_POST['username']);
             $user_email=escape($_POST['user_email']);
            
//              $post_Image=$_FILES['image']['name'];
//              $post_Image_Tmp=$_FILES['image']['tmp_name'];
//              
             
              $user_password=$_POST['user_password'];
              
              $user_password= password_hash($user_password , PASSWORD_BCRYPT, array('cost'=>12));  
            
            $query="INSERT INTO users (user_firstname, user_lastname , user_role , username, user_email , user_password  ) VALUES (' $user_firstname','  $user_lastname',' $user_role ', ' $username',' $user_email',' $user_password')";
            
            $add_user=mysqli_query($connection , $query);
            
            if(!$add_user){
                die("query Failed" . mysqli_error($connection));
            }
            else{
                echo "Add user successfully";
            }
 
        }

?>






<form action=""  method="POST" enctype="multipart/form-data">
   
    <div class="form-group">
         <label for="firstname">First Name</label>
         <input  type="text" class="form-control" name="user_firstname">
     </div>
     
      
     <div class="form-group">
         <label for="lastname">Last Name</label>
         <input  type="text" class="form-control" name="user_lastname">
     </div>
     
       
     <div class="form-group">
         <label for="user_role">User role</label>
         <select name="user_role"  class="form-control">
             <option value="admin">Select Option</option>
              <option value="admin">Admin</option>
             <option value="subscriber">subscriber</option>
         </select>
     </div>
     
     
     <div class="form-group">
         <label for="Username">Username</label>
         <input  type="text" class="form-control" name="username">
     </div>
    
     
     <div class="form-group">
         <label for="Email">Email</label>
         <input  type="email" class="form-control" name="user_email">
     </div>
     
     <div class="form-group">
         <label for="Passsword">Password</label>
          <input  type="password" class="form-control" name="user_password">
     </div>
     
     <div class="form-group">
         <input type="submit" class="btn btn-primary" name="creat_user" value="Add User">
     </div>
 
    
</form>
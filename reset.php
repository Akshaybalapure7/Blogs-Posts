
<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>

<?php include "include/navigation.php";?>

<?php

   if(isset($_POST['recover_password']))
   {
          $username=$_POST['username'];
          $new_password=$_POST['n_password'];
          $confirm_password=$_POST['c_password'];

          if($username!='' && $new_password!='' && $confirm_password!=''){
                  
                
                
                if($new_password===$confirm_password){
                  $new_password= password_hash($new_password , PASSWORD_BCRYPT, array('cost'=>12));
                  $query= "UPDATE users SET user_password='$new_password' WHERE username='$username'";
                  $query=mysqli_query($connection,$query);
                  if(!$query){
                    die("<p class=bg-danger text-center>Query Failed unable to update the password</p>" . mysqli_error($connection));
                  }
                  else{
                    echo "<h5 class='text-center bg-success'>Password reset sucessfully"."<a href='Login.php'>Go For Login</a></h5>";
                  }
                }else{
                  echo "<h5 class='text-center bg-danger'>Password is not matching<h5>";
                }

          }else{
            echo "<h5 class='text-center bg-danger'>This field shold not be empty</h5>";
          }
   }


?>



<!-- Page Content -->
  <div class="container">
      <div class="form-gap">
          <div class="container">
              <div class='row' >
                 <div class="col-md-4 col-md-offset-4" >
                    <div class="panel panel default" style="border:20px solid grey; border-radius: 15px;">
                          <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Resest Password?</h2>
                             <p>You can reset your password here.</p>

                             <div class="panel-body">
                                 <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                          <div>
                                            <label for="username">Username</label>
                                             <div class="input-group">
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                                <input id="username" name="username" placeholder="Username" class="form-control"  type="text">
                                            </div>

                                          </div>
                                          <div>
                                            <label for='new_password'>New Password</label>
                                           <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                                <input id="password" name="n_password" placeholder="Enter new password" class="form-control"  type="password">
                                            </div>
                                           </div>
                                          
                                           <div>
                                            <label for='new_password'>Confirm Password</label>
                                            <div class="input-group">
                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                                <input id="password" name="c_password" placeholder="Confirm your password" class="form-control"  type="password">
                                            </div>
                                           </div> 
                                        </div>
                                        <div class="form-group">
                                            <input name="recover_password" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>
                                    </form>
                             </div>
                          </div>   
                    </div>
                 </div>  
             </div>
          </div>
      </div>
  </div>

 
    <hr>

    <?php include "include/footer.php";?>

</div> <!-- /.container -->



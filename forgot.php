
<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>



<?php

   if(isset($_POST['recover_password']))
   {
        $username=$_POST['username'];
        $recovery_email=$_POST['email'];
        if($username!='' && $recovery_email!='' )
          {  
                $query= "SELECT user_email FROM users WHERE username='$username' ";
                $query=mysqli_query($connection,$query);
                 if(!$query)
                 {
                     die('Username not found'.mysqli_error($connection));
                 }

                 $row=mysqli_fetch_array($query);
                 $db_email= $row['user_email'];
                   
                 if($db_email==$recovery_email)
                 {
                    redirect('reset.php');
                 }
                 else{
                    echo "Please enter proper email ID";
                 }
          }else{
            echo "<p class='text-center bg-danger'>This field shoud not be empty</p>";
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
                            <h2 class="text-center">Forgot Password?</h2>
                             <p>You can reset your password here.</p>

                             <div class="panel-body">
                                 <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                           
                                           <div class="input-group">
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                                <input id="username" name="username" placeholder="Username" class="form-control"  type="text">
                                            </div>


                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
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



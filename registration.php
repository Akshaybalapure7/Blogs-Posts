


<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>
 

<?php
$message='';
if(isset($_POST['submit']))
{

         $fname=trim($_POST['fname']);
         $lname=trim($_POST['lname']); 
         $username= trim($_POST['username']);
         $email=trim($_POST['email']);
         $password= trim($_POST['password']);
        
       
        $error = [ 
    
              'fname' => '',
              
              'lname' => '',

              'username' =>'',

               'email' =>'',

               'password' =>''
            
            ];

      /* Validation for First_name*/
     
      
         if($fname== ''){

          $error['fname']=" Name can not be empty";   
        }


      /* Validation for Last_name*/
     
      
         if($lname== ''){

          $error['lname']=" can not be empty";   
        }



        /* Validationn for username*/
        
        if( strlen($username) < 0)
        {
            $error['username']="user name needs to be longer";
        }
        
        if($username == '')
        {

          $error['username']="username can not be empty"   ;
        }
        
         if(username_exists($username)){

            $error['username']="username alerady exists choose another one";   
        
        }

         
        
       /* Validation for a email ID*/

         if($email== ''){

          $error['email']="email can not be empty";   
        }
        
         if(email_exists($email)){

            $error['email']="email alerady exists <a href='index.php'>Please Login</a>";   
        
        }



      /* Validation for a email ID*/

         if($password== ''){

          $error['password']=" Password can not be empty";   
        }

       
        foreach($error as $key => $value)
        {
            if(empty($value))
            {
              
              unset($error[$key]);
            }
        }
        

        if(empty($error)){
           
            register_user($fname,$lname,$username , $email , $password);

            user_login($username, $password);
        }
   
}



?>
    
    
    
    

    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                   <?php echo "<h5 class='text-center'>$message</h5>" ?>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        
                       <div class="form-group">
                            <label for="fname" class="sr-only">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter Your First name" autocomplete="on" value="<?php echo isset($fname) ? $fname : ''; ?>">
                        
                             <p><?php echo isset($error['fname']) ? $error['fname'] : ''; ?> </p>

                        </div>

                        
                       <div class="form-group">
                            <label for="lname" class="sr-only">Last Name</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter your Last name" autocomplete="on" value="<?php echo isset($lname) ? $lname : ''; ?>">
                        
                             <p><?php echo isset($error['lname']) ? $error['lname'] : ''; ?> </p>

                        </div>  



                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($username) ? $username : ''; ?>">
                        
                             <p><?php echo isset($error['username']) ? $error['username'] : ''; ?> </p>

                        </div>

                      
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"   autocomplete="on" value="<?php echo isset($email) ? $email : ''; ?>">
                      
                             <p><?php echo isset($error['email']) ? $error['email'] : ''; ?> </p>

                        </div>
                       
                         
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                         
                            <p><?php echo isset($error['password']) ? $error['password'] : ''; ?> </p> 
                       
                        </div>

                         
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>

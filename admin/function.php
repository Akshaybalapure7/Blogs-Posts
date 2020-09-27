
<?php





function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection , trim($string));
}




function insert_categories()
{
    
     global $connection;
     if(isset($_POST['submit']))
         {
            $cat_title=$_POST['cat_title'];
                                  
             if($cat_title="" || empty($cat_title))
                {
                     echo "This field should not be empty";
                }
            else{
                    $query="INSERT INTO categories(cat_title) VALUE ('{$_POST['cat_title']}')";
                    $add=mysqli_query($connection,$query);

                    if(!$add){
                        die("Query Failed". mysqli_error($connection));
                    }
                }
         }
}


function findAllcategories(){
    
      global $connection;
      $query="SELECT * FROM categories";
      $select_all_caterories_query=mysqli_query($connection,$query);
                    
       while($row = mysqli_fetch_assoc($select_all_caterories_query))
        {
            $cat_id=$row['cat_id'];
            $cat_title=$row['cat_title'];
            echo "<tr>";
            echo " <td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            


        
  
            echo "<td><a  onClick=\" javascript:return confirm('Are you sure you want to delete'); \" class='btn btn-danger' href='category.php?delete={$cat_id}'>Delete</td>";
            echo "<td><a class='btn btn-info' href='category.php?edit={$cat_id}'>Edit</td>";
            echo "</tr>";
        }
} 

function deleteCategories(){
    global $connection;
     if(isset($_GET['delete']))
     {
       if($_SESSION['user_role']=='Admin')
        
         {
            $The_cat_id=$_GET['delete'];
            $query="DELETE FROM categories WHERE cat_id={$The_cat_id} ";
            $delete_query = mysqli_query($connection , $query);
            header("Location:category.php");// For refreshing the page
         }

       }
}


function is_admin($username= ''){
    global $connection;
    $query="SELECT user_role FROM users WHERE username = '$username' ";
    $result=mysqli_query($connection, $query);
    if(!$result){
      die("Query Failed".mysqli_error($connection));
    }
      $row=mysqli_fetch_array($result);
        
        if($row['user_role']=='Admin'){
            return true;
        }
        else{
            return false;
        }
      
    
}

function username_exists($username){
    global $connection;
     $query="SELECT username FROM users WHERE username = '$username' ";
     $result=mysqli_query($connection , $query);
     if(!$result){
         die("Query Failed". mysqli_error($connection));
     }
     if(mysqli_num_rows($result)>0)
     {
         return true;
     }
    else
    {
        return false;
    }
    
}


function email_exists($email){
    global $connection;
     $query="SELECT user_email FROM users WHERE user_email = '$email' ";
     $result=mysqli_query($connection , $query);
     if(!$result){
         die("Query Failed". mysqli_error($connection));
     }
     if(mysqli_num_rows($result)>0)
     {
         return true;
     }
    else
    {
        return false;
    }
    
}

function redirect($location){

     header("Location:" . $location);
     exit;
}


function IfItIsMethod($method = null){
  
     if($_SERVER['REQUEST_METHOD']== strtoupper($method)){
        return true;
     }
     else{
        return false;
     }


}


function isLoggedIn(){

    if (isset($_SESSION['user_role'])){
       
       return true;
    }
    else{
        return false;
    }
}

 function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
 }


function register_user($fname,$lname,$username , $email ,$password )

{
                global $connection; 
                 $fname=mysqli_real_escape_string($connection , $fname);
                $lname=mysqli_real_escape_string($connection , $lname);            
                $username=mysqli_real_escape_string($connection , $username);
                $email=mysqli_real_escape_string($connection , $email);
                $password=mysqli_real_escape_string($connection , $password);
                    
                
                $password= password_hash($password , PASSWORD_BCRYPT, array('cost'=>12));        
            
         
                
                $query="INSERT INTO users ( user_firstname , user_lastname, username , user_email , user_password , user_role) ";
                $query .="VALUES ('$fname', '$lname' , '$username' , '$email','$password','Subscriber')";
            
                 $registration_query=mysqli_query($connection , $query);
            
                if(!$registration_query)
                {
                    die(" Query Failed " . mysqli_error($connection));
                }    
                else{
                    echo "<p class='text-center bg-success'>Register Successfully</p>";
                }   
    
}


function user_login($username, $password)

{ 
       global $connection;   
       $username= trim($username);
       $password= trim( $password);
      
     
       $username= mysqli_real_escape_string($connection ,$username);/*for cleaning and make secure database from hacker*/
       $password= mysqli_real_escape_string($connection ,$password);/*for cleaning and make secure database from hacker*/
       
       $query="SELECT * FROM users WHERE username='$username'";
       $select_user_query=mysqli_query($connection , $query);
       
        if(! $select_user_query)
        {
            die("Query Failed" . mysqli_error($connection));
        }
       
        while($row=mysqli_fetch_array( $select_user_query))
        {
             $db_id=$row['user_id'];
             $db_username=$row['username'];
             $db_user_password=$row['user_password'];
             $db_user_firstname=$row['user_firstname'];
             $db_user_lastname=$row['user_lastname'];
             $db_user_email=$row['user_email'];
             $db_user_role=$row['user_role'];
        }
    
         
        if(password_verify($password , $db_user_password) )
        {
              $_SESSION['user_id']=$db_id;
              $_SESSION['username']=$db_username;
              $_SESSION['firstname']=$db_user_firstname;
              $_SESSION['lastname']=$db_user_lastname;
              $_SESSION['user_role']=$db_user_role;
            
           if($_SESSION['user_role']=='Admin'){
            redirect("/CMS/admin/index.php");
           }
           else
           {
            redirect("/CMS/admin/dashboard.php");
           }
            
             
        }
        else
        {
              //  redirect("/CMS/index.php");

              echo "<h4 class='text-center bg bg-danger'>Loged in failed</h4>";
        }
    


}






















?>
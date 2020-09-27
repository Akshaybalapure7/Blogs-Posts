                      <table class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Username</th>
                                  <th>Firstname</th>
                                  <th>Lastname</th>
                                  <th>Email</th>
                                  <th>Role</th>
                                  <th>Admin</th>
                                  <th>Subscriber</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                                 
                                   
                              </tr>
                          </thead>
                          <tbody>
                             
                             <?php 
                                
                              $query="SELECT * FROM users";
                              $select_users= mysqli_query($connection , $query);
                              while($row = mysqli_fetch_assoc( $select_users))
                              {
                                $user_id=$row['user_id'];
                                $username=$row['username'];
                                $user_password=$row['user_password'];
                                $user_firstname=$row['user_firstname'];
                                $user_lastname=$row['user_lastname'];
                                $user_email=$row['user_email'];
                                $user_image=$row['user_image'];
                                $user_role=$row['user_role'];
                                
                                echo "<tr>";
                                echo "<td>{$user_id}</td>";
                                echo "<td> {$username}</td>";
                                echo"<td>{$user_firstname}</td>";
                                echo "<td>{$user_lastname}</td>";
                                  

//                                 $query="SELECT * FROM categories WHERE cat_id={$post_id}";
//                                  $select_all_caterories_id=mysqli_query($connection,$query);
//
//                                  while($row = mysqli_fetch_assoc($select_all_caterories_id))
//                                  {
//                                    $cat_id=$row['cat_id'];
//                                    $cat_title=$row['cat_title'];
//
//                                     echo "<td>{$cat_title}</td>";
//                                  }

                                  
//                                echo "<td>{$comment_status}</td>";
//                                  
//                                  $query="SELECT * FROM posts WHERE post_id= $comment_post_id";
//                                  
//                                  $select_post_id_query=mysqli_query($connection, $query);
//                                  while($row=mysqli_fetch_assoc($select_post_id_query)){
//                                      $post_id=$row['post_id'];
//                                      $post_title=$row['post_title'];
//                                      
//                                      echo "<td><a href='../post.php?p_id=$post_id'> $post_title</a></td>";
//                                  }
                                  
                                 
                                  
                                  
                                  
                                  
                                  
                                echo "<td>$user_email</td>"; 
                                 echo "<td>$user_role</td>"; 
                                echo "<td><a href='users.php?To_admin=$user_id '> Admin</a></td>";
                                echo "<td><a href='users.php?To_sub=$user_id '> Subscriber</a></td>";
                                  
                                echo "<td><a class='btn btn-info' href='users.php?sourse=edit_user&edit_user= $user_id'>Edit</a></td>";
                               
                                ?>
                                
                                 <form method="POST">
                                   
                                     <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                                     <?php

                                    echo "<td><a onClick=\" javascript:return confirm('Are you sure you want to delete'); \"> <input type=submit class='btn btn-danger' name='delete' value=Delete></a></td>";
                    
                                     ?>
                                 </form> 





                                <?php

                              



                                echo "</tr>";  
                               
                              }
                              ?>
                             
                               
                          </tbody>
                      </table>
                      
                     <?php


                              if(isset($_GET['To_admin']))
                             {
                                 $the_user_id=$_GET['To_admin'];
                                 $query="UPDATE users SET user_role='Admin' WHERE user_id= $the_user_id ";
                                 $change_admin_query= mysqli_query($connection , $query);
                                 header("Location:users.php");
                             }
                             

                            if(isset($_GET['To_sub']))
                             {
                                 $the_user_id=$_GET['To_sub'];
                                $query="UPDATE users SET user_role='Sbscriber' WHERE user_id= $the_user_id ";
                                 $change_sub_query= mysqli_query($connection , $query);
                                 header("Location:users.php");
                             }

 


                            if(isset($_POST['user_id']))
                             {
                             // if(isset($_SESSION['user_role']))
                              //  {
                                 
                                     $the_user_id=$_POST['user_id'];
                                     $query="DELETE FROM users WHERE user_id= $the_user_id";
                                     $delete_query= mysqli_query($connection , $query)." ";
                                     header("Location:users.php");
                                 
                           // }
                        }
                      ?>
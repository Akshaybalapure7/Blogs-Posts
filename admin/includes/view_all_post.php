        <?php 
             if(isset($_POST['checkBoxArray']))
             {

 
                 foreach($_POST['checkBoxArray']as $checkBoxValue)
                 {
                    
                   $bulk_options= $_POST['bulk_options'];
                     switch( $bulk_options)
                     {
                         case "Publish":
                             $query=" UPDATE posts SET post_status='Publish' WHERE post_id =$checkBoxValue";
                             
                             $Publish_query=mysqli_query($connection, $query);
                            
                             if(!$Publish_query){
                              die("Query Failed". mysqli_erroe($connection));
                             }

                             break;
                             
                        case "Draft":
                             $query="UPDATE posts SET post_status='Draft' WHERE post_id =$checkBoxValue";
                             
                             $Draft_query=mysqli_query($connection, $query);

                            if(!$Draft_query)
                              {
                                die("Query Failed". mysqli_erroe($connection));
                              }

                             break;
                        
                         case "Delete":
                             $query="DELETE FROM posts WHERE post_id=$checkBoxValue ";
                             $Delete_query=mysqli_query($connection , $query);
                            
                             if(!$Delete_query)
                             {
                              die("Query Failed". mysqli_erroe($connection));
                             }

                             break;
                             
                         case "Clone" :
                             
                             $query="SELECT * FROM posts WHERE post_id=$checkBoxValue";
                             $colne_query=mysqli_query($connection , $query);
                             
                             while($row=mysqli_fetch_assoc($colne_query))
                                {
                                    $post_id=$row['post_id'];
                                    $post_author=$row['post_author'];
                                    $post_title=$row['post_title'];
                                    $post_category_id=$row['post_category_id'];
                                    $post_status=$row['post_status'];
                                    $post_img=$row['post_img'];
                                    $post_content=$row['post_content'];
                                    $post_tags=$row['post_tags'];
                                    $post_comment_count=$row['post_comment_count'];
                                    $post_date=$row['post_date'];
                                 }
                            
                             $query="INSERT INTO posts (post_category_id , post_title, post_author,post_date,post_img,post_content,post_tags,post_status) ";
                             $query .= "VALUES ($post_category_id, '$post_title', '$post_author',now(),'$post_img','$post_content','$post_tags','$post_status')";
                             
                             $clone_add_query=mysqli_query($connection,$query);
                             
                             if(!$clone_add_query)
                             {
                                 die("Query Failed" . mysqli_error($connection));
                             }
                             
                     }
                 }
             }
        ?>       
            
       
            
         
                        
         <form action='' method="post">     
             
              <div id="BulkOptionContainer" class="col-xs-4">
                     <select name="bulk_options" id="" class="form-control">
                          <option value="">select option</option>
                          <option value="Publish">Publish</option>
                          <option value="Draft">Draft</option>
                          <option value="Delete">Delete</option>
                          <option value="Clone">Clone</option>
                      </select>
                        
                    </div> 
                    <div class="col-xs-4">
                        <input type="submit" name="submit" class="btn btn-success" value="Apply">

                        <a class="btn btn-primary" href="posts.php?sourse=add_post">Add New</a>
                    </div>      
                   
                          
              <table class="table table-bordered table-hover">

                          <thead>
                              <tr>
                                  <th><input type="checkbox" id="selectAllBoxes" style="padding-left : 0px;"></th>
                                  <th>ID</th>
                                  <th>Author</th>
                                  <th>Title</th>
                                 <!--  <th>Category</th> -->
                                  <th>Status</th>
                                  <th>Image</th>
                                  <th>Tags</th>
                                  <th>Comment</th>
                                  <th>Date</th>
                                  <th>View</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                                   <th>Post_views</th>
                              </tr>
                          </thead>
                          <tbody>
                             
                             <?php 

                    if($_SESSION['user_role']=='Admin'){
                                
                              $query="SELECT * FROM posts ORDER BY post_id DESC";
                              $select_posts= mysqli_query($connection , $query);
                              while($row = mysqli_fetch_assoc($select_posts))
                              {
                                $post_id=$row['post_id'];
                                $post_author=$row['post_author'];
                                $post_title=$row['post_title'];
                                $post_category_id=$row['post_category_id'];
                                $post_status=$row['post_status'];
                                $post_img=$row['post_img'];
                                $post_tags=$row['post_tags'];
                                $post_comment_count=$row['post_comment_count'];
                                $post_date=$row['post_date'];
                                $post_views=$row['post_views_count'];
                                echo "<tr>";
                                ?>
                                
                                <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value='<?php echo $post_id ?>'></td>
                               
                                <?php
                                  
                                echo "<td>{$post_id}</td>";
                                echo "<td>{$post_author}</td>";
                                echo "<td>{$post_title}</td>";
                                  
                        
                             // $query="SELECT * FROM categories WHERE cat_id={$post_id}";
                             // $select_all_caterories_id=mysqli_query($connection,$query);
                             // while($row = mysqli_fetch_assoc($select_all_caterories_id))
                             // {
                             //    $cat_id=$row['cat_id'];
                             //    $cat_title=$row['cat_title'];

                             //    echo "<td value='{$cat_id}'>{$cat_title}</td>";
                             // }

                                 
                                echo "<td>{$post_status}</td>";
                                echo "<td><img width='100' src='../Images/{$post_img}' alt='Image'></td>";
                                echo "<td>{$post_tags}</td>";
                                  
                                
                                
                                  
                                echo "<td><a href='./comments.php'>{$post_comment_count}</a></td>";  
                                
                                  
                                  
                                echo "<td>{$post_date}</td>"; 

                                echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View</a></td>";

                                echo "<td><a class='btn btn-info' href='posts.php?sourse=edit_post&p_id={$post_id}'> Edit</a></td>";
                              

                               
                            
                                   
                                      // echo "<td><a onClick=\" javascript:return confirm('Are you sure you want to delete'); \"> <input type=submit class='btn btn-danger' name='delete' value=Delete></a></td>"
                        
    


                              
                                 echo "<td><a class='btn btn-danger' onClick=\" javascript:return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}'> Delete </a></td>";
                               




                                echo"<td ><a href='posts.php?reset={$post_id}'>$post_views<a></td>";
                                echo "</tr>";  
                               
                              }
                            }else{

                             
                               $user_id=$_SESSION['user_id'];

                              $query="SELECT * FROM posts  WHERE user_id='$user_id'";
                              $select_posts= mysqli_query($connection , $query);
                              while($row = mysqli_fetch_assoc($select_posts))
                              {
                                $post_id=$row['post_id'];
                                $post_author=$row['post_author'];
                                $post_title=$row['post_title'];
                                $post_category_id=$row['post_category_id'];
                                $post_status=$row['post_status'];
                                $post_img=$row['post_img'];
                                $post_tags=$row['post_tags'];
                                $post_comment_count=$row['post_comment_count'];
                                $post_date=$row['post_date'];
                                $post_views=$row['post_views_count'];
                                echo "<tr>";
                                ?>
                                
                                <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value='<?php echo $post_id ?>'></td>
                               
                                <?php
                                  
                                echo "<td>{$post_id}</td>";
                                echo "<td>{$post_author}</td>";
                                echo "<td>{$post_title}</td>";
                                  
                        
                             // $query="SELECT * FROM categories WHERE cat_id={$post_id}";
                             // $select_all_caterories_id=mysqli_query($connection,$query);
                             // while($row = mysqli_fetch_assoc($select_all_caterories_id))
                             // {
                             //    $cat_id=$row['cat_id'];
                             //    $cat_title=$row['cat_title'];

                             //    echo "<td value='{$cat_id}'>{$cat_title}</td>";
                             // }

                                 
                                echo "<td>{$post_status}</td>";
                                echo "<td><img width='100' src='../Images/{$post_img}' alt='Image'></td>";
                                echo "<td>{$post_tags}</td>";
                                  
                                
                                
                                  
                                echo "<td><a href='./comments.php'>{$post_comment_count}</a></td>";  
                                
                                  
                                  
                                echo "<td>{$post_date}</td>"; 

                                echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View</a></td>";

                                echo "<td><a class='btn btn-info' href='posts.php?sourse=edit_post&p_id={$post_id}'> Edit</a></td>";
                              

                               
                            
                                   
                                      // echo "<td><a onClick=\" javascript:return confirm('Are you sure you want to delete'); \"> <input type=submit class='btn btn-danger' name='delete' value=Delete></a></td>"
                        
    


                              
                                 echo "<td><a class='btn btn-danger' onClick=\" javascript:return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}'> Delete </a></td>";
                               




                                echo"<td ><a href='posts.php?reset={$post_id}'>$post_views<a></td>";
                                echo "</tr>";  






                            }
                           } 
                              ?>
                            
                            
                             


                    <?php

                          // if(isset($_POST['delete']))
                          //    {
                          //        $the_post_id=$_POST['delete'];
                          //        $query="DELETE FROM posts WHERE post_id= $the_post_id";
                          //        $delete_query= mysqli_query($connection , $query)." ";
                          //        header("Location:posts.php");
                          //    }


                           if(isset($_GET['delete']))
                               {
                                  $The_post_id=$_GET['delete'];
                                   $query="DELETE FROM posts WHERE post_id={$The_post_id} ";
                                   $delete_query = mysqli_query($connection , $query);
                                   header("Location:posts.php");// For refreshing the page
                               }

                            if(isset($_GET['reset']))
                             {
                                 $the_post_id=$_GET['reset'];
                                 $query="UPDATE posts SET post_views_count = 0 WHERE post_id= ". mysqli_real_escape_string($_GET['reset']);
                                 $delete_query= mysqli_query($connection , $query);
                                 header("Location:posts.php");
                             }

                      ?>   




                               
                          </tbody>
                      
                      </table>
                      
               </form>          
                    
 <?php

                              if(isset($_GET['p_id']))
                              {
                                  $the_post_id=$_GET['p_id'];
                              }

                              $query="SELECT * FROM posts WHERE post_id=$the_post_id";
                              $select_posts=mysqli_query($connection , $query);
                              while($row = mysqli_fetch_assoc($select_posts))
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
                                
                                if(isset($_POST['update_post']))
                                {
                                        $post_title=escape($_POST['title']);
                                        $post_category=escape($_POST['post_category']);
                                        $post_author=escape($_POST['author']);
                                        $post_status=escape($_POST['post_status']);
                                        $post_image=$_FILES['image']['name'];
                                        $post_image_temp= $_FILES['image']['tmp_name'];
                                        $post_tags=escape($_POST['tags']);
                                        $post_content=escape($_POST['content']);
                                    
                                      move_uploaded_file($post_image_temp,"../images/$post_image");   
                                    
                                     if(empty($post_image))
                                     {
                                         $query="SELECT * FROM posts WHERE post_id = $the_post_id";
                                         $select_image=mysqli_query($connection,$query);
                                         
                                         while($row=mysqli_fetch_array($select_image))
                                         {
                                             $post_image=$row['post_img'];
                                         }
                                     }
                                    
                                    $query="UPDATE posts SET post_title='{$post_title}', post_category_id='{$post_category}',post_date=now(),post_author='{$post_author}',post_status='{$post_status}',post_tags='{$post_tags}',post_content='{$post_content}',post_img='{$post_image}'WHERE post_id='{$the_post_id}'";
                                    
                                    $update_query = mysqli_query($connection,$query);
                                    
                                    if(!$update_query)
                                    {
                                        die("Query Failed". mysqli_error($connection));
                                    }
                                    else{
                                        echo "<P class='bg-success'>Update Data successfully <a href='../post.php?p_id= $the_post_id'>view post</a> or <a href='posts.php'>Edit more posts</a></p>";
                                    }
                                }
?>
   
   
   
   
   
   
   
   
   
   
    <form action=" " method="POST" enctype="multipart/form-data">
     
     <div class="form-group">
         <label for="title">Post Title</label>
         <input value=<?php echo $post_title; ?> type="text" class="form-control" name="title">
     </div>
     
     <div class="form-group">
         <label for="Categories">Post Categories</label>
          <select class="form-control" name="post_category" id="">
              <?php 
               
                  $query="SELECT * FROM categories  ";
                  $select_caterories=mysqli_query($connection,$query);

                    if(!$select_caterories)
                    {
                        echo die("Query Failed". mysqli_error());
                    }
                          while($row = mysqli_fetch_assoc($select_caterories))
                            {
                               $cat_id=$row['cat_id'];
                               $cat_title=$row['cat_title'];

                              echo "<option value='{$cat_id}'>{$cat_title}</option>";
                            }
              

              
              ?>
          </select>
     </div>
     
     <div class="form-group">
         <label for="author">Post Author</label>
         <input value=<?php echo $post_author; ?> type="text" class="form-control" name="author">
     </div>
     
     <div class="form-group">
         <label for="post_status">Post Status</label>
         <select name="post_status"  class="form-control">
             <option value="<?php echo $post_status; ?>"><?php echo $post_status ;?></option>
             <?php
                if($post_status =='Publish' ){     
                    echo "<option value='Draft'>Draft</option>";
                }
                if($post_status =='Draft'){
                    echo "<option value='Publish'>Publish</option>";
                }
             ?>
         </select>
         
     </div>
     
     
     <div class="form-group">
         <img width="100"  src="../Images/<?php echo $post_img; ?>">
     </div>
      
     <div class="form-group">
         <label for="post_image">Post Image</label>
         <input type="file" class="form-control" name="image">
     </div>
     
     <div class="form-group">
         <label for="post_tags">Post Tags</label>
         <input value=<?php echo $post_tags; ?> type="text" class="form-control" name="tags">
     </div>
     
     <div class="form-group">
         <label for="title">Post Content</label>
         <textarea  name="content" class="form-control" id="body" cols="30" rows="10">
             <?php echo  $post_content; ?>
         </textarea>
     </div>
     
     <div class="form-group">
         <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
     </div>
</form>
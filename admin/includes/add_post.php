 <?php

      /*  if(isset($_POST['creat_post']))
        {
             $post_title=$_POST['title'];
             $post_category=$_POST['post_category'];

             $post_author=$_POST['author'];
             $post_status=$_POST['status'];
            
              $post_Image=$_FILES['image']['name'];
              $post_Image_Tmp=$_FILES['image']['tmp_name'];
              
              $post_tags=$_POST['tags'];
              $post_content=$_POST['content'];
              $post_date= date('d_m_y');
              //$post_comment_count= 4;
            
             move_uploaded_file($post_Image_Tmp,"../Images/ $post_Image");
            
            $query="INSERT INTO posts (post_category_id, post_title , post_author , post_date , post_img , post_content , post_tags ,  post_status) VALUES (' $post_category',' $post_title', ' $post_author',now(),'$post_Image',' $post_content','$post_tags',  '$post_status')";
            
            $query="INSERT INTO posts (post_category_id, post_title ,post_author,post_date ,post_img ,post_content,post_tags,post_status) VALUES ($post_category,'$post_title','$post_author',now(),'$post_Image','$post_content','$post_tags','$post_status')";
            
            $add_query=mysqli_query($connection , $query);
            
            if(!$add_query){
                die("query Failed" . mysqli_error($connection));
            }
 
        }*/

?>

<?php 
     if(isset($_POST['creat_post'])){
         $user_id=$_SESSION['user_id'];
         $post_title=escape($_POST['post_title']);
         $post_category=escape($_POST['post_category']);
         $post_author=escape($_POST['post_author']);
         $post_status=escape($_POST['post_status']);
         
         $post_Image=$_FILES['image']['name'];
         $post_Image_Tmp=$_FILES['image']['tmp_name'];
         
         $post_tags=escape($_POST['post_tags']);
         $post_content=escape($_POST['post_content']);
         $post_date=escape(date('d_m_y'));
         $post_author=escape($_POST['post_author']);
         
          move_uploaded_file($post_Image_Tmp,"../Images/ $post_Image");
         
         $query="INSERT INTO posts ( post_category_id ,user_id, post_title , post_author , post_date , post_img , post_content , post_tags , post_comment_count , post_status ) VALUES ( '$post_category','$user_id' ,'$post_title' , '$post_author' , now(), '$post_Image' , '$post_content' , '$post_tags' , ' ' ,  ' $post_status' ) ";
         
         $Add_post_query=mysqli_query($connection,$query);
         
         if(!$Add_post_query){
             die("Query Failed" . mysqli_error($connection));
         }
         
         else{
             echo "Post added successfully";
         }
         
     }
  


?>




<form action=""  method="POST" enctype="multipart/form-data">
    <div class="form-group">
         <label for="title">Post Title</label>
         <input  type="text" class="form-control" name="post_title">
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

                              echo "<option value='$cat_id'>{$cat_title}</option>";
                            }

              
              ?>
          </select>
     </div>
     
     <div class="form-group">
         <label for="author">Post Author</label>
         <input  type="text" class="form-control" name="post_author">
     </div>
     
     
     
      <div class="form-group">
         <label for="post_status">Post Status</label>
         <select name="post_status"  class="form-control">
             <option value="">Select Option</option>
             <option value="Draft">Draft</option>
             <option value="Publish">Publish</option>
         </select>
         
     </div>
    
    
    
      
     <div class="form-group">
         <label for="post_image">Post Image</label>
         <input type="file" class="form-control" name="image">
     </div>
     
     <div class="form-group">
         <label for="post_tags">Post Tags</label>
         <input  type="text" class="form-control" name="post_tags">
     </div>
     
     <div class="form-group">
         <label for="title">Post Content</label>
         <textarea  name="post_content" class="form-control" id="body" cols="30" rows="10">
         </textarea>
     </div>
     
     <div class="form-group">
         <input type="submit" class="btn btn-primary" name="creat_post" value="Creat Post">
     </div>
 
    
</form>
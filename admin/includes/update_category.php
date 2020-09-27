<form action="" method="POST">
                                <div class="form-group">
                                    <lable for="cat_title">Edit Category</lable>
                                    <?php
                                       if(isset($_GET['edit']))
                                       {
                                           $cat_id=$_GET['edit'];
                                           
                                          $query="SELECT * FROM categories WHERE cat_id={$cat_id}";
                                          $select_all_caterories_id=mysqli_query($connection,$query);
                    
                                        while($row = mysqli_fetch_assoc($select_all_caterories_id))
                                           {
                                                $cat_id=$row['cat_id'];
                                                $cat_title=$row['cat_title'];
                                           
                                           
                                    ?>
                                      <input value="<?php if(isset($cat_title)){echo $cat_title;}?>" type="text" class="form-control " name="cat_title" >
                                    
                                    <?php 
                                         }
                                       }
                                    ?>
                                    
                                    
                                    <?php 
                                       /// Update category
                                    
                                    if(isset($_POST['Update']))
                                          {
                                         
                                              $cat_title=escape($_POST['cat_title']);
                                              $stmt=mysqli_prepare($connection ,"UPDATE categories SET cat_title=? WHERE cat_id=? ");
                                              mysqli_stmt_bind_param($stmt , 'si' , $cat_title ,$cat_id);
                                              mysqli_stmt_execute($stmt);
                                             // $update_query = mysqli_query($connection , $query);
                                              if(!$stmt)
                                              {
                                                  die("Query Failed" . mysqli_error($connection));
                                              }

                                              mysqli_stmt_close($stmt);
                                          }
                                    
                                    ?>
                                    
                                         
                                    
                                   
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="Update" value="Update Category">
                                </div>
                                
                            </form>
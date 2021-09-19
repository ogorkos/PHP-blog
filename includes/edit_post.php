<?php 
    if (isset($_GET['post_id'])){
        $the_post_id = $_GET['post_id'];                
    }
   

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments_count = $row['post_comments_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }


    if (isset($_POST['update_post'])){
        $post_image = $_FILES['image']['name'];
        $post_image_old = $_POST['image_old'];

        if ($post_image == "" ){
            $post_image = $post_image_old;
        } else {
            $post_image_temp = $_FILES['image']['tmp_name'];
            move_uploaded_file($post_image_temp,"./images/$post_image");
        }


        $post_title_new = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];


        $query = "UPDATE posts SET ";
        $query .="post_title = '{$post_title_new}', ";
        $query .="post_category_id = {$post_category_id}, ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_tags = '{$post_tags}', ";
        $query .="post_content = '{$post_content}', ";
        $query .="post_image = '{$post_image}' ";
        $query .="WHERE post_id = {$the_post_id} ";

       

        $update_post = mysqli_query($connection,$query);
        if (!$update_post){
            die('Query Faild ' .mysqli_error($connection));
        } else {
            header("Location: user_posts.php");                
        }
    }

?>
<div class=" mb-5">
    
    <h3>Edit the post</h3>
   <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="edit_label">Post title</label>
                <input type="text" class="form-control myinput" name="post_title" value="<?php echo $post_title ?>"  />
            </div>
            <div class="form-group col-md-6">
                <label class="edit_label">Post Tags</label>
                <input type="text" class="form-control myinput" name="post_tags" value="<?php echo $post_tags ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">  
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group mt-3">
                        <label class="edit_label">Category </label>
                        <select name="post_category" class="myinput">
                            <?php
                                $query = "SELECT * FROM categories";
                                $select_categories = mysqli_query($connection,$query);
            
                                if (!$select_categories){
                                    die("Query Failed " . mysqli_error($connection));
                                }
            
                                while ($row = mysqli_fetch_assoc($select_categories)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    if ($cat_id == $post_category_id){
                                        echo "<option value='$cat_id' selected>{$cat_title} </option>";
                                    } else {
                                        echo "<option value='$cat_id'>{$cat_title}</option>";
                                    }                                        
                                }
                            ?>
                        </select>        
                    </div>                   
                    </div>
                    
                    <div class="form-group mt-3 col-md-6">
                        <label class="edit_label">Status</label>
                        <select name="post_status" class="myinput">
                        <?php
                                if ($post_status == 'project'){
                                    echo "<option value='project' selected='selected'>project</option>";
                                    echo "<option value='published'>published</option>";
                                }
                                 else {
                                    echo "<option value='project'>project</option>";
                                    echo "<option value='published' selected='selected'>published</option>";
                                }                                     
                            ?>            
                        </select>
                    </div>
                </div>              

                <div class="form-group">
                    <div class="form-group mt-3">
                        <label class="edit_label">Image </label>
                        <input type="file" class="form-control myinput" name="image" >
                        <input type="hidden" name="image_old" value="<?php echo $post_image; ?>">
                    </div>                
                </div>
            </div>
            <div class="col-md-6 p-3">
                <img  height='110' src="./images/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>">
            </div>      
        </div>
        <div class="form-group mt-3">
            <label class="edit_label">Post Content</label>
            <textarea class="form-control myinput" name="post_content" rows="10" cols="25"><?php  echo $post_content ?>
            </textarea>
        </div>

        <a href='./user_posts.php' class='btn btn-secondary m-3' >Back</a>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="update_post" value="Update Post" />
        </div>
    </form>
</div>


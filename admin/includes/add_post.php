<?php

    if (isset($_POST['create_post'])){
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        if ($post_image ==''){
            $post_image = 'default.jpg';
        }
        move_uploaded_file($post_image_temp,"../images/$post_image");


        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        $query = "INSERT INTO posts(post_category_id, post_title, post_image, post_content, post_author, post_status, post_tags,  post_date)";
        $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_image}', '{$post_content}', '{$post_author}', '{$post_status}', '{$post_tags}',  now() )"; 
// echo $query;
        $create_post_query = mysqli_query($connection, $query);
        if (!$create_post_query){
            die('Query Faild ' .mysqli_error($connection));
        } else {
            header("Location: posts.php");                
        }
    }
?>

<h3>Add new post</h3>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="edit_label">Post title</label>
        <input type="text" class="form-control w-50 myinput" name="title" />
    </div>

    <div class="form-group mt-3">
        <label class="edit_label">Category</label>
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
                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }

            ?>
        </select>
    </div>

    <div class="form-group mt-3">
        <label class="edit_label">Post Author</label>
        <input type="text" class="form-control myinput w-50" name="author" />
    </div>

    <div class="form-group mt-3">
        <label class="edit_label">Status</label>
        <select name="post_status" class="myinput">
            <option value="project" selected='selected'>project</option>
            <option value="published">published</option>
        </select>
    </div>


    <div class="form-group mt-3">
        <label class="edit_label">Post Image</label>
        <input type="file" class="myinput" name="image">
    </div>

    <div class="form-group mt-3">
        <label class="edit_label">Post Tags</label>
        <input type="text" class="form-control myinput w-50" name="post_tags" />
    </div>

    <div class="form-group mt-3">
        <label class="edit_label">Post Content</label>
        <textarea class="form-control myinput" name="post_content" rows="5" cols="25"></textarea>
    </div>

    <a href='./posts.php' class='btn btn-secondary m-3' >Back</a>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Add Post" />
    </div>
</form>


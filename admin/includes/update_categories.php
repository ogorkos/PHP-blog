<form action="" method="post">
    <div class="form-group">
        <label>Edit Category</label>
        <br>
        <?php
            if (isset($_GET['edit'])){
                $cat_id = $_GET['edit'];

                $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                $select_categgories_id = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_categgories_id)){
                    $cat_title = $row['cat_title'];
                ?>
                    <input 
                    value="<?php echo $cat_title; ?>"
                    type="text" 
                    class="form-control" 
                    name="cat_title">
        <?php
             }
            }
        ?>
        
            <?php
                if (isset($_POST['update_category'])){
                    $the_cat_title = $_POST['cat_title'];
                    $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ? ");
                    mysqli_stmt_bind_param($stmt,'si',$the_cat_title,$cat_id);
                    mysqli_stmt_execute($stmt);
                    if (!$stmt){
                        die("Query Failed" . mysqli_error($connection));
                    }
                    mysqli_stmt_close($stmt);
                    header("Location: categories.php");
                }
                if (isset($_POST['cancel_update_category'])){
                    header("Location: categories.php");
                }
            ?>
    </div>
    <div class="form-group btn-submit">
        <input type="submit" name="update_category" value="Update Category" class="btn btn-primary">
        <input type="submit" name="cancel_update_category" value="Cancel" class="btn btn-secondary">
    </div>

</form>





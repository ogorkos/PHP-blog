<?php
    
    if (isset($_POST['update_user'])){
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $role = $_POST['role'];
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']); 
        $new_image = $_FILES['image']['name'];
        $image_old = $_POST['image_old'];                
        echo   'new_image = '.$new_image;
        echo   'image_old = '.$image_old;
        $error = [
            'username' => '',
            'email' => '',
         ];
   
         if (strlen($username) <4){
            $error['username'] = 'Username needs to be longer';
         }
         if ($username == '') {
            $error['username'] = 'Username cannot be empty';
         }
         if ($email == ''){
            $error['email'] = 'Email cannot be empty';
         }
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Invalid email format";
          }
    
        foreach ($error as $key => $value){
            if (empty($value)){
                unset($error[$key]);
            }
        }

        if (empty($error)){
            if ($new_image == "" ){
                $new_image = $image_old;
            } else {
                $user_image_temp = $_FILES['image']['tmp_name'];                                
                move_uploaded_file($user_image_temp,"../images/users/$new_image");
            }
            $user_id = $_GET['edit'];
            $query_update = "UPDATE users SET ";
            $query_update .="user_firstname = '{$firstname}', ";
            $query_update .="user_lastname = '{$lastname}', ";
            $query_update .="user_email = '{$email}', ";
            $query_update .="user_image = '{$new_image}' ";
            $query_update .="WHERE user_id = {$user_id} ";
            
            $update_user = mysqli_query($connection,$query_update);
            if (!$update_user){
                die('Query Faild ' .mysqli_error($connection));
            }  
            header("Location: users.php");
        }
    }
?>
<?php
    if (isset($_GET['edit'])){
        $user_id = $_GET['edit'];
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $select_user_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_user_id)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $firstname = $row['user_firstname'];
            $lastname = $row['user_lastname'];
            $email = $row['user_email'];
            $role = $row['user_role'];
            $image = $row['user_image'];
        }
    }
?>
     

<div class="row">    
    <h2 class='text-center'>Edit user</h2>        
    <form action="" method="post" enctype="multipart/form-data" class="border border-white p-3">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Username:</label>
                <input type="text" class="form-control" name="username" autocomplete="off" value="<?php echo $username ?>">    
                <p><?php echo isset($error['username']) ? $error['username'] : ''; ?></p>                    
            </div>
            <div class="form-group col-md-6">
                <label for="">Email:</label>
                <input type="text" class="form-control" name="email"  autocomplete="off" value="<?php echo $email ?>">                        
                <p><?php echo isset($error['email']) ? $error['email'] : ''; ?></p>                    
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Firstname:</label>
                <input type="text" class="form-control" name="firstname" autocomplete="off" value="<?php echo $firstname ?>">    
                <p><?php echo isset($error['firstname']) ? $error['firstname'] : ''; ?></p>                    
            </div>
            <div class="form-group col-md-6">
                <label for="">Lastname:</label>
                <input type="text" class="form-control" name="lastname" autocomplete="off" value="<?php echo $lastname ?>">    
                <p><?php echo isset($error['lastname']) ? $error['lastname'] : ''; ?></p>                    
            </div>
        </div>
   
            
        <div class="row ">            
            <div class="col-md-6 ">
                <label for="">Role</label>
                <select class="form-select" aria-label="Default select example" name="role">
                    <option selected value="subscriber">subscriber</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="">Image</label>
                <input type="file" class="form-control" name="image">    
                <input type="hidden" name="image_old" value="<?php echo $image; ?>">
            </div>
            <div class="col-md-2 user_img_box">
                <img  src="../images/users/<?php echo $image; ?>" alt="">
            </div>
        </div>
        <input type="submit" class="btn btn-primary" name="update_user" value="Update user">
        <a href="users.php" class="btn btn-secondary">Cancel</a>
    </form>
    
</div>
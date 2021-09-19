<?php 
    $username=$email=$firstname=$lastname= '';
    if (isset($_POST['registerbtn'])){
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $role = $_POST['role'];
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);                            
                        
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
            if (username_exists($username)){
            $error['username'] = 'Username already exists';
            }
            if ($email == ''){
            $error['email'] = 'Email cannot be empty';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Invalid email format";
            }
            if (email_exists($email)){
            $error['email'] = 'Email already exists';
            }
    
        foreach ($error as $key => $value){
            if (empty($value)){
                unset($error[$key]);
            }
        }
        if (empty($error)){            
            $image = $_FILES['image']['name'];
            $user_image_temp = $_FILES['image']['tmp_name'];                                
            move_uploaded_file($user_image_temp,"../images/users/$image");
            
            $query_create = "INSERT INTO users ";
            $query_create .="(username, user_firstname, user_lastname, user_email, user_image, user_role)";
            $query_create .="VALUES('{$username}', '{$firstname}', '{$lastname}', '{$email}', '{$image}', '{$role}')";
            
            $create_user = mysqli_query($connection,$query_create);
            if (!$create_user){
                die('Query Faild ' .mysqli_error($connection));
            }  
            header("Location: users.php");                            
        }
    }
?>
<div class="row">    
    <h2 class='text-center'>Add new user</h2>        
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
                <div class="form-group col-md-6">
                    <label for="">Image</label>
                    <input type="file" class="form-control" name="image">    
                    <br>
                </div>
        </div>
        <input type="submit" class="btn btn-primary" name="registerbtn" value="Create new user">
        <a href="users.php" class="btn btn-secondary">Cancel</a>
    </form>
    
</div>
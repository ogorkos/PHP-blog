<?php include "includes/db.php" ?>
<?php include "includes/header.php"; ?>
<?php $active_page = "profile" ?>
<?php include "includes/navigation.php" ?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-9 p-4">
                <?php 
                // -------------------------Loading

                    $username = $_SESSION['username'];
                    $query = "SELECT * FROM users WHERE username = '{$username}'";
                    $select_user = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($select_user)){
                        $user_id = $row['user_id'];
                        $user_password = $row['user_password'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                        if ($row['user_image'] == ''){
                            $user_image = 'default.png';
                        }   else {
                            $user_image = $row['user_image'];
                        }
                    }


                    // -------------------------UPDATE

                    if (isset($_POST['registerbtn'])){
                        $email = trim($_POST['email']);
                        $password = trim($_POST['password']);
                        $firstname = trim($_POST['firstname']);
                        $lastname = trim($_POST['lastname']);
                                        
                        $user_image = $_FILES['image']['name'];
                        $user_image_old = $_POST['image_old'];
                                       
                        $error = [                           
                           'email' => '',
                           'password' => '',
                        ];
                                         
                        if ($email == ''){
                           $error['email'] = 'Email cannot be empty';
                        }
                        if ($password == ''){
                           $error['password'] = 'Password cannot be empty';
                        }
                        if (strlen($password) < 6){
                           $error['password'] = 'Password needs to be longer';
                        }
                        if (!password_verify($password, $user_password)){
                            $error['password'] = 'Password is wrong';
                        }
                  
                        foreach ($error as $key => $value){
                           if (empty($value)){
                               unset($error[$key]);
                           }
                        }
                        if (empty($error)){
                            if ($user_image == "" ){
                                $user_image = $user_image_old;
                            } else {
                                $user_image_temp = $_FILES['image']['tmp_name'];                                
                                move_uploaded_file($user_image_temp,"./images/users/$user_image");
                            }
                            $query_update = "UPDATE users SET ";
                            $query_update .="user_firstname = '{$user_firstname}', ";
                            $query_update .="user_lastname = '{$user_lastname}', ";
                            $query_update .="user_email = '{$user_email}', ";
                            $query_update .="user_image = '{$user_image}' ";
                            $query_update .="WHERE user_id = {$user_id} ";
                            
                            $update_user = mysqli_query($connection,$query_update);
                            if (!$update_user){
                                die('Query Faild ' .mysqli_error($connection));
                            }                    
                        }
                    }
                ?>
                
                <h1 class='text-center'>Your profile</h1>
                <br>
                <p><b>Username: <?php echo $username; ?></b></p>

                
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Firstname:</label>
                            <input type="text" class="form-control" name="firstname" autocomplete="off" value="<?php echo $user_firstname ?>">    
                            <p><?php echo isset($error['firstname']) ? $error['firstname'] : ''; ?></p>                    
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Lastname:</label>
                            <input type="text" class="form-control" name="lastname" autocomplete="off" value="<?php echo $user_lastname ?>">    
                            <p><?php echo isset($error['lastname']) ? $error['lastname'] : ''; ?></p>                    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Email:</label>
                            <input type="text" class="form-control" name="email"  autocomplete="off" value="<?php echo $user_email ?>">                        
                            <p><?php echo isset($error['email']) ? $error['email'] : ''; ?></p>                    
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="">Password:</label>
                            <input type="password" class="form-control" name="password" autocomplete="off" >                        
                        </div>   
                        <p><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>  
                    </div>   
                        
                    <div class="row">
                        <div class="col-md-6">
                            <img class="w-50" src="./images/users/<?php echo $user_image; ?>" alt="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="image">    
                            <input type="hidden" name="image_old" value="<?php echo $user_image; ?>">
                            <br>
                            <input type="submit" class="btn btn-primary" name="registerbtn" value="Update User">
                        </div>
                    </div>
                  </form>
                
            </div>
            <?php include "includes/sidebar.php" ?>
        </div>      

        </div>
    </div>

    <script src="js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.js"></script>
</body>
</html>
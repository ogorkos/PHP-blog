<?php include "includes/db.php"?>
<?php include "includes/header.php"?>
<?php $active_page = "register" ?>
<?php include "includes/navigation.php"?>
<?php 
   if (isset($_POST['registerbtn'])){
      $username = trim($_POST['username']);
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);     

      $error = [
         'username' => '',
         'email' => '',
         'password' => '',
      ];

      if ($username == '') {
         $error['username'] = 'Username cannot be empty';
      }
      if (strlen($username) <4){
         $error['username'] = 'Username needs to be longer';
      }
      if (username_exists($username)){
         $error['username'] = 'Username already exists';
      }
      if ($email == ''){
         $error['email'] = 'Email cannot be empty';
      }
      if ($password == ''){
         $error['password'] = 'Password cannot be empty';
      }
      if (strlen($password) < 6){
         $error['password'] = 'Password needs to be longer';
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
         $user_image = $_FILES['image']['name'];        
         $user_image_temp = $_FILES['image']['tmp_name'];
         move_uploaded_file($user_image_temp,"./images/users/$user_image");

         register_user($username, $email, $password, $user_image, 'subscriber');
         login_user($username, $password);
         header("Location: index.php");
     }
   }
?>

<div class="container min_height mt-3">
   <section id="register">
      <div class="container">
         <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
               <div class="form-group">
                  <h1>Register</h1>
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label for="">Username:</label>
                           <input type="text" class="form-control" name="username" placeholder="" autocomplete="off" value="">    
                           <p><?php echo isset($error['username']) ? $error['username'] : ''; ?></p>                    
                        </div>                           
                        <div class="form-group col-md-6">
                           <label for="">Email:</label>
                           <input type="text" class="form-control" name="email" id="email"  placeholder="" autocomplete="off" value="">                        
                           <p><?php echo isset($error['email']) ? $error['email'] : ''; ?></p>                                            
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="">Password:</label>
                              <input type="password" class="form-control" name="password" autocomplete="off" value="">                        
                              <p><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>  
                           </div>        
                           <div class="form-group mt-3">
                              <label class="">Image </label>
                              <input type="file" class="form-control" name="image" >
                           </div>                   
                        </div>
                        <div class="col-md-6">
                           <img width="w-100" src="../images/<?php echo $post_image; ?>" alt="">                           
                        </div>
                        

                     </div>
                        <br>
                     <input type="submit" class="btn btn-primary" name="registerbtn" value="Register">
                  </form>
               </div>
            </div>
         </div>
      </div>

   </section>
   <br>
   
</div>
<?php include "includes/footer.php"?>
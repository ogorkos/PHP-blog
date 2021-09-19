<?php include "includes/db.php"?>
<?php include "includes/header.php"?>
<?php $active_page = "login" ?>
<?php include "includes/navigation.php"?>
<?php 
   if (isset($_POST['loginbtn'])){
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);

      $error = [
         'username' => '',
         'password' => '',
      ];

      if ($username == '') {
         $error['username'] = 'Username cannot be empty';
      }
      if (strlen($username) <4){
         $error['username'] = 'Username needs to be longer';
      }
      if ($password == ''){
         $error['password'] = 'Password cannot be empty';
      }
      if (strlen($password) < 6){
         $error['password'] = 'Password needs to be longer';
      }

      foreach ($error as $key => $value){
         if (empty($value)){
             unset($error[$key]);
         }
     }

     if (empty($error)){
         if ( login_user($username, $password) == false){
            $userNotFound = 'Username or password incorrect';
         };
     }
   }

?>

<div class="container min_height mt-3">
   <section id="register">
      <div class="container">
         <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
               <div class="form-group">
                  <h1>Login</h1>
                  <form action="" method="post">
                     <div class="form-group">
                        <label for="">Username:</label>
                        <input type="text" class="form-control" name="username" id="username"  placeholder="Username" autocomplete="off" >    
                        <p><?php echo isset($error['username']) ? $error['username'] : ''; ?></p>                    
                        </div>
                        <br>
                     
                     <div class="form-group">
                        <label for="">Password:</label>
                        <input type="password" class="form-control" name="password" id="password"  autocomplete="off" placeholder="password">                        
                        </div>   
                        <p><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>  
                        
                        <p style="color:red; margin:8px;">
                           <?php
                              if (isset($userNotFound)){
                                 echo $userNotFound;
                              };
                           ?>
                        </p>
                     <input type="submit" class="btn btn-primary" name="loginbtn" value="Login">
                  </form>
                  
               </div>
            </div>
         </div>
      </div>

   </section>
   <br>
   
</div>
<?php include "includes/footer.php"?>
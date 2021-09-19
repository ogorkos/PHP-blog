<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand p-0" href="index.php">                          
                    <img src="./images/site/logo.png" height="45" alt="logo">
            </a>             
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                   <li class='nav-item'>
                           <a class='nav-link <?php if ($active_page == 'index'){echo 'active';} ?>' aria-current='page' href='index.php'>Blog</a>
                   </li>
                    <li class='nav-item'>
                            <a class='nav-link <?php if ($active_page == 'about'){echo 'active';} ?>' aria-current='page' href='about.php'>About</a>
                    </li>
                    <li class='nav-item'>
                            <a class='nav-link <?php if ($active_page == 'user_posts'){echo 'active';} ?>' aria-current='page' href='user_posts.php'>My posts</a>
                    </li>
                </ul>   
                
                
                <?php 
                    if ($_SESSION['image']) {
                        $image = $_SESSION['image'];
                    } else {
                        $image = 'default.png';
                    }
                    if(isset($_SESSION['username'])){
                        echo "<ul class='navbar-nav mb-2 mb-lg-0'>
                        <div class='user_img_box'>";
                        if ($_SESSION['role'] == 'admin'){
                            echo "<a class='btn btn-outline-light me-2' href='./admin/posts.php'>Admin pannel</a>";
                        }
                        echo "<img class='rounded' src='./images/users/{$image}' alt='User image'>
                        </div>
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-bs-toggle='dropdown' aria-expanded='false'>
                            <span class='text-info'>
                                {$_SESSION['username']}                                 
                            </span>
                            </a>
                            <ul class='dropdown-menu dropdown-menu-dark dropdown-menu-lg-end ' aria-labelledby='dropdown03'>
                            <li><a class='dropdown-item' href='./profile.php'><i class='fas fa-user-cog me-2'></i> Settings</a></li>
                            <li><a class='dropdown-item' href='./signout.php'><i class='fas fa-sign-out-alt me-2'></i> Sign out</a></li>
                            </ul>
                        </li> 
                    </ul>";
                    } else {
                        echo "<a class='btn btn-outline-light me-2' href='./login.php'>Login</a>";
                        echo "<a class='btn btn-warning' href='./register.php'>Sign up</a>";
                    }
                ?>
                
            </div>
        </div>
    </nav>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; min-height:100vh;">
    <a href="index.php" class="d-flex align-items-center justify-content-evenly text-white text-decoration-none w-100">      
      <span class="fs-4 m-3">Admin</span>
      <img class="m-3 rounded" width='40' src="../images/users/<?php echo $_SESSION['image'] ?>" alt='User image'>         
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="index.php" class="nav-link text-white <?php if ($active_page == "index"){echo 'active';}?>" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="posts.php" class="nav-link text-white <?php if ($active_page == "posts"){echo 'active';}?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Posts
        </a>
      </li>
      <li>
        <a href="comments.php" class="nav-link text-white <?php if ($active_page == "comments"){echo 'active';}?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Comments
        </a>
      </li>
      <li>
        <a href="users.php" class="nav-link text-white <?php if ($active_page == "users"){echo 'active';}?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Users
        </a>
      </li>
      <li>
        <a href="categories.php" class="nav-link text-white <?php if ($active_page == "categories"){echo 'active';}?>">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Categories
        </a>
      </li>
    </ul>
    <hr>
    <ul class="nav nav-pills flex-column ">
      <li class="nav-item">
        <a href="../signout.php" class="nav-link text-white" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Sign out <i class='fas fa-sign-out-alt ms-3 fs-5'></i> 
        </a>
      </li>        
    </ul>
</div>
 
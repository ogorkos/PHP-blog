<?php include "includes/db.php" ?>
<?php $active_page = "user_posts" ?>
<?php include "includes/header.php" ?>


    <?php include "includes/navigation.php"; ?>

    <div class="container">
        <div class="row min_height p-0">
            <div class="col-md-9 mt-3">
               <h1 class="page-header text-center">
                  My posts
               </h1>
               <div class="posts">
                    <?php

                    if (isset($_GET['source'])){
                        $source=$_GET['source'];
                    } else {
                        $source='';
                    }

                    switch($source){
                        
                        case 'add_post':
                            include "includes/add_post.php";
                            break;
                            
                        case 'edit_post':
                            include "includes/edit_post.php";
                            break;

                        default:
                            include "includes/view_all_posts.php";
                            break;
                    }

                    ?>
               </div>
            </div>            
            <?php include "includes/sidebar.php" ?>
        </div>
    </div>

    <?php include "includes/footer.php" ?>

    <script src="js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.js"></script>

</body>
</html>
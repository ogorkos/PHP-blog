<?php $active_page = "posts" ?>
<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">
        <?php include "includes/admin_navigation.php"; ?>
            <div class="container-fluid mt-3">
                <div class="row ">
                    <div class="col-lg-12 ">
                        <h1 class="text-center">Posts</h1>

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
            </div>
    </div>

    <script src="../js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.js"></script>
</body>
</html>
<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php $active_page = "post" ?>
<?php include "includes/navigation.php" ?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-9 p-4">
                <?php 
                
                    if (isset($_GET['post_id'])){
                        $the_post_id = $_GET['post_id'];
                    }
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                    $select_post = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($select_post)){
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                        $post_comments_count = $row['post_comments_count'];
                        $post_date = $row['post_date'];
                    }

                    $query_user = "SELECT * FROM users WHERE username = '{$post_author}' ";
                    $select_user = mysqli_query($connection,$query_user);
                    while($row_user = mysqli_fetch_assoc($select_user)){
                        $user_firstname = $row_user['user_firstname'];
                        $user_lastname = $row_user['user_lastname'];
                        $user_image = $row_user['user_image'];
                    }
                ?>
                
                <h1 class="text-center"><?php echo $post_title; ?></h1>         
                <div class="d-flex ">
                    <p class="me-auto mb-0"><em> by <?php echo "$user_firstname $user_lastname"; ?></em> <img height='30' src="<?php echo "./images/users/$user_image"; ?>" alt=""></p>
                    <p class="mb-0" ><em>Posted on <?php echo $post_date; ?></em></p>
                </div>
                <hr />
                <div class="col-lg-12 col-md-6 col-sm-12 ">
                        <img class="blog-img shadow rounded-pill" src="./images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>"/>
                </div>

                <hr/>

                <p class="lead mb-5">
                    <?php echo $post_content; ?>
                </p>

                <hr />
                


                <!-- Comments -->
                
                
                <?php
                    if (isset($_POST['create_comment'])){                       
                        if ($_POST['comment_content'] != ''){
                            $the_post_id=$_GET['post_id'];
                            $comment_content = $_POST['comment_content'];
                            $comment_author = $_SESSION['username'];
                            $comment_date = date("Y-m-d h:i:sa");
                            $query = "INSERT INTO comments(comment_post_id,comment_author, comment_content, comment_status, comment_date)";
                            $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_content}', 'approved', '{$comment_date}')";
    
                            $create_comment_query = mysqli_query($connection, $query);
                            if (!$create_comment_query){
                                die('Query Failed' .mysqli_error($connection));
                            }
                        }                        
                    }
                
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                    $query .= "AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_date DESC";

                    $select_comment_query = mysqli_query($connection, $query);
                    if (!$select_comment_query){
                        die('Query Failed' .mysqli_error($connection));
                    }

                    while($row = mysqli_fetch_array($select_comment_query)){
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];                              
                ?>
                    <div class="rounded-pill media border border-2 mb-2 ps-3 pe-3">
                        <small class='d-flex ps-4 pe-4 fw-bold fst-italic'>
                            <span class="me-auto">
                                <?php echo $comment_author; ?>
                            </span>
                            <span><?php echo $comment_date; ?></span>
                        </small>
                        <p class='ps-2 pe-2 mb-2'> <?php echo $comment_content; ?> </p>                        
                    </div>
                <?php 
                    }
                ?>                

                <div class="well">
                    <h6>Leave a Comment</h6>
                    <form  method='post'>
                        <div class="form-group pb-3">
                            <textarea class="form-control" row="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>
                
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
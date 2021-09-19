<?php include "includes/db.php"; ?>

<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

    <div class="container">
        <div class="row min_height">
            <div class="col-md-9">
                <h1 class="page-header m-3">
                    Search
                </h1>
                <div class='d-flex flex-wrap p-0' >

                <?php                     
                    if (isset($_POST['submit']) || isset($_POST['category'])){
                        if (isset($_POST['submit'])){
                            $search=$_POST['search'];
                            $query="SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR  post_title LIKE '%$search%' OR post_content LIKE '%$search%'";
                        }
                        if (isset($_POST['category'])){
                            $category=$_POST['category'];
                            $query="SELECT * FROM posts WHERE post_category_id=$category";
                        }
                        $search_query=mysqli_query($connection,$query);

                        if (!$search_query){
                            die("QUERY FAILEd ". mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($search_query);

                        
                        if ($count == 0){
                            echo "<h1>No Result</h1>";
                        } else {
                            while($row=mysqli_fetch_array($search_query)){
                                $post_id=$row['post_id'];
                                $post_title=$row['post_title'];
                                $post_author=$row['post_author'];
                                $post_date=$row['post_date'];
                                $post_content=$row['post_content'];
                                $post_img=$row['post_image'];

                                $max_str_length = 120;
                                if (strlen($post_content) > $max_str_length){
                                    $str = substr($post_content, 0, $max_str_length);
                                    $number_post_content = strrpos($str,' ');                            
                                    $post_content_cut = substr($str, 0, $number_post_content).'...';
                                } else {
                                    $post_content_cut = $post_content;
                                }
                                ?>
                                    <div class="col-xl-4 col-md-6 col-sm-12 p-2" >
                                        <div class="card shadow bg-white rounded h-100 ">
                                            <div class="box_img_in_card mt-0">
                                            <a href="post.php?post_id=<?php echo $post_id ?>">
                                                <img class="card-img-top img_in_card" src="./images/<?php echo $post_img; ?>" alt="Card image cap">                                    
                                            </a>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $post_title ?></h5>
                                                <p class="card-text"><?php echo $post_content_cut ?></p>
                                            </div>
                                            <p class="card-text m-3"><small class="text-muted">Last updated <?php echo $post_date ?></small></p>
                                            <p><a class="btn btn-primary d-inline m-3" href="post.php?post_id=<?php echo $post_id ?>">Read More</a></p>
                                        </div>
                                    </div>
                                  
                                    <?php
                                }                                
                            }                            
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
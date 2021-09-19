<?php $active_page = "index"; ?>
<?php include "includes/admin_header.php"; ?>
    <div id="wrapper">
        <?php include "includes/admin_navigation.php"; ?>
        <div class="page-wrapper">
            <div class="container-fluid ">
                <div class="row m-3">
                    <div class="col-lg-12">
                        <h1 class="page-header">Welcome to Admin Dashbord</h1>
                    </div>
                    <hr>
                    <h3>Posts</h3>
                    <p>Published posts: <b> <?php echo get_posts('published') ?> </b></p>
                    <p>Not published posts: <b> <?php echo get_posts('project') ?> </b></p>
                    <hr>
                    <h3>Comments</h3>
                    <p>Approved: <b> <?php echo get_comments('approved') ?> </b></p>
                    <p>Not approved: <b> <?php echo get_comments('not approved') ?> </b></p>
                    <hr>
                    <h3>Users</h3>
                    <p>Subscriber: <b> <?php echo get_users('subscriber') ?> </b></p>
                    <p>Admins: <b> <?php echo get_users('admin') ?> </b></p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.js"></script>
</body>
</html>
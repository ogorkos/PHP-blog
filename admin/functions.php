<?php 

    function insert_categories(){
        global $connection;
        if (isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];

            if ($cat_title == "" || empty($cat_title)){
                echo "Category title should not be empty";
            } else {
                $ctdb = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?)");
                mysqli_stmt_bind_param($ctdb,'s', $cat_title);
                mysqli_stmt_execute($ctdb);

                if (!$ctdb){
                    die('Query Failed' . mysqli_error($connection));
                }
            }
            mysqli_stmt_close($ctdb);
        }
    }

    function register_user($username, $email, $password, $image, $role){
        global $connection;        
        $username = mysqli_real_escape_string($connection,$username);
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
        $query = "INSERT INTO users (username, user_email, user_password, user_role, user_image)";
        $query .= " VALUES('{$username}', '{$email}', '{$password}', $role, '{$image}')";

        $register_user_query = mysqli_query($connection, $query);

        if (!$register_user_query) {
            die("Query FAiled ".mysqli_error($connection));
        }

    }
    function login_user($username, $password){
        global $connection;
        $query = "SELECT * FROM users WHERE username='{$username}'";
        $select_user_query = mysqli_query($connection,$query);
        if (!$select_user_query) {
            die("Query FAiled ".mysqli_error($connection));
        } else {
           while ($row = mysqli_fetch_assoc($select_user_query)){
            $db_user_id = $row['user_id'];
            $db_user_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_role = $row['user_role'];
            $db_user_image = $row['user_image'];
            }
            if (!isset($db_user_password)) return false;
            if (password_verify($password, $db_user_password)){
                $_SESSION['username'] = $db_user_username;
                $_SESSION['role'] = $db_user_role;
                $_SESSION['image'] = $db_user_image;
                if ($db_user_role == 'admin') {
                    header("Location: admin/index.php");
                } else {
                    header("Location: index.php");
                }
                
            } else return false;     
        }        
    }

    function username_exists($username){
        global $connection;
        $query = "SELECT username FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Query FAiled ".mysqli_error($connection));
        }
        if (mysqli_num_rows($result) > 0){
            return true;
        } else {
            return false;
        }
    }
    function email_exists($email){
        global $connection;
        $query = "SELECT user_email FROM users WHERE user_email = '$email'";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Query FAiled ".mysqli_error($connection));
        }
        if (mysqli_num_rows($result) > 0){
            return true;
        } else {
            return false;
        }
    }

    function get_posts($status_post){
        global $connection;
        $query = "SELECT COUNT('post_id') FROM posts WHERE post_status = '$status_post'";
        $result = mysqli_query($connection, $query);
        $row = $result->fetch_row();
        $posts_count = $row[0];
        return $posts_count;
    }
    function get_comments($status_com){
        global $connection;
        $query = "SELECT COUNT('comment_id') FROM comments WHERE comment_status = '$status_com'";
        $result = mysqli_query($connection, $query);
        $row = $result->fetch_row();
        $posts_count = $row[0];
        return $posts_count;
    }
    function get_users($user_roles){
        global $connection;
        $query = "SELECT COUNT('user_id') FROM users WHERE user_role = '$user_roles'";
        $result = mysqli_query($connection, $query);
        $row = $result->fetch_row();
        $posts_count = $row[0];
        return $posts_count;
    }
?>
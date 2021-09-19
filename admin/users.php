<?php $active_page = "users" ?>
<?php include "includes/admin_header.php"; ?>
<?php 
    
    if (isset($_POST['delete_confirm'])){
    $the_users_id_confirm = $_POST['user_id_confirm'];
    echo 'Modal window ID='.$the_users_id_confirm;
    $query = "DELETE FROM users WHERE user_id = {$the_users_id_confirm}";
    $deleted_query = mysqli_query($connection,$query);
    header("Location: users.php");
    }
?>
    <div id="wrapper">
        <?php include "includes/admin_navigation.php"; ?>
        <div class="page-wrapper">
            <div class="container-fluid mt-3">
                <div class="row">
                    <h1 class="text-center">Users</h1>
                    <div class="container">
                        <div class="">
                            <div class="container mt-3">                            
                            <?php
                                if (isset($_GET['edit'])){
                                    include "includes/update_users.php";
                                } 
                                if (isset($_GET['add_user'])){ 
                                    include "includes/add_user.php";
                                } 
                                if (!isset($_GET['add_user']) && !isset($_GET['edit'])) {
                                    echo "<a href='users.php?add_user=1' class='btn btn-primary' >Add new user</a>";
                                }
                            ?>
                            </div>
                        </div>


                        <div class="mt-3">
                            <table class="table table-dark table-striped">
                                <thead class="thead-dark">
                                    <tr class="table-dark">
                                        <th scope="col">Id</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col text-center">
                                            <p class="text-center m-0">Delete</p> 
                                        </th>
                                        <th scope="col text-center">
                                            <p class="text-center m-0">Edit</p> 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM users";
                                        $select_all_users_query=mysqli_query($connection,$query);
                                        while ($row=mysqli_fetch_array($select_all_users_query)){
                                            $user_image=$row['user_image'];
                                            $user_id=$row['user_id'];
                                            $username = $row['username'];
                                            $user_email = $row['user_email'];
                                            $user_role = $row['user_role'];

                                            if ($user_image==''){$user_image='default.png';}
                                            echo "<tr>";
                                            echo "<td>{$user_id}</td>";
                                            echo "<td><img src='../images/users/{$user_image}' height='50' alt='{$user_image}' class='rounded'></td>";
                                            echo "<td>{$username}</td>";
                                            echo "<td>{$user_email}</td>";
                                            echo "<td>{$user_role}</td>";
                                            ?>
                                            <td class='text-center'>
                                                <a href="javascript:;" class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal' onclick='deleteUsers(<?php echo $user_id ?>)' ><i class="far fa-trash-alt"></i></a>
                                            </td>
                                            <?php
                                            echo "<td class='text-center'><a href='users.php?edit={$user_id}' class='btn btn-info' ><i class='far fa-edit'></i></a></td>";
                                            echo "</tr>";
                                        }
                
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-body">
            Are you sure you want to delete this User?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="" method="post">
            <input type="hidden" id="id_to_delete" name="user_id_confirm"/>
            <input type="submit" class="btn btn-danger" name="delete_confirm" value="Delete"></input>
            </form>
        </div>
        </div>
    </div>
    </div>

    <script>    
        function deleteUsers(id){
            document.getElementById('id_to_delete').value = id;
        }
    </script>
    
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.js"></script>
</body>
</html>
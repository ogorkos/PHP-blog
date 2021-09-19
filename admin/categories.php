<?php $active_page = "categories" ?>
<?php include "includes/admin_header.php"; ?>
<?php 
    insert_categories(); 
    
    if (isset($_POST['delete_confirm'])){
    $the_cat_id_confirm = $_POST['cat_id_confirm'];
    echo 'Modal window ID='.$the_cat_id_confirm;
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id_confirm}";
    $deleted_query = mysqli_query($connection,$query);
    header("Location: categories.php");
    }
?>
    <div id="wrapper">
        <?php include "includes/admin_navigation.php"; ?>
        <div class="page-wrapper">
            <div class="container-fluid  mt-3">
                <div class="row">
                    <h1 class="text-center">Categories</h1>
                    <div class="container">
                        <div class="row">
                            <div class="add-cat col-md-6">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Add Category</label>
                                        <input type="text" class="form-control" name="cat_title">
                                    </div>
                                    <div class="form-group btn-submit">
                                        <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                                    </div>
                                </form>                          
                            </div>
                            <div class="add-cat col-md-6">
                                <?php
                                    if (isset($_GET['edit'])){
                                        $cat_id = $_GET['edit'];
                                        include "includes/update_categories.php";
                                    } 
                                ?>
                            </div>
                        </div>


                        <div class="mt-3">
                            <table class="table table-dark table-striped">
                                <thead class="thead-dark">
                                    <tr class="table-dark">
                                        <th scope="col">Id</th>
                                        <th scope="col">Title</th>
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
                                        $query = "SELECT * FROM categories";
                                        $select_all_categories_query=mysqli_query($connection,$query);
                                        while ($row=mysqli_fetch_array($select_all_categories_query)){
                                            $cat_id=$row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            echo "<tr>";
                                            echo "<td>{$cat_id}</td>";
                                            echo "<td>{$cat_title}</td>";
                                            ?>
                                            <td class='text-center'>
                                                <a href="javascript:;" class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal' onclick='deleteCategories(<?php echo $cat_id ?>)' ><i class="far fa-trash-alt"></i></a>
                                            </td>
                                            <?php
                                            echo "<td class='text-center'><a href='categories.php?edit={$cat_id}' class='btn btn-info' ><i class='far fa-edit'></i></a></td>";
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
            Are you sure you want to delete this categorie?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="" method="post">
            <input type="hidden" id="id_to_delete" name="cat_id_confirm"/>
            <input type="submit" class="btn btn-danger" name="delete_confirm" value="Delete"></input>
            </form>
        </div>
        </div>
    </div>
    </div>

    <script>    
        function deleteCategories(id){
            document.getElementById('id_to_delete').value = id;
        }
    </script>
    
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.js"></script>
</body>
</html>
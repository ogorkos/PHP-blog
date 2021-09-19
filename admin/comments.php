<?php $active_page = "comments" ?>
<?php include "includes/admin_header.php"; ?>
<?php 

    if (isset($_POST['delete_confirm'])){
      $comment_id_confirm = $_POST['comment_id_confirm'];
      $query = "DELETE FROM comments WHERE comment_id = {$comment_id_confirm}";
      $deleted_query = mysqli_query($connection,$query);
      if (!$deleted_query){
         die('Query Faild ' .mysqli_error($connection));
      }  
      header("Location: comments.php");
   }


   if (isset($_POST['edit_status'])){
      $comment_id_status = $_POST['comment_id'];
      $comment_status_old = $_POST['comment_status'];
      if ($comment_status_old == 'approved'){
         $comment_status = 'not approved';
      } else {
         $comment_status = 'approved';
      }
      $query_update = "UPDATE comments SET ";
      $query_update .="comment_status = '{$comment_status}' ";
      $query_update .="WHERE comment_id = {$comment_id_status}";
      $edit_query = mysqli_query($connection,$query_update);
      if (!$edit_query){
         die('Query Faild ' .mysqli_error($connection));
      }  
      header("Location: comments.php");
    }

?>
    <div id="wrapper">
        <?php include "includes/admin_navigation.php"; ?>
        <div class="page-wrapper">
            <div class="container-fluid  mt-3">
                <div class="row">
                    <h1 class="text-center">Categories</h1>
                    <div class="container">
                        <div class="mt-3">
                            <table class="table table-dark table-striped">
                                <thead class="thead-dark">
                                    <tr class="table-dark">
                                       <th scope="col">Id</th>
                                       <th scope="col">Post_id</th>
                                       <th scope="col">Author</th>
                                       <th scope="col">Content</th>
                                       <th scope="col">Status</th>
                                       <th scope="col">Date</th>
                                       <th scope="col text-center">
                                          <p class="text-center m-0"></p> 
                                       </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       $query = "SELECT * FROM comments";
                                       $select_all_comments_query=mysqli_query($connection,$query);
                                       while ($row=mysqli_fetch_array($select_all_comments_query)){
                                          $comment_id=$row['comment_id'];
                                          $comment_post_id=$row['comment_post_id'];
                                          $comment_author = $row['comment_author'];
                                          $comment_content = $row['comment_content'];
                                          $comment_status = $row['comment_status'];
                                          $comment_date = $row['comment_date'];
                                          echo "<tr>";
                                          echo "<td>{$comment_id}</td>";
                                          echo "<td>{$comment_post_id}</td>";
                                          echo "<td>{$comment_author}</td>";
                                          echo "<td>{$comment_content}</td>";
                                          echo "<td>{$comment_status}<form method='post'>
                                                <input type='hidden' name='comment_id' value='{$comment_id}'/>
                                                <input type='hidden' name='comment_status' value='{$comment_status}'/>
                                                <input type='submit' class='btn btn-info' name='edit_status' value='Edit status'/>
                                             </form></td>";
                                          echo "<td>{$comment_date}</td>";
                                          ?>
                                          <td class='text-center'>
                                             <a href="javascript:;" class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal' onclick='deleteComment(<?php echo $comment_id ?>)' ><i class="far fa-trash-alt"></i></a>
                                          </td>
                                       </tr>
                                    <?php
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
            Are you sure you want to delete this comment?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="" method="post">
               <input type="hidden" id="id_to_delete" name="comment_id_confirm"/>
               <input type="submit" class="btn btn-danger" name="delete_confirm" value="Delete"></input>
            </form>
        </div>
        </div>
    </div>
    </div>

    <script>    
        function deleteComment(id){
            document.getElementById('id_to_delete').value = id;
        }
    </script>
    
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.js"></script>
</body>
</html>
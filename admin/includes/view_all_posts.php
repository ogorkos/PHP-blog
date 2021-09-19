<?php    
      if (isset($_POST['delete_confirm'])){
        $the_post_id_confirm = $_POST['post_id_confirm'];
        echo 'Modal window ID='.$the_post_id_confirm;
        $query = "DELETE FROM posts WHERE post_id = {$the_post_id_confirm}";
        $deleted_query = mysqli_query($connection,$query);
        header("Location: posts.php");
      }
?>

<a name="" id="" class="btn btn-primary m-3" href="posts.php?source=add_post" role="button">Add new post</a>
<table class="table table-dark table-striped">
    <thead class="thead-dark">
        <tr class="table-dark">
            <th scope="col">Id</th>
            <th scope="col">Author</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Status</th>
            <th scope="col">Image</th>
            <th scope="col">tags</th>
            <th scope="col">Comments</th>
            <th scope="col">Date</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_posts)){
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comments_count = $row['post_comments_count'];
                $post_date = $row['post_date'];

                echo "<tr>";
                ?>

                <?php
                    echo "<td>$post_id</td>";

                    echo "<td>$post_author</td>";

                    echo "<td>$post_title</td>";

                    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                    $select_categories_id = mysqli_query($connection,$query);
                    while ($row = mysqli_fetch_assoc($select_categories_id)){
                        $cat_title = $row['cat_title'];
                        echo "<td>$cat_title</td>";
                    }
                    echo "<td>$post_status</td>";

                    echo "<td><img width='100' height='50' class='img_view_all' src='../images/$post_image' alt='image post' /></td>";

                    echo "<td>$post_tags</td>";

                    echo "<td>$post_comments_count</td>";

                    echo "<td>$post_date</td>";

                    echo "<td><a class='btn btn-primary' href='../post.php?post_id=$post_id' role='button'><i class='far fa-eye'></i></a></td>";

                    echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}' class='btn btn-info' ><i class='far fa-edit'></i></a></td>";                    
                ?>


                <td>                   
                    <a href="javascript:;" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deletePost(<?php echo $post_id ?>)" ><i class="far fa-trash-alt"></i></a>
                </td>

                </tr>
            <?php
            }
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        Are you sure you want to delete this post?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="" method="post">
          <input type="hidden" id="id_to_delete" name="post_id_confirm"/>
          <input type="submit" class="btn btn-danger" name="delete_confirm" value="Delete"></input>
        </form>
      </div>
    </div>
  </div>
</div>


  </div>
</div>


<script>    
    function deletePost(id){
        document.getElementById('id_to_delete').value = id;
    }
 </script>
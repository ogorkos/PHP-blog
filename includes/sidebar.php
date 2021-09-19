<div class="col-md-3 p-4">
    <div class="well ">
        <h4>Search:</h4>
            <form action="search.php" method="post">
                <input name="search" type="text" class="form-control shadow-none border border-info" />
                <button name="submit" class="btn btn-outline-info mt-2" type="submit">Send</button>
            </form>
    </div>

    <div class="well mt-5">
        <h4>Categories:</h4>
        <div class="row">
            <ul class="list-unstyled">
                <?php 
                    if (!isset($category)){$category = '';}
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query=mysqli_query($connection,$query);
                    while ($row=mysqli_fetch_array($select_all_categories_query)){
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        $category==$cat_id ? $active_cat = 'btn-primary' : $active_cat = 'btn-light';

                        echo "<form action='search.php' method='post'>";
                        echo "<input type='submit' class='form-control shadow-none border border-primary mb-2 $active_cat'  value='{$cat_title}'/>";
                        echo "<input name='category' type='hidden' class='form-control shadow-none border border-primary '  value='{$cat_id}'/>";
                        echo "</form>";
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
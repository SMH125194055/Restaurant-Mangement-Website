<?php
include 'header.php';
include 'navbar.php'
?>

<div class="col-xs-6">
    <?php
    insert_categories();
    ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="cat-title">Add Category</label>
            <input type="text" class="form-control" name="cat_title">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit" value="Add category">
        </div>
    </form>

    <?php
    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        include "includes/update_categories.php";
    }
    ?>
</div>


<div class="col-xs-6">

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Category Id</th>
                <th>Category Title</th>
                <th colspan="2">Actions</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                find_all_categories();
                delete_categories();
                ?>
            </tr>
        </tbody>
    </table>

</div>

<?php
include 'footer.php'
?>
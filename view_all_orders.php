<?php
include 'header.php';
include 'navbar.php'
?>


<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Order Id</th>
            <th>Ordered Food</th>
            <th>Ordered By</th>
            <th>Rider</th>
            <th>Total price</th>
            <th>Order Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        show_all_orders();
        ?>
    </tbody>
</table>


<?php
include 'footer.php'
?>
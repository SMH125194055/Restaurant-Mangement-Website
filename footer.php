</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>
<script src="trumbowyg/dist/trumbowyg.min.js"></script>

<script src="trumbowyg/dist/plugins/upload/trumbowyg.cleanpaste.min.js"></script>
<script src="trumbowyg/dist/plugins/upload/trumbowyg.pasteimage.min.js"></script>
<script src="js/script.js"></script>
<script>
    $(document).ready(function() {
        $('#selectAllBoxes').click(function(event) {
            if (this.checked) {
                $('.checkBoxes').each(function() {
                    this.checked = true;
                });
            } else {
                $('.checkBoxes').each(function() {
                    this.checked = false;
                });
            }
        });
    });
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<?php


$query = "SELECT * FROM food_blogs ";
$select_all_food_blogs = mysqli_query($connection, $query);
$post_count = mysqli_num_rows($select_all_food_blogs);

$query = "SELECT * FROM food_blogs WHERE post_status = 'published' ";
$select_all_published_food_blogs = mysqli_query($connection, $query);
$post_published_count = mysqli_num_rows($select_all_published_food_blogs);

$query = "SELECT * FROM food_blogs WHERE post_status = 'draft' ";
$select_all_draft_food_blogs = mysqli_query($connection, $query);
$post_draft_count = mysqli_num_rows($select_all_draft_food_blogs);

$query = "SELECT * FROM comments ";
$comments_query = mysqli_query($connection, $query);
$comment_count = mysqli_num_rows($comments_query);

$query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
$unapproved_comments_query = mysqli_query($connection, $query);
$unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);

$query = "SELECT * FROM users";
$select_all_users = mysqli_query($connection, $query);
$user_count = mysqli_num_rows($select_all_users);

$query = "SELECT * FROM users WHERE user_role = 'subscriber'";
$select_all_subscribers = mysqli_query($connection, $query);
$subscriber_count = mysqli_num_rows($select_all_subscribers);

$query = "SELECT * FROM categories";
$select_all_categories = mysqli_query($connection, $query);
$category_count = mysqli_num_rows($select_all_categories);



?>




<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],
            <?php
            $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
            $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $unapproved_comment_count, $user_count, $subscriber_count, $category_count];
            for ($i = 0; $i < 8; $i++) {
                echo "['{$element_text[$i]}', {$element_count[$i]}],";
            }
            ?>
        ]);
        var options = {
            chart: {
                title: 'Admin Information',
                subtitle: '',
            }
        };
        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, options);
    }
</script>


<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Category title', 'Blogs count'],
            <?php
            $query2 = "SELECT post_category_id,count(*) AS blog_count FROM food_blogs group by post_category_id";
            $select_all_categories_grp = mysqli_query($connection, $query2);

            while ($category_count = mysqli_fetch_assoc($select_all_categories_grp)) {
                $get_cat_title = "SELECT cat_title FROM categories Where cat_id = {$category_count['post_category_id']}";
                $select_cat_title = mysqli_query($connection, $get_cat_title);
                $cat_title_array = mysqli_fetch_assoc($select_cat_title);
                echo "['{$cat_title_array['cat_title']}', {$category_count['blog_count']}],";
            }



            ?>
        ]);

        var options = {
            title: 'Number of blogs per category',
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>

</body>

</html>
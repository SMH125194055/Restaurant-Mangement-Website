<?php
function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field is empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
            $add_query = mysqli_query($connection, $query);
            if (!$add_query) {
                die("Could not insert" . mysqli_error($connection));
            }
        }
    }
}

function show_post($blog_id)
{
    global $connection;

    $query = "SELECT * FROM food_blogs WHERE post_id = $blog_id and post_status = 'published'";
    $blog = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($blog)) {
        $post_title = $row['post_title'];
        $post_date = $row['post_date'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
    };
?>
    <h2>
        <a href="#"><?php echo "{$post_title}"; ?> </a>
    </h2>

    <p class="lead">
        by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $blog_id; ?>}"><?php echo "{$post_author}"; ?></a>
    </p>

    <p>
        <span class="glyphicon glyphicon-time"></span> <?php echo "{$post_date}"; ?>
    </p>

    <hr>
    <img class="img-responsive" src="<?php echo "images/$post_image"; ?>" alt="">
    <hr>

    <p>
        <?php echo "{$post_content}"; ?>
    </p>
    <hr>

    <!-- Blog Comments -->
    <?php
}

function blog_on_cat()
{

    global $connection;
    if (isset($_GET['category'])) {
        $cat_id = $_GET['category'];
        $title = $_GET['title'];
    }
    $query = "SELECT * FROM food_blogs where post_category_id = $cat_id and post_status = 'published'";
    $all_posts = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($all_posts)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_date = $row['post_date'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
    ?>
        <div class="cardblg">
            <div class="thumbnail">
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="left" src=<?php echo "images/$post_image"; ?> />
                </a>
            </div>
            <div class="right">
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <h1><?php echo "{$post_title}"; ?></h1>
                </a>
                <div class="author">
                    <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>">
                        <h2><?php echo "{$post_author}"; ?></h2>
                    </a>
                </div>
                <div class="separator"></div>
                <p><?php echo "{$post_content}"; ?></p>
                <h6 class="glyphicon glyphicon-time"><?php echo "{$post_date}"; ?></h6>
            </div>
        </div>
    <?php
    }
}

function bulk_options()
{
    global $connection;

    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $postValueId) {
            $bulk_options = $_POST['bulk_options'];
            switch ($bulk_options) {
                case 'published':
                    $query = "UPDATE food_blogs SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
                    $update_to_published_status = mysqli_query($connection, $query);
                    confrim_query($update_to_published_status);
                    break;
                case 'draft':
                    $query = "UPDATE food_blogs SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
                    $update_to_draft_status = mysqli_query($connection, $query);
                    confrim_query($update_to_draft_status);
                    break;
                case 'delete':
                    $query = "DELETE FROM food_blogs WHERE post_id = {$postValueId}  ";
                    $update_to_delete_status = mysqli_query($connection, $query);
                    confrim_query($update_to_delete_status);
                    break;
                case 'clone':
                    $query = "SELECT * FROM food_blogs WHERE post_id = '{$postValueId}' ";
                    $select_post_query = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($select_post_query)) {
                        $post_title         = $row['post_title'];
                        $post_category_id   = $row['post_category_id'];
                        $post_date          = $row['post_date'];
                        $post_author        = $row['post_author'];
                        $post_status        = $row['post_status'];
                        $post_image         = $row['post_image'];
                        $post_tags          = $row['post_tags'];
                        $post_content       = $row['post_content'];
                    }
                    $query = "INSERT INTO food_blogs(post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";
                    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') ";
                    $copy_query = mysqli_query($connection, $query);
                    if (!$copy_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                    break;
            }
        }
    }
}

function show_blogs()
{
    global $connection;
    $query = "SELECT * FROM food_blogs ORDER BY post_id DESC ";
    $select_food_blogs = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_food_blogs)) {
        $post_id            = $row['post_id'];
        $post_author        = $row['post_author'];
        $post_author          = $row['post_author'];
        $post_title         = $row['post_title'];
        $post_category_id   = $row['post_category_id'];
        $post_status        = $row['post_status'];
        $post_image         = $row['post_image'];
        $post_tags          = $row['post_tags'];
        $post_comments = $row['post_comments'];
        // $post_price = $row['post_price'];
        $post_date          = $row['post_date'];
        echo "<tr>";
    ?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
        <?php
        echo "<td>$post_id </td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";
        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
        $select_categories_id = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<td>$cat_title</td>";
        }
        echo "<td>$post_status</td>";
        echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
        echo "<td>$post_tags</td>";
        /// echo "<td>$post_price</td>";
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $send_comment_query = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($send_comment_query);
        $count_comments = 0;
        if ($row) {
            $comment_id = $row['comment_id'];
            $count_comments = mysqli_num_rows($send_comment_query);
        }
        echo "<td><a href='post.php?id=$post_id'>$count_comments</a></td>";
        echo "<td>$post_date </td>";
        echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
        echo "<td><a class='btn btn-primary' href='blogs.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        ?>
        <form method="post">
            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
            <?php
            echo '<td><input class="btn btn-primary" type="submit" name="delete" value="Delete"></td>';
            ?>
        </form>
        <?php
        echo "</tr>";
    }
}

function show_search_results()
{
    global $connection;
    if (isset($_GET['searchtag'])) {

        $tag = $_GET['searchtag'];
        $Squery = "SELECT * FROM food_blogs WHERE post_tags LIKE '%$tag%' and post_status = 'published'";
        $Search_query = mysqli_query($connection, $Squery);
        if (!$Search_query) {
            die("Query failed" . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_assoc($Search_query)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];
            $post_author = $row['post_author'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content']
        ?>

            <div class="cardblg">
                <div class="thumbnail">
                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                        <img class="left" src=<?php echo "images/$post_image" ?> />
                    </a>
                </div>
                <div class="right">
                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                        <h1><?php echo "{$post_title}"; ?></h1>
                    </a>
                    <div class="author">
                        <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>">
                            <h2><?php echo "{$post_author}"; ?></h2>
                        </a>
                    </div>
                    <div>
                        <p><?php echo "{$post_content}" ?></p>
                    </div>
                    <div class="separator"></div>

                    <h6 class="glyphicon glyphicon-time"><?php echo "{$post_date}"; ?></h6>
                </div>
            </div>
        <?php

        }
    }
}

function add_comment()
{
    global $connection;
    if (isset($_POST['create_comment'])) {
        $blog_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];

        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date)";
            $query .= "VALUES ($blog_id ,'{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved',now())";
            $create_comment_query = mysqli_query($connection, $query);
            if (!$create_comment_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
            $inc_query = "UPDATE food_blogs SET post_comments = post_comments + 1 WHERE post_id = $blog_id";
            $commentinc = mysqli_query($connection, $inc_query);
            if (!$commentinc) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function show_comments($blog_id)
{
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_post_id = {$blog_id} ";
    $query .= "AND comment_status = 'approved' ";
    $query .= "ORDER BY comment_id DESC ";
    $select_comment_query = mysqli_query($connection, $query);
    if (!$select_comment_query) {
        die('Query Failed' . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_array($select_comment_query)) {
        $comment_date   = $row['comment_date'];
        $comment_content = $row['comment_content'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $userquery = "SELECT * from users WHERE username = '{$comment_author}'";
        $user_image_query = mysqli_query($connection, $userquery);
        $row2 = mysqli_fetch_array($user_image_query);
        $user_image = $row2['user_image'];

        ?>
        <!-- Comment -->

        <ul class="list-unstyled">
            <li class="media">
                <img width="50px" height="50px" class="mr-3 " src=<?php echo "images/{$user_image}" ?> alt="image">
                <div class="media-body">
                    <h5 class="mt-0 mb-1"><?php echo $comment_author;   ?></h5>
                    <?php echo $comment_content ?>
                </div>
            </li>
        </ul>

    <?php }
}

function find_all_categories()
{
    // All categories
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</td>";
        echo "</tr>";
    }
}

function show_author_posts($the_post_author, $blog_id)
{
    global $connection;
    $query = "SELECT * FROM food_blogs WHERE post_author = '{$the_post_author}'  and post_status = 'published'";
    $select_all_posts_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
    ?>

        <div class="cardblg">
            <div class="thumbnail">
                <a href="post.php?p_id=<?php echo $blog_id; ?>">
                    <img class="left" src=<?php echo "images/$post_image" ?> />
                </a>
            </div>
            <div class="right">
                <a href="post.php?p_id=<?php echo $blog_id; ?>">
                    <h1><?php echo "{$post_title}"; ?></h1>
                </a>
                <div class="author">
                    <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $blog_id; ?>">
                        <h2><?php echo "{$post_author}"; ?></h2>
                    </a>
                </div>
                <div class="separator"></div>
                <p><?php echo "{$post_content}"; ?></p>
                <h6 class="glyphicon glyphicon-time"><?php echo "{$post_date}"; ?></h6>
            </div>
        </div>
    <?php
    }
}
function delete_categories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$delete_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function show_all_users()
{
    global $connection;
    $query = "SELECT * FROM users ";
    $select_users = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id             = $row['user_id'];
        $username            = $row['username'];
        $user_firstname      = $row['user_firstname'];
        $user_lastname       = $row['user_lastname'];
        $user_email          = $row['user_email'];
        $user_image          = $row['user_image'];
        $user_role           = $row['user_role'];
        $user_address      = $row['user_address'];
        $user_phonenumber  = $row['user_phonenumber'];

        echo "<tr>";
        echo "<td>$user_id </td>";
        echo "<td>$username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td><img width = 100 src = '../images/$user_image' alt ='image'</td>";
        echo "<td>$user_address</td>";
        echo "<td>$user_phonenumber</td>";
        echo "<td>$user_role</td>";
        if ($user_role == "subscriber") {
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Make Admin</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
        } else {
            echo "<td> </td>";
            echo "<td> </td>";
            echo "<td> </td>";
        }


        echo "</tr>";
    }
}


function show_all_riders()
{
    global $connection;
    $query = "SELECT * FROM riders ";
    $select_users = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {
        $rider_id             = $row['rider_id'];
        $rider_fullname    = $row['rider_fullname'];
        $rider_numberplate   = $row['rider_numberplate'];
        $rider_image        = $row['rider_image'];
        $rider_address      = $row['rider_address'];
        $rider_phonenumber  = $row['rider_phonenumber'];
        $is_free = $row['rider_free'];
        $on_order = $row['order_id'];
        if ($is_free == 1) {
            $is_free = "Yes";
        } else {
            $is_free = "No";
        }
        if ($on_order == 0) {
            $on_order = "Not delivering Orders";
        }
        echo "<tr>";
        echo "<td>$rider_id</td>";
        echo "<td>$rider_fullname</td>";
        echo "<td>$rider_numberplate</td>";
        echo "<td><img width = 100 src = '../images/$rider_image' alt ='image'</td>";
        echo "<td>$rider_address</td>";
        echo "<td>$rider_phonenumber</td>";
        echo "<td>$is_free</td>";
        echo "<td>$on_order </td>";
        echo "<td><a href='riders.php?source=edit_rider&edit_rider={$rider_id}'>Edit</a></td>";
        echo "<td><a href='riders.php?delete={$rider_id}'>Delete</a></td>";
        echo "</tr>";
    }
}



function BLOGS()
{
    global $connection;
    $query = "SELECT * FROM food_blogs WHERE post_status = 'published'";
    $all_posts = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($all_posts)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_date = $row['post_date'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content']
    ?>

        <div class="cardblg">
            <div class="thumbnail">
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="left" src=<?php echo "images/$post_image" ?> />
                </a>
            </div>
            <div class="right">
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <h1><?php echo "{$post_title}"; ?></h1>
                </a>
                <div class="author">
                    <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>">
                        <h2><?php echo "{$post_author}"; ?></h2>
                    </a>
                </div>
                <div>
                    <p><?php echo "{$post_content}" ?></p>
                </div>
                <div class="separator"></div>

                <h6 class="glyphicon glyphicon-time"><?php echo "{$post_date}"; ?></h6>
            </div>
        </div>
    <?php
    }
}

function user_changes()
{
    global $connection;

    if (isset($_GET['change_to_admin'])) {
        $the_user_id = $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id   ";
        $change_to_admin_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }

    if (isset($_GET['delete'])) {
        $the_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
}

function rider_changes()
{
    global $connection;


    if (isset($_GET['delete'])) {
        $the_user_id = $_GET['delete'];
        $query = "DELETE FROM riders WHERE rider_id = {$the_user_id} ";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: riders.php");
    }
}

function add_user()
{
    global $connection;
    $user_firstname    = $_POST['user_firstname'];
    $user_lastname     = $_POST['user_lastname'];
    $user_role         = $_POST['user_role'];
    $username          = $_POST['username'];
    $user_email        = $_POST['user_email'];
    $user_password     = $_POST['user_password'];
    $user_image        = $_FILES['image']['name'];
    $user_image_temp   = $_FILES['image']['tmp_name'];
    $user_address      = $_POST['user_address'];
    $user_phonenumber  = $_POST['user_phonenumber'];

    if (strlen(mysqli_real_escape_string($connection, $user_password)) < 8) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> Enter an strong password!
        </div>
    <?php
    }
    $user_already_exists = "SELECT username FROM users WHERE username = '{$username}'";
    $check_query =  mysqli_query($connection, $user_already_exists);
    $row = mysqli_fetch_array($check_query);

    if ($row) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> User already exists please try again!
        </div>
    <?php
    } else {
        move_uploaded_file($user_image_temp, "../images/$user_image");
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

        $query = "INSERT INTO users(user_firstname, user_lastname, user_role,username,user_email,user_password,user_image,user_address,user_phonenumber) ";
        $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}', '{$user_password}','{$user_image}','{$user_address}','{$user_phonenumber}') ";
        $create_user_query = mysqli_query($connection, $query);

        confrim_query($create_user_query);
    ?>
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Success!</strong> User added succssfully : <a href='users.php'>View Users</a>
        </div>
    <?php
    }
}

function add_rider()
{

    global $connection;
    $rider_fullname    = $_POST['rider_fullname'];
    $rider_numberplate   = $_POST['rider_numberplate'];
    $rider_image        = $_FILES['image']['name'];
    $rider_image_temp   = $_FILES['image']['tmp_name'];
    $rider_address      = $_POST['rider_address'];
    $rider_phonenumber  = $_POST['rider_phonenumber'];


    $rider_already_exists = "SELECT rider_numberplate FROM riders WHERE rider_numberplate = {$rider_numberplate}";
    $check_query =  mysqli_query($connection, $rider_already_exists);
    $row = mysqli_fetch_array($check_query);

    if ($row) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> Rider already exists please try again!
        </div>
    <?php
    } else {
        move_uploaded_file($rider_image_temp, "../images/$rider_image");

        $query = "INSERT INTO riders(rider_fullname, rider_address, rider_numberplate,rider_image,rider_phonenumber) ";
        $query .= "VALUES('{$rider_fullname}','{$rider_address}','{$rider_numberplate}','{$rider_image}','{$rider_phonenumber}') ";
        $create_rider_query = mysqli_query($connection, $query);

        confrim_query($create_rider_query);
    ?>
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Success!</strong> Rider added succssfully : <a href='users.php'>View Users</a>
        </div>
    <?php
    }
}


function show_all_orders()
{
    global $connection;
    $query = "SELECT u.username,r.rider_fullname,o.order_id,o.order_date,f.post_title,f.post_price from orders o,riders r,food_blogs f,users u ";
    $query .= "where o.subscriber_id = u.user_id and o.rider_id = r.rider_id and f.post_id = o.blog_id";
    $select_join_query = mysqli_query($connection, $query);
    while ($row1 = mysqli_fetch_array($select_join_query)) {
        $rider_fullname = $row1['rider_fullname'];
        $order_id    = $row1['order_id'];
        $username      = $row1['username'];
        $rider_fullname   = $row1['rider_fullname'];
        $order_date  = $row1['order_date'];
        $post_price = $row1['post_price'];
        $ordered_item = $row1['post_title'];
        echo "<tr>";
        echo "<td>$order_id</td>";
        echo "<td>$ordered_item</td>";
        echo "<td>$username</td>";
        echo "<td>$rider_fullname</td>";
        echo "<td>$post_price</td>";
        echo "<td>$order_date</td>";
        echo "<tr>";
    }
}

function create_post()
{
    global $connection;
    if (isset($_POST['create_post'])) {
        $post_title        = $_POST['title'];
        $post_author         = $_POST['author'];
        $post_category_id  = $_POST['post_category'];
        $post_status       = $_POST['post_status'];
        $post_image        = $_FILES['image']['name'];
        $post_image_temp   = $_FILES['image']['tmp_name'];

        $post_price = $_POST['post_price'];
        $post_tags         = $_POST['post_tags'];
        $post_content      = $_POST['post_content'];
        $post_date         = date('d-m-y');
        //$post_comments     = 4;


        move_uploaded_file($post_image_temp, "../images/$post_image");
        $query = "INSERT INTO food_blogs(post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status,post_price) ";
        $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}',{$post_price}) ";
        $create_post_query = mysqli_query($connection, $query);
        confrim_query($create_post_query);
    ?>
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Success!</strong> Post added succssfully
        </div>
<?php
    }
}
function confrim_query($result)
{
    global $connection;
    if (!$result) {
        die("Could not create " . mysqli_error($connection));
    }
}

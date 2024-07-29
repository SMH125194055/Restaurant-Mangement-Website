<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-4" style="background-image: url(<?php echo "../images/" . $_SESSION['user_image']; ?>);">

                </a>

                <ul class="list-unstyled components mb-5">



                    <li class="active">
                        <a href="adminpanel.php" data-toggle="" aria-expanded="false" class="dropdown-toggle">Restaurant Blogs</a>
                        <ul class=" list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="blogs.php?source=add_post">Add Blogs</a>
                            </li>
                            <li>
                                <a href="blogs.php">View All Blogs</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#pageSubmenu" data-toggle="" aria-expanded="false" class="dropdown-toggle">Users</a>
                        <ul class="list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="users.php">View All Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add Users</a>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="#pageSubmenu" data-toggle="" aria-expanded="false" class="dropdown-toggle">Riders</a>
                        <ul class="list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="riders.php">View All Riders</a>
                            </li>
                            <li>
                                <a href="riders.php?source=add_rider">Add Rider</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#pageSubmenu" data-toggle="" aria-expanded="false" class="dropdown-toggle">Orders</a>
                        <ul class="list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="view_all_orders.php">View All Orders</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="../landing page/index.php">Restaurant Website</a>
                    </li>
                    <li>
                        <a href="categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="comments.php">Comments</a>
                    </li>
                    <li>
                        <a href="profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="../includes/logout.php">Log Out</a>
                    </li>

                </ul>

            </div>

        </nav>
        <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </nav>
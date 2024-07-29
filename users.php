<?php
include 'header.php';
include 'navbar.php';

if (isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}
switch ($source) {
    case 'add_user';
        include 'includes/add_user.php';
        break;

    case 'edit_user';
        include "includes/edit_user.php";
        break;
    default:
        include "includes/view_all_users.php";
        break;
}

include 'footer.php';

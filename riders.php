<?php
include 'header.php';
include 'navbar.php';

if (isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}
switch ($source) {
    case 'add_rider';
        include 'includes/add_rider.php';
        break;

    case 'edit_rider';
        include "includes/edit_rider.php";
        break;
    default:
        include "includes/view_all_riders.php";
        break;
}

include 'footer.php';

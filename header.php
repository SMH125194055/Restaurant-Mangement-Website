<?php
include '../includes/db.php';
include 'functions.php';
ob_start();
session_start();
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] != 'admin') {
        header("Location: ../landing page/index.php");
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Sub urban restaurant Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">

</head>
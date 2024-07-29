<?php
include '../includes/db.php';
include 'functions.php';
ob_start();
session_start();
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] != 'admin') {
        header("Location: ../index.php");
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f9f9fa
        }

        .padding {
            padding: 3rem !important
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 50px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            border: none;
            margin-bottom: 0px;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
            background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
            background: linear-gradient(to right, #fcba03, #fc5e03);
        }

        .bg-c-lite-grey {
            background: #e6e3e1;
        }

        .user-profile {
            padding: 250px 0;
        }

        .card-block {
            padding: 5rem;
        }

        .m-b-25 {
            margin-bottom: 55px;
        }

        .img-radius {
            border-radius: 5px;
        }



        h6 {
            font-size: 16px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px) {
            p {
                font-size: 20px;
            }
        }

        .card-block {
            padding: 1rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .p-b-5 {
            padding-bottom: 30px !important;
        }

        .card .card-block p {
            line-height: 40px;
        }

        .m-b-10 {
            margin-bottom: 20px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 800;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
    </style>

</head>
<?php
include 'navbar.php'
?>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-12 col-xl-12">
                <div class="card user-card-full">
                    <div class="row m-l-4 m-r-4">
                        <div class="col-md-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25">
                                    <img width="200px" height="200px" src=<?php echo "../images/" . $_SESSION['user_image']; ?> class="img logo rounded-circle mb-4" alt="User-Profile-Image">
                                </div>

                                <h3 class="f-w-600"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h3>
                                <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                <div class="d-grid ">
                                    <?php $user_id = $_SESSION['user_id']; ?>
                                    <button class="btn btn-primary" style="background: black" )>
                                        <?php echo "<a href='users.php?source=edit_user&edit_user={$user_id}'>Edit Profile</a>" ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8  bg-c-lite-grey" height="100px">
                            <div class="card-block">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION['user_email'] ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION['user_phonenumber'] ?></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <p></p>
                                </div>
                                <div class="row">
                                    <p></p>
                                </div>
                                <div class="row">
                                    <p></p>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Address</p>
                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION['user_address'] ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Category</p>
                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION['user_role'] ?></h6>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php'
?>
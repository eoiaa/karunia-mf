<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = uri_string()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?php
    $koneksi = mysqli_connect("localhost", "root", "", "karunia_mf");
    $koneksi->set_charset('utf8mb4');
    // cek koneksi
    if (!$koneksi) {
        die("Error koneksi: " . mysqli_connect_errno());
    }

    $sql_d = "SELECT post_id FROM posts";
    $query_d = mysqli_query($koneksi, $sql_d);

    while ($data_d = mysqli_fetch_row($query_d)) {
        $post_id = $data_d[0];
        if ($page == "") {
            $pageName = "Home";
        } else if ($page == "about") {
            $pageName = "About";
        } else if ($page == "services") {
            $pageName = "Services";
        } else if ($page == "achievement") {
            $pageName = "Achievement";
        } else if ($page == "update") {
            $pageName = "Update";
        } else if ($page == "contact") {
            $pageName = "Contact";
        } else if ($page == "detail_update/$post_id") {
            $pageName = "Detail Update";
        }
    }
    ?>

    <title>KMF - <?php echo $pageName ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php

                use CodeIgniter\HTTP\SiteURI;

                echo base_url('user') ?>/assets/img/favicon.png" rel="icon">
    <link href="<?php echo base_url('user') ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('user') ?>/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url('user') ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('user') ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo base_url('user') ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url('user') ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo base_url('user') ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo base_url('user') ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url('user') ?>/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Sailor
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    .paragraph-enter {
        /* display: block; */
        white-space: pre-line;
    }

    .mx-10 {
        margin-left: 100px;
        margin-right: 100px;
    }

    @media only screen and (max-width: 768px) {
        .mx-10 {
            margin-left: 40px;
            margin-right: 40px;
        }
    }

    @media only screen and (max-width: 620px) {
        .mx-10 {
            margin-left: 10px;
            margin-right: 10px;
        }
    }
</style>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="<?php echo site_url('') ?>">
                    <img src="/header_logo/logo_kmf.svg" style="width: 150px" alt="">
                </a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="<?php echo site_url('/') ?>" class="<?php if ($page == "") {
                                                                            echo "active";
                                                                        } ?>">Home</a></li>

                    <li class="dropdown"><a href="<?php echo site_url('about') ?>" class="<?php if ($page == "about") {
                                                                                                echo "active";
                                                                                            } ?>"><span>About</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?php echo site_url('about') ?>#about">About</a></li>
                            <li><a href="<?php echo site_url('about') ?>#vision-mission">Vision and Mission</a></li>
                            <li><a href="<?php echo site_url('about') ?>#history">Company History</a></li>
                            <li><a href="<?php echo site_url('about') ?>#team">Team</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="<?php echo site_url('services') ?>" class="<?php if ($page == "services") {
                                                                                                    echo "active";
                                                                                                } ?>"><span>Services</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <?php
                            $sql_s = "SELECT services_id, services_name FROM services";
                            $query_s = mysqli_query($koneksi, $sql_s);
                            while ($data_s = mysqli_fetch_row($query_s)) {
                                $services_id = $data_s[0];
                                $services_name = $data_s[1];
                            ?>
                                <li><a href="<?php echo site_url('services') ?>#accordionContoh<?php echo $services_id ?>"><?php echo $services_name ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>

                    <li><a href="<?php echo site_url('achievement') ?>" class="<?php if ($page == "achievement") {
                                                                                    echo "active";
                                                                                } ?>">Achievement</a></li>

                    <li><a href="<?php echo site_url('update') ?>" class="<?php if ($page == "update") {
                                                                                echo "active";
                                                                            } else if ($page == "detail_update/$post_id") {
                                                                                echo "active";
                                                                            } ?>">Update</a></li>

                    <li><a href="<?php echo site_url('contact') ?>" class="<?php if ($page == "contact") {
                                                                                echo "active";
                                                                            } ?>">Contact</a></li>

                    <li><a href="<?php
                                    if ($page == "") {
                                        echo "#";
                                    } else {
                                        echo site_url('');
                                    }
                                    ?>" class="getstarted">Get Started</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
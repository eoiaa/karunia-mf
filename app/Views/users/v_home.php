<?php
$koneksi = mysqli_connect("localhost", "root", "", "karunia_mf");
$koneksi->set_charset('utf8mb4');
// cek koneksi
if (!$koneksi) {
    die("Error koneksi: " . mysqli_connect_errno());
}
?>
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <?php
        foreach ($record as $key => $value) {
        ?>

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url(/jumbotron/<?php echo $value['home_jumbotron_image'] ?>)">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown"><?php echo (isset($value['home_jumbotron_title'])) ? $value['home_jumbotron_title'] : '' ?></span></h2>
                            <p class="animate__animated animate__fadeInUp"><?php echo (isset($value['home_jumbotron_description'])) ? $value['home_jumbotron_description'] : '' ?></p>
                            <?php if (!$value['home_jumbotron_button_text'] == '') { ?>
                                <a href="<?php echo (isset($value['home_jumbotron_button_link'])) ? $value['home_jumbotron_button_link'] : '' ?>" class="btn-get-started animate__animated animate__fadeInUp scrollto"><?php echo (isset($value['home_jumbotron_button_text'])) ? $value['home_jumbotron_button_text'] : '' ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        <?php  } ?>
    </div>
</section><!-- End Hero -->

<main id="main">
    <?php
    $sql_d = "SELECT about_id, about_description_title, about_description_desc, about_description_right_section FROM about";
    $query_d = mysqli_query($koneksi, $sql_d);

    while ($data_d = mysqli_fetch_row($query_d)) {
        $about_id = $data_d[0];
        $about_description_title = $data_d[1];
        $about_description_desc = $data_d[2];
        $about_description_right_section = $data_d[3];
    ?>
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <div class="row content">
                    <div class="col-lg-6">
                        <h2><?php echo (isset($about_description_title)) ?  $about_description_title : '' ?></h2>
                        <h3><?php echo (isset($about_description_desc)) ?  $about_description_desc : '' ?></h3>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <p class="paragraph-enter"><?php echo (isset($about_description_right_section)) ?  $about_description_right_section : '' ?></p>
                    </div>
                </div>
            </div>
        </section><!-- End About Section -->
    <?php } ?>

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
        <div class="container my-4">

            <div class="row">
                <?php
                $sql_b = "SELECT brand_id, brand_logo FROM brand";
                $query_b = mysqli_query($koneksi, $sql_b);

                while ($data_b = mysqli_fetch_row($query_b)) {
                    $brand_id = $data_b[0];
                    $brand_logo = $data_b[1];
                ?>
                    <div class="col-md-4 my-5 col-6 d-flex align-items-center justify-content-center">
                        <img src="/brand/<?php echo isset($brand_logo) ? $brand_logo : "" ?>" class="img-fluid" alt="">
                    </div>
                <?php } ?>

            </div>

        </div>

        </div>
    </section><!-- End Clients Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

            <div class="row">
                <?php
                $sql_s = "SELECT services_id, services_name, services_description FROM services";
                $query_s = mysqli_query($koneksi, $sql_s);
                while ($data_s = mysqli_fetch_row($query_s)) {
                    $services_id = $data_s[0];
                    $services_name = $data_s[1];
                    $services_description = $data_s[2];
                ?>
                    <div class="col-md-6">
                        <div class="icon-box">
                            <i class="bi bi-gear-fill"></i>
                            <h4><a href="<?php echo site_url('services') ?>#accordionContoh<?php echo $services_id ?>"><?php echo isset($services_name) ? $services_name : "" ?></a></h4>
                            <p><?php echo isset($services_description) ? $services_description : "" ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="row portfolio-container">

                <?php
                $sql_o = "SELECT achievement_id, achievement_image, achievement_title, achievement_description, achievement_date, achievement_category FROM achievement";
                $query_o = mysqli_query($koneksi, $sql_o);
                while ($data_o = mysqli_fetch_row($query_o)) {
                    $achievement_id = $data_o[0];
                    $achievement_image = $data_o[1];
                    $achievement_title = $data_o[2];
                    $achievement_description = $data_o[3];
                    $achievement_date = $data_o[4];
                    $achievement_category = $data_o[5];
                ?>
                    <div class="col-lg-4 col-md-6 portfolio-item">
                        <div class="portfolio-wrap">
                            <img src="/achievement/<?php echo $achievement_image ?>" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4><?php echo (isset($achievement_title)) ? $achievement_title : "" ?></h4>
                                <p><?php echo (isset($achievement_date)) ? tanggal_indonesia_user($achievement_date) : "" ?></p>
                                <div class="portfolio-links">
                                    <a href="/achievement/<?php echo $achievement_image ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo (isset($achievement_title)) ? $achievement_title : "" ?>"><i class='bx bx-image-alt'></i></a>
                                    <a href="<?php echo site_url("detail_achievement/$achievement_id") ?>" class="portfolio-details-lightbox" data-glightbox="type: external" title="Details"><i class='bx bx-info-circle'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->
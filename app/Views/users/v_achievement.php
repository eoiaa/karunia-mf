<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Achievement</h2>
                <ol>
                    <li><a href="<?php echo site_url('/') ?>">Home</a></li>
                    <li>Achievement</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="row portfolio-container">

                <?php
                foreach ($record as $key => $value) {
                    $achievement_id = $value['achievement_id'];
                ?>
                    <div class="col-lg-4 col-md-6 portfolio-item">
                        <div class="portfolio-wrap">
                            <img src="/achievement/<?php echo $value['achievement_image'] ?>" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4><?php echo (isset($value['achievement_title'])) ? $value['achievement_title'] : "" ?></h4>
                                <p><?php echo (isset($value['achievement_date'])) ? tanggal_indonesia_user($value['achievement_date']) : "" ?></p>
                                <div class="portfolio-links">
                                    <a href="/achievement/<?php echo $value['achievement_image'] ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo (isset($value['achievement_title'])) ? $value['achievement_title'] : "" ?>"><i class='bx bx-image-alt'></i></a>
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
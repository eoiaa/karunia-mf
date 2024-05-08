<main id="main">

    <!-- ======= Portfolio Details Section ======= -->
    <?php
    helper('global_fungsi_helper')
    ?>
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">
                                <img src="<?php echo base_url(LOKASI_UPLOAD_ACHIEVEMENT . "/" . $achievement_image) ?>" alt="">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>Achievement information</h3>
                        <ul>
                            <li><strong>Category</strong>: <?php echo (isset($achievement_category)) ? $achievement_category : "" ?></li>
                            <li><strong>Achievement date</strong>: <?php echo (isset($achievement_date)) ? tanggal_indonesia_user($achievement_date) : "" ?></li>
                        </ul>
                    </div>
                    <div class="portfolio-description">
                        <h2><?php echo (isset($achievement_title)) ? $achievement_title : "" ?></h2>
                        <p class="paragraph-enter">
                            <?php echo (isset($achievement_description)) ? $achievement_description : "" ?>
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Services</h2>
                <ol>
                    <li><a href="<?php echo site_url('/') ?>">Home</a></li>
                    <li>Services</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
        <div class="container">
            <div class="section-title">
                <h2>Services</h2>
                <p>Check our Services</p>
            </div>
        </div>
        <div class="accordion my-5 mx-10" id="accordionExample">
            <?php foreach ($record as $key => $value) { ?>
                <div class="accordion-item" id="accordionContoh<?php echo $value['services_id'] ?>">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $value['services_id'] ?>" aria-expanded="true" aria-controls="collapseOne">
                            <h5><?php echo $value['services_name'] ?></h5>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $value['services_id'] ?>" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <img src="/services_image/<?php echo $value['services_image'] ?>" class="img-thumbnail mx-auto w-50 d-block" alt="">
                            <p class="paragraph-enter my-5"><?php echo $value['services_description'] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section><!-- End Features Section -->

</main><!-- End #main -->
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Update</h2>
                <ol>
                    <li><a href="<?php echo site_url('/') ?>">Home</a></li>
                    <li>Update</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">
                    <?php
                    foreach ($record as $key => $value) {
                        $post_id = $value['post_id'];
                        if ($value['post_status'] == 'active') {
                    ?>
                            <article class="entry">

                                <div class="entry-img">
                                    <img src="/upload/<?php echo $value['post_thumbnail'] ?>" alt="" class="img-fluid">
                                </div>


                                <h2 class="entry-title">
                                    <a href="<?php echo site_url("detail_update/$post_id") ?>"><?php echo (isset($value['post_title'])) ? $value['post_title'] : '' ?></a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="<?php echo site_url("detail_update/$post_id") ?>"><?php echo post_penulis($value['username']) ?></a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="<?php echo site_url("detail_update/$post_id") ?>"><time datetime="2020-01-01"><?php echo tanggal_indonesia_user($value['post_time']) ?></time></a></li>
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <p>
                                        <?php echo (isset($value['post_description'])) ? $value['post_description'] : '' ?>
                                    </p>
                                    <div class="read-more">
                                        <a href="<?php echo site_url("detail_update/$post_id") ?>">Read More</a>
                                    </div>
                                </div>

                            </article><!-- End blog entry -->
                    <?php $nomor++;
                        }
                    } ?>

                    <?php echo $pager->links('ft', 'datatable_user') ?>

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Search</h3>
                        <div class="sidebar-item search-form">
                            <form action="" method="GET">
                                <input type="text" name="katakunci" value="<?php echo $katakunci ?>">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search formn-->

                    </div><!-- End sidebar recent posts-->

                </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

        </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->
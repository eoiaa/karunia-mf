<?php
$koneksi = mysqli_connect("localhost", "root", "", "karunia_mf");
$koneksi->set_charset('utf8mb4');
// cek koneksi
if (!$koneksi) {
    die("Error koneksi: " . mysqli_connect_errno());
}
?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Update Detail</h2>
                <ol>
                    <li><a href="<?php echo site_url('/') ?>">Home</a></li>
                    <li><a href="<?php echo site_url('/update') ?>">Update</a></li>
                    <li>Update Detail</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            <img src="<?php echo base_url(LOKASI_UPLOAD . "/" . $post_thumbnail) ?>" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a><?php echo (isset($post_title)) ? $post_title : "" ?></a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <?php
                                helper('global_fungsi_helper');
                                ?>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i><?php echo tanggal_indonesia_user($post_time) ?></li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <?php if ($post_content == "") {
                                echo "";
                            } else {
                            ?>
                                <p class="paragraph-enter"><?php echo (isset($post_content)) ? $post_content : "" ?></p>
                            <?php } ?>
                            <?php if ($post_file == "") {
                                echo "";
                            } else {
                            ?>
                                <iframe src="<?php echo base_url(LOKASI_UPLOAD_FILE . "/" . $post_file) ?>" height="1000px" width="100%"></iframe>
                            <?php } ?>
                        </div>

                    </article><!-- End blog entry -->

                    <div class="blog-author d-flex align-items-center">
                        <img src="/pp/anime.jpg" class="rounded-circle float-left" alt="">
                        <div>
                            <h4><?php echo $username ?></h4>
                            <p class="mt-2">
                                Writer
                            </p>
                        </div>
                    </div><!-- End blog author bio -->

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Recent Posts</h3>
                        <div class="sidebar-item recent-posts">
                            <?php
                            helper('global_fungsi_helper');
                            $sql_d = "SELECT post_id, post_title, post_thumbnail, post_time FROM posts WHERE post_type = 'article' LIMIT 10";
                            $query_d = mysqli_query($koneksi, $sql_d);

                            while ($data_d = mysqli_fetch_row($query_d)) {
                                $post_id = $data_d[0];
                                $post_title = $data_d[1];
                                $post_thumbnail = $data_d[2];
                                $post_time = $data_d[3];
                            ?>
                                <div class="post-item clearfix">
                                    <img src="<?php echo base_url(LOKASI_UPLOAD . "/" . $post_thumbnail) ?>" alt="">
                                    <h4><a href="<?php echo site_url("detail_update/$post_id") ?>"><?php echo $post_title ?></a></h4>
                                    <time><?php echo tanggal_indonesia_user($post_time) ?></time>
                                </div>
                            <?php } ?>
                        </div><!-- End sidebar recent posts-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->
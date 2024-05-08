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
                <h2>About</h2>
                <ol>
                    <li><a href="<?php echo site_url('/') ?>">Home</a></li>
                    <li>About</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <?php
    $sql_d = "SELECT about_id, about_description_title, about_description_desc, about_description_right_section, about_vision, about_mission, about_company_history FROM about";
    $query_d = mysqli_query($koneksi, $sql_d);

    while ($data_d = mysqli_fetch_row($query_d)) {
        $about_id = $data_d[0];
        $about_description_title = $data_d[1];
        $about_description_desc = $data_d[2];
        $about_description_right_section = $data_d[3];
        $about_vision = $data_d[4];
        $about_mission = $data_d[5];
        $about_company_history = $data_d[6];
    ?>
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
        </section>
        <!-- End About Section -->

        <section id="vision-mission" class="vision-mission section-bg">
            <div class="container">
                <div class="section-title">
                    <h2>Vision and Mission</h2>
                    <p>Vision</p>
                </div>
                <h1 class="text-center">"<?php echo $about_vision ?>"</h1>
                <div class="section-title pt-5">
                    <h2>Vision and Mission</h2>
                    <p>Mission</p>
                    <div class="my-4 px-5">
                        <h5 class="paragraph-enter"><?php echo (isset($about_mission)) ? $about_mission : '' ?></h5>
                    </div>
                </div>
            </div>
        </section>

        <section id="history">
            <div class="container">
                <div class="section-title">
                    <h2>History</h2>
                    <p>Company History</p>
                </div>
                <div class="my-4 px-5">
                    <h5 class="paragraph-enter"><?php echo (isset($about_company_history)) ?  $about_company_history : '' ?></h5>
                </div>
            </div>
        </section>
    <?php } ?>

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Team</h2>
                <p>Our Management Team</p>
            </div>

            <div class="row">
                <?php
                $sql_t = "SELECT management_team_id, management_team_image, management_team_job, management_team_name, management_team_description FROM management_team";
                $query_t = mysqli_query($koneksi, $sql_t);

                while ($data_t = mysqli_fetch_row($query_t)) {
                    $management_team_id = $data_t[0];
                    $management_team_image = $data_t[1];
                    $management_team_job = $data_t[2];
                    $management_team_name = $data_t[3];
                    $management_team_description = $data_t[4];
                ?>
                    <div class="col-lg-6 mt-4">
                        <div class="member align-items-start">
                            <div class=""><img src="/management_team/<?php echo $management_team_image ?>" class="img-fluid" alt=""></div>
                            <div class="member-info mt-5">
                                <h4><?php echo (isset($management_team_name)) ? $management_team_name  : '' ?></h4>
                                <span><?php echo (isset($management_team_job)) ? $management_team_job  : '' ?></span>
                                <p><?php echo (isset($management_team_description)) ? $management_team_description  : '' ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </section><!-- End Team Section -->

</main><!-- End #main -->
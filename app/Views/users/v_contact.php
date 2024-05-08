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
                <h2>Contact</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Contact</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div>
                <iframe style="border:0; width: 100%; height: 270px;" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Graha%20Anabatic%20Jl.%20Scientia%20Boulevard%20kav%20U2,%20Summarecon%20Gading%20Serpong+(Karunia%20Multifinance)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="row mt-5">
                <?php
                $sql_d = "SELECT contact_id, contact_location, contact_phone, contact_email FROM contact";
                $query_d = mysqli_query($koneksi, $sql_d);

                while ($data_d = mysqli_fetch_row($query_d)) {
                    $contact_id = $data_d[0];
                    $contact_location = $data_d[1];
                    $contact_phone = $data_d[2];
                    $contact_email = $data_d[3];
                ?>
                    <div class="col-lg-4">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location :</h4>
                                <p><?php echo (isset($contact_location)) ? $contact_location : "" ?></p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email :</h4>
                                <p><?php echo (isset($contact_email)) ? $contact_email : "" ?></p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call :</h4>
                                <p><?php echo (isset($contact_phone)) ? $contact_phone : "" ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-lg-8 mt-5 mt-lg-0">

                    <form action="" method="POST" enctype="multipart/form-data" class="email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="messages_name" class="form-control" id="input_messages_name" placeholder="Your Name">
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="messages_email" id="input_messages_email" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="messages_subject" id="input_messages_subject" placeholder="Subject">
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="messages_description" id="input_messages_description" rows="5" placeholder="Message"></textarea>
                        </div>
                        <?php
                        $session = \Config\Services::session();
                        if ($session->getFlashData('warning')) {
                        ?>
                            <div class="alert alert-warning">
                                <ul>
                                    <?php
                                    foreach ($session->getFlashData('warning') as $val) {
                                    ?>
                                        <li><?php echo $val ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        }
                        if ($session->getFlashData('success')) {
                        ?>
                            <div class="alert alert-success"><?php echo $session->getFlashData('success') ?></div>
                        <?php
                        }
                        ?>

                        <div class="text-center"><button type="submit" name="submit">Send</button></div>
                    </form>

                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->
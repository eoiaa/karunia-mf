<?php
$koneksi = mysqli_connect("localhost", "root", "", "karunia_mf");
$koneksi->set_charset('utf8mb4');
// cek koneksi
if (!$koneksi) {
    die("Error koneksi: " . mysqli_connect_errno());
}
$page = uri_string();
?>
<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-info">
                        <?php
                        $sql_d = "SELECT contact_id, contact_location, contact_phone, contact_email FROM contact";
                        $query_d = mysqli_query($koneksi, $sql_d);

                        while ($data_d = mysqli_fetch_row($query_d)) {
                            $contact_id = $data_d[0];
                            $contact_location = $data_d[1];
                            $contact_phone = $data_d[2];
                            $contact_email = $data_d[3];
                        ?>
                            <h3>Karunia Multifinance</h3>
                            <p>
                                <?php echo $contact_location ?><br><br>
                                <strong>Phone:</strong> <?php echo $contact_phone ?><br>
                                <strong>Email:</strong> <?php echo $contact_email ?><br>
                            </p>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php
                                                                            if ($page == "") {
                                                                                echo "#";
                                                                            } else {
                                                                                echo site_url("");
                                                                            }
                                                                            ?>">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php echo site_url('about') ?>">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php echo site_url('services') ?>">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php echo site_url('achievement') ?>">Achievement</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php echo site_url('update') ?>">Update</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <?php
                        $sql_s = "SELECT services_id, services_name FROM services";
                        $query_s = mysqli_query($koneksi, $sql_s);
                        while ($data_s = mysqli_fetch_row($query_s)) {
                            $services_id = $data_s[0];
                            $services_name = $data_s[1];
                        ?>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo site_url('services') ?>#accordionContoh<?php echo $services_id ?>"><?php echo $services_name ?></a></li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>Karunia Multifinance</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/sailor-free-bootstrap-theme/ -->
            Designed by <a href="#">Phain</a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?php echo base_url('user') ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('user') ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url('user') ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url('user') ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url('user') ?>/assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="<?php echo base_url('user') ?>/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo base_url('user') ?>/assets/js/main.js"></script>

</body>

</html>
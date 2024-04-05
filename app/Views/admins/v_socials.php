<?php
$templateJudul = "Social Media";
$templateSubJudul = "Form Tambah Social Media";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $templateJudul ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><?php echo $templateSubJudul ?></li>
            </ol>
            <div class="card mb-4">
                <!-- <div class="card-header">
                    <i class="fa fa-plus"></i>
                </div> -->
                <div class="card-body">
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="input_set_socials_instagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" id="input_set_socials_instagram" name="set_socials_instagram" value="<?php echo (isset($set_socials_instagram)) ? $set_socials_instagram : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_set_socials_facebook" class="form-label">Facebook</label>
                            <input type="text" class="form-control" id="input_set_socials_facebook" name="set_socials_facebook" value="<?php echo (isset($set_socials_facebook)) ? $set_socials_facebook : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_set_socials_twitter" class="form-label">Twitter</label>
                            <input type="text" class="form-control" id="input_set_socials_twitter" name="set_socials_twitter" value="<?php echo (isset($set_socials_twitter)) ? $set_socials_twitter : "" ?>">
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
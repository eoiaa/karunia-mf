<?php
$templateJudul = "Contact";
$templateSubJudul = "Form Tambah Contact";
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
                            <label for="input_contact_location" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="input_contact_location" name="contact_location" value="<?php echo (isset($contact_location)) ? $contact_location : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_contact_phone" class="form-label">No. Telp</label>
                            <input type="text" class="form-control" id="input_contact_phone" name="contact_phone" value="<?php echo (isset($contact_phone)) ? $contact_phone : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_contact_email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="input_contact_email" name="contact_email" value="<?php echo (isset($contact_email)) ? $contact_email : "" ?>">
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
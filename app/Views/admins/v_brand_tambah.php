<?php
$templateJudul = "Brand";
$templateSubJudul = "Form Tambah Brand";
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
                        <?php
                        if (isset($brand_logo)) {
                        ?>
                            <div class="mb-3">
                                <img src="<?php echo base_url(LOKASI_UPLOAD_BRAND . "/" . $brand_logo) ?>" class="pb-2 mb-2 img-thumbnail w-50" alt="">
                            </div>
                        <?php
                        }
                        ?>
                        <div class="mb-3">
                            <label for="input_brand_logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="input_brand_logo" name="brand_logo">
                        </div>
                        <div class="mb-3">
                            <label for="input_brand_name" class="form-label">Nama Brand</label>
                            <input type="text" class="form-control" id="input_brand_name" name="brand_name" value="<?php echo (isset($brand_name)) ? $brand_name : "" ?>">
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
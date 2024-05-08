<?php
$templateJudul = "Management Team";
$templateSubJudul = "Form Tambah Management Team";
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
                        if (isset($management_team_image)) {
                        ?>
                            <div class="mb-3">
                                <img src="<?php echo base_url(LOKASI_UPLOAD_MANAGEMENT_TEAM . "/" . $management_team_image) ?>" class="pb-2 mb-2 img-thumbnail w-50" alt="">
                            </div>
                        <?php
                        }
                        ?>
                        <div class="mb-3">
                            <label for="input_management_team_image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="input_management_team_image" name="management_team_image">
                        </div>
                        <div class="mb-3">
                            <label for="input_management_team_job" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="input_management_team_job" name="management_team_job" value="<?php echo (isset($management_team_job)) ? $management_team_job : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_management_team_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="input_management_team_name" name="management_team_name" value="<?php echo (isset($management_team_name)) ? $management_team_name : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="summernote" class="form-label">Deskripsi Diri</label>
                            <textarea class="form-control" name="management_team_description" id="summernote" rows="10"><?php echo (isset($management_team_description)) ? $management_team_description : '' ?></textarea>
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
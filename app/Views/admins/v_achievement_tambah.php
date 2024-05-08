<?php
$templateJudul = "Achievement";
$templateSubJudul = "Form Tambah Achievement";
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
                        if (isset($achievement_image)) {
                        ?>
                            <div class="mb-3">
                                <img src="<?php echo base_url(LOKASI_UPLOAD_ACHIEVEMENT . "/" . $achievement_image) ?>" class="pb-2 mb-2 img-thumbnail w-50" alt="">
                            </div>
                        <?php
                        }
                        ?>
                        <div class="mb-3">
                            <label for="input_achievement_image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="input_achievement_image" name="achievement_image">
                        </div>
                        <div class="mb-3">
                            <label for="input_achievement_title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="input_achievement_title" name="achievement_title" value="<?php echo (isset($achievement_title)) ? $achievement_title : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_achievement_category" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="input_achievement_category" name="achievement_category" value="<?php echo (isset($achievement_category)) ? $achievement_category : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="summernote" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="achievement_description" id="summernote" rows="10"><?php echo (isset($achievement_description)) ? $achievement_description : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="date" name="achievement_date" id="input_achievement_date" class="form-control">
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
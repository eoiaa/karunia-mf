<?php
$templateJudul = "Home Description";
$templateSubJudul = "Form Tambah Home Description";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $templateJudul ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><?php echo $templateSubJudul ?></li>
            </ol>
            <div class="card mb-4">
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
                            <label for="input_home_description_title" class="form-label">Judul Home Description</label>
                            <input type="text" class="form-control" id="input_home_description_title" name="home_description_title" value="<?php echo (isset($home_description_title)) ? $home_description_title : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_home_description_desc" class="form-label">Deskripsi Home Description</label>
                            <textarea class="form-control" name="home_description_desc" id="input_home_description_desc" rows="2"><?php echo (isset($home_description_desc)) ? $home_description_desc : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="summernote" class="form-label">Konten di Kanan</label>
                            <textarea class="form-control" name="home_description_right_section" id="summernote" rows="10"><?php echo (isset($home_description_right_section)) ? $home_description_right_section : '' ?></textarea>
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php
$templateJudul = "About";
$templateSubJudul = "Form Tambah About";
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
                            <label for="input_about_description_title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="input_about_description_title" name="about_description_title" value="<?php echo (isset($about_description_title)) ? $about_description_title : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_about_description_desc" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="about_description_desc" id="input_about_description_desc" rows="2"><?php echo (isset($about_description_desc)) ? $about_description_desc : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="summernote" class="form-label">Konten di Kanan</label>
                            <textarea class="form-control" name="about_description_right_section" id="summernote" rows="10"><?php echo (isset($about_description_right_section)) ? $about_description_right_section : '' ?></textarea>
                        </div>
                        <h3>Visi dan Misi</h3>
                        <div class="mb-3">
                            <label for="input_about_vision" class="form-label">Visi</label>
                            <input type="text" class="form-control" id="input_about_vision" name="about_vision" value="<?php echo (isset($about_vision)) ? $about_vision : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="summernote" class="form-label">Konten di Kanan</label>
                            <textarea class="form-control" name="about_mission" id="summernote" rows="10"><?php echo (isset($about_mission)) ? $about_mission : '' ?></textarea>
                        </div>
                        <h3>History</h3>
                        <div class="mb-3">
                            <label for="summernote" class="form-label">Company History</label>
                            <textarea class="form-control" name="about_company_history" id="summernote" rows="10"><?php echo (isset($about_company_history)) ? $about_company_history : '' ?></textarea>
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
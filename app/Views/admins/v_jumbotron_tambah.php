<?php
$templateJudul = "Jumbotron";
$templateSubJudul = "Form Tambah Jumbotron";
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
                        if (isset($jumbotron_image)) {
                        ?>
                            <div class="mb-3">
                                <img src="<?php echo base_url(LOKASI_UPLOAD_JUMBOTRON . "/" . $jumbotron_image) ?>" class="pb-2 mb-2 img-thumbnail w-50" alt="">
                            </div>
                        <?php
                        }
                        ?>
                        <div class="mb-3">
                            <label for="input_jumbotron_image" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="input_jumbotron_image" name="jumbotron_image">
                        </div>
                        <div class="mb-3">
                            <label for="input_jumbotron_title" class="form-label">Judul Jumbotron</label>
                            <input type="text" class="form-control" id="input_jumbotron_title" name="jumbotron_title" value="<?php echo (isset($jumbotron_title)) ? $jumbotron_title : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_jumbotron_description" class="form-label">Deskripsi Jumbotron</label>
                            <textarea class="form-control" name="jumbotron_description" id="input_jumbotron_description" rows="2"><?php echo (isset($jumbotron_description)) ? $jumbotron_description : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="input_jumbotron_button_text" class="form-label">Button Text</label>
                            <input type="text" class="form-control" id="input_jumbotron_button_text" name="jumbotron_button_text" value="<?php echo (isset($jumbotron_button_text)) ? $jumbotron_button_text : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_jumbotron_button_link" class="form-label">Button Link</label>
                            <input type="text" class="form-control" id="input_jumbotron_button_link" name="jumbotron_button_link" value="<?php echo (isset($jumbotron_button_link)) ? $jumbotron_button_link : "" ?>">
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
                        </div>
                        <!-- <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php
$templateJudul = "Update";
$templateSubJudul = "Form Tambah Update";
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
                            <label for="input_post_title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="input_post_title" name="post_title" value="<?php echo (isset($post_title)) ? $post_title : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="input_post_status" class="form-label">Status</label>
                            <select name="post_status" class="form-select" id="">
                                <option value="active" <?php echo (isset($post_status) && $post_status == 'active') ? "selected" : "" ?>>Aktif</option>
                                <option value="inactive" <?php echo (isset($post_status) && $post_status == 'inactive') ? "selected" : "" ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <?php
                        if (isset($post_thumbnail)) {
                        ?>
                            <div class="mb-3">
                                <img src="<?php echo base_url(LOKASI_UPLOAD . "/" . $post_thumbnail) ?>" class="pb-2 mb-2 img-thumbnail w-50" alt="">
                            </div>
                        <?php
                        }
                        ?>
                        <div class="mb-3">
                            <label for="input_post_thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="input_post_thumbnail" name="post_thumbnail">
                        </div>
                        <div class="mb-3">
                            <label for="input_post_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="post_description" id="input_post_description" rows="2"><?php echo (isset($post_description)) ? $post_description : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="summernote" class="form-label">Konten</label>
                            <textarea class="form-control" name="post_content" id="summernote" rows="10"><?php echo (isset($post_content)) ? $post_content : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="input_post_file" class="form-label">File PDF</label>
                            <input type="file" class="form-control" id="input_post_file" name="post_file">
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
<?php
$templateJudul = "Akun";
$templateSubJudul = "Form Update Akun";
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
                            <label for="input_nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="input_nama_lengkap" name="nama_lengkap" value="<?php echo (isset($nama_lengkap)) ? $nama_lengkap : "" ?>">
                        </div>
                        <div class="mb-3 col-lg-6">
                            <h4>Ganti Password</h4>
                        </div>
                        <div class="mb-3">
                            <label for="input_password_lama" class="form-label">Password Lama</label>
                            <input type="password" class="form-control" id="input_password_lama" name="password_lama">
                        </div>
                        <div class="mb-3">
                            <label for="input_password_baru" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="input_password_baru" name="password_baru">
                        </div>
                        <div class="mb-3">
                            <label for="input_password_baru_konfirmasi" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="input_password_baru_konfirmasi" name="password_baru_konfirmasi">
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
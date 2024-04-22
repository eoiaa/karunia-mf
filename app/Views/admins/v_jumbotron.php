<?php
$templateJudul = "Jumbotron";
$templateSubJudul = "List Jumbotron";
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
                    <i class="fas fa-table me-1"></i>
                </div> -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col lg-3 py-1">
                            <form action="" method="GET">
                                <input type="text" placeholder="Cari..." name="katakunci" class="form-control" value="<?php echo $katakunci ?>">
                            </form>
                        </div>
                        <div class="col lg-9 py-1 text-end">
                            <a href="<?php echo site_url('admins/jumbotron/tambah') ?>" class="btn btn-xl btn-primary">Tambah Jumbotron</a>
                        </div>
                    </div>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-1">No.</th>
                                <th class="col-6">Judul</th>
                                <th class="col-3">Tanggal</th>
                                <th class="col-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($record as $value) {
                                $jumbotron_id = $value['jumbotron_id'];
                                $link_edit = site_url("admins/jumbotron/edit/$jumbotron_id");
                                $link_delete = site_url("admins/jumbotron/?aksi=hapus&jumbotron_id=$jumbotron_id");
                            ?>
                                <tr>
                                    <td><?php echo $nomor ?>.</td>
                                    <td><img src="/jumbotron/<?php echo $value['jumbotron_image'] ?>" width="200" alt=""></td>
                                    <td><?php echo $value['jumbotron_title'] ?></td>
                                    <td><?php echo $value['jumbotron_description'] ?></td>
                                    <td>
                                        <a href="<?php echo $link_edit ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?php echo $link_delete ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-sm btn-danger">Del</a>
                                    </td>
                                </tr>
                            <?php
                                $nomor++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php echo $pager->links('dt', 'datatable') ?>
                </div>
            </div>
        </div>
    </main>
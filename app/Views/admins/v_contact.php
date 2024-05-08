<?php
$templateJudul = "Contact";
$templateSubJudul = "List Contact";
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
                            <?php
                            $koneksi = mysqli_connect('localhost', 'root', '', 'karunia_mf');

                            $dataContact = mysqli_query($koneksi, "SELECT * FROM contact");

                            $jumlahContact = mysqli_num_rows($dataContact);
                            ?>
                            <?php
                            if (!$jumlahContact >= 1) {
                            ?>
                                <a href="<?php echo site_url('admins/contact/tambah') ?>" class="btn btn-xl btn-primary">Tambah Contact</a>
                            <?php } ?>
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
                                <th class="col-6">Phone</th>
                                <th class="col-3">Email</th>
                                <th class="col-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($record as $value) {
                                $contact_id = $value['contact_id'];
                                $link_edit = site_url("admins/contact/edit/$contact_id");
                                $link_delete = site_url("admins/contact/?aksi=hapus&contact_id=$contact_id");
                            ?>
                                <tr>
                                    <td><?php echo $nomor ?>.</td>
                                    <td><?php echo $value['contact_phone'] ?></td>
                                    <td><?php echo $value['contact_email'] ?></td>
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
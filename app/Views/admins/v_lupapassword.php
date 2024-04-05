<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                </div>
                                <div class="card-body">
                                    <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
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
                                    <form action="" method="POST">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="inputEmail" name="username" value="<?php if ($session->getFlashdata('username')) echo $session->getFlashdata('username') ?>" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address / Username</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="<?php echo site_url('admins') ?>">Return to login</a>
                                            <!-- <a class="btn btn-primary" href="login.html">Reset Password</a> -->
                                            <input type="submit" class="btn btn-primary" name="submit" value="Kirim Email Recovery">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <!-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
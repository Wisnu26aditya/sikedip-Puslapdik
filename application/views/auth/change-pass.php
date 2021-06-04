<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><img src="<?= base_url();?>assets/img/hd.png" width="120px" height="80px"></h1>
                                    <h2 class="h4 text-gray-900 mb-4">Change your password for</h2>
                                    <h5><?= $this->session->userdata('reset_email'); ?></h5>
                                </div>
                                <?= $this->session->flashdata('messege'); ?>
                                <form class="user" method="post" action="<?= base_url('auth/changepass'); ?>">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="pass1" name="pass1" aria-describedby="passHelp" placeholder="Enter New Password...">
                                        <?= form_error('pass1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="pass2" name="pass2" aria-describedby="passHelp" placeholder="Repeat Password...">
                                        <?= form_error('pass2', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Change Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
</div>
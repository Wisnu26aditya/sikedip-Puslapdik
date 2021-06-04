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
                                    <h1 class="h4 text-gray-900 mb-4"><img src="assets/img/hd.png" width="120px" height="80px"></h1>
                                    <h2 class="h4 text-gray-900 mb-4">Sistem Informasi Kearsipan Digital Puslapdik</h2>
                                </div>
                                <?= $this->session->flashdata('messege'); ?>
                                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Anggaran :</label>
                                        <select class="form-control form-control-sm" name="tahun" id="tahun">
                                            <?php
                                            //Heri Priady//
                                            //28 - 01- 2018//
                                            $tg_awal = date('Y') - 1;
                                            $tgl_akhir = date('Y') + 4;
                                            for ($i = $tgl_akhir; $i >= $tg_awal; $i--) {
                                                echo "<option value='$i'";
                                                if (date('Y') == $i) {
                                                    echo "selected";
                                                }
                                                echo ">$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                </form>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/forgotpass'); ?>">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/register'); ?>">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
</div>
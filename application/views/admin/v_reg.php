<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('messege'); ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Image</th>
                            <th scope="col">role</th>
                            <th scope="col">active</th>
                            <th scope="col">Akses Download</th>
                            <th scope="col">Akses Upload</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($akun as $a) :
                            $id = $a['id'];
                            $name   = $a['name'];
                            $email   = $a['email'];
                            $image   = $a['image'];
                            $role_id   = $a['role_id'];
                            $is_active   = $a['is_active'];
                            $is_download   = $a['is_download'];
                            $is_upload   = $a['is_upload'];
                        ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $name; ?></td>
                                <td><?= $email; ?></td>
                                <td><?= $image; ?></td>
                                <td><?= $role_id; ?></td>
                                <td><?= $is_active; ?></td>
                                <td><?= $is_download; ?></td>
                                <td><?= $is_upload; ?></td>
                                <td>
                                    <span class="btn-editreg badge badge-pill badge-success" data-toggle="modal" data-target="#edit" data-id="<?= $id; ?>">Edit Akun</span>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('Reg/up_akun'); ?>" method="post">
            <input type="hidden" id="eid" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="ename" name="name" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Role User</label><br />
                                    <select class="chosen-select form-control" name="user_role" id="euser_role" required>
                                        <option value="">Pilih Role</option>
                                        <?php foreach ($user as $row) : ?>
                                            <option value="<?= $row->id; ?>"><?= $row->role; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Active</label><br />
                                    <select class="chosen-select form-control" name="active" id="eactive" required>
                                        <option value="">Pilih Active:</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Akses Download</label><br />
                                    <select class="chosen-select form-control" name="is_download" id="eis_download" required>
                                        <option value="">Pilih Download:</option>
                                        <option value="1">Boleh</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Akses Upload</label><br />
                                    <select class="chosen-select form-control" name="is_upload" id="eis_upload" required>
                                        <option value="">Pilih Upload:</option>
                                        <option value="1">Boleh</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Image</label><br />
                                    <select class="chosen-select form-control" name="image" id="eimage" required>
                                        <option value="">Pilih Image:</option>
                                        <option value="default.jpg">Pria</option>
                                        <option value="woman.jpg">Wanita</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" id="eemail" name="email" readonly>
                                </div>

                            </div>
                            <div class="col-md-auto">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>

</div>
</div>
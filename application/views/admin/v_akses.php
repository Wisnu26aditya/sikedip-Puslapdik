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
                                    <span class="btn-akses badge badge-pill badge-success" data-toggle="modal" data-target="#akses" data-id="<?= $id; ?>"> Give Access?</span>
                                    <span class="btn-editakses badge badge-pill badge-warning" data-toggle="modal" data-target="#edit" data-id="<?= $id; ?>">Edit</span>
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

<!-- Modal Get Access -->
<div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-labelledby="aksesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('akses/akses'); ?>" method="post">
            <input type="hidden" id="urut" name="urut" value="">
            <input type="hidden" id="userid" name="userid" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aksesLabel">Hak Akses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label class="form-group">Nama User:</label>
                            <input type="text" id="nama" name="nama" disabled>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%" id="table-akses">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Modul</th>
                                            <th scope="col"><input type="checkbox" id="chck" onchange="checkAll(this)" name="chk[]">
                                                <label for="chck">Action</label>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($Listakses as $a) :
                                            $id = $a['module_id'];
                                            $name   = $a['module_nama'];
                                        ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $name; ?></td>
                                                <td>
                                                    <label>
                                                        <input type="checkbox" id="cb_akses" name="cb_akses[]" value="<?= $id; ?>">
                                                        Give Access
                                                    </label>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('akses/editakses'); ?>" method="post">
            <input type="text" id="id" name="id" value="">
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
                                    <input type="text" class="form-control" id="aname" name="name" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" id="aemail" name="email" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="text" class="form-control" id="aimage" name="image">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" class="form-control" id="arole" name="role">
                                </div>
                                <div class="form-group">
                                    <label>Active</label>
                                    <input type="text" class="form-control" id="aactive" name="active">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Akses Download</label>
                                    <input type="text" class="form-control" id="adownload" name="download">
                                </div>
                                <div class="form-group">
                                    <label>Akses Upload</label>
                                    <input type="text" class="form-control" id="aupload" name="upload">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
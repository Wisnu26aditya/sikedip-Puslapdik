<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('messege'); ?>
            <!-- Kondisi dimana user boleh upload atau tidak -->
            <?php
            $id = $this->session->userdata('id');
            $kueri = $this->db->get_where('master_updown', array('id' => $id));

            //menghitung selisih hari
            date_default_timezone_set('Asia/Jakarta');
            $cd1 = new DateTime('2021-04-20');
            $selisih = date_diff($cd1, new DateTime());

            if ($kueri->num_rows() > 0) {
                $pilihan = $kueri->row_array();
            }
            if ($pilihan['is_upload'] == '1') { ?>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#add_psedia">Tambah Data</a>
            <?php } else { ?>
                <span class="btn btn-primary mb-3" readonly>Tambah Data-disabled</span>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">SSKEL. Barang</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Uraian</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Pokja</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($Psedia as $a) :
                            $sskel = $a['sskel_brg'];
                            $kode_brg = $a['kode_brg'];
                            $nama_brg = $a['nama_brg'];
                            $satuan = $a['satuan'];
                            $deptnama = $a['ms_deptnama'];
                            $id = $a['kode_id'];
                        ?>

                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $sskel; ?></td>
                                <td><?= $kode_brg; ?></td>
                                <td><?= $nama_brg; ?></td>
                                <td><?= $satuan; ?></td>
                                <td><?= $deptnama; ?></td>
                                <td>
                                    <!-- Kondisi dimana user boleh download atau tidak -->
                                    <?php if ($pilihan['is_download'] == '1') { ?>
                                        <!-- 1 : Boleh -->
                                        <span class="btn-editpsd badge badge-pill badge-warning" data-toggle="modal" data-target="#edit_psedia" data-id="<?= $id; ?>"> Edit</span>
                                        <span class="btn-deletepsd badge badge-pill badge-danger" data-toggle="modal" data-target="#hapus_psedia" data-id="<?= $id; ?>">Delete</span>
                                    <?php } else { ?>
                                        <span class="badge badge-pill badge-warning" readonly>Edit-disabled</span>
                                    <?php }; ?>
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


<!-- Modal add-->
<div class="modal fade" id="add_psedia" tabindex="-1" role="dialog" aria-labelledby="add_psediaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('mstbrg/ins_psedia'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_psedialabel">Data Master Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="kodesskel" name="kodesskel" placeholder="Kode Barang" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text2" class="caridata form-control" id="nm_brg" name="nm_brg" placeholder="Cari Barang" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-info">Reset</button>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nmbrg" name="nmbrg" placeholder="Nama Barang" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <select class="chosen-select form-control" name="dept" id="dept" required>
                                        <option value="">Pilih Pokja</option>
                                        <?php foreach ($dept as $row) : ?>
                                            <option value="<?= $row->ms_deptid; ?>"><?= $row->ms_deptnama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="created_by" name="created_by" value="<?= $this->session->userdata['name']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--modal edit-->

<div class="modal fade" id="edit_psedia" tabindex="-1" role="dialog" aria-labelledby="edit_psediaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('mstbrg/up_psedia'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id="eid" name="eid">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_psedialabel">Edit Data Master Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <select class="chosen-select form-control" name="esskel_brg" id="esskel_brg" required>
                                        <option value="">Pilih SSKEL Barang</option>
                                        <?php foreach ($kodesskel as $row) : ?>
                                            <option value="<?= $row->kd_brg; ?>"><?= $row->ur_sskel; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" id="ekd_brg" name="ekd_brg" value="<?= $row->kd_brg; ?>" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="enama_brg" name="enama_brg" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="esatuan" name="esatuan" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <select class="chosen-select form-control" name="edept" id="edept" required>
                                        <option value="">Pilih Pokja</option>
                                        <?php foreach ($dept as $row) : ?>
                                            <option value="<?= $row->ms_deptid; ?>"><?= $row->ms_deptnama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="ecreated_by" name="ecreated_by" value="<?= $this->session->userdata['name']; ?>" readonly>
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

<!-- modal hapus -->
<div class="modal fade" id="hapus_psedia" tabindex="-1" role="dialog" aria-labelledby="hapus_psediaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus_psedialabel">Perhatian!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="" action="<?= base_url('mstbrg/del_psedia'); ?>" method="post">
                        <div class="position-relative form-group">
                            <p>Apakah Anda Yakin ingin menghapus data <span style="color:red;font-weight:bold" id="txtid"></span> ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
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
            $id = $this->session->userdata('role_id');
            $kueri = $this->db->get_where('master_updown', ['role_id' => $id]);
            if ($kueri->num_rows() > 0) {
                $pilihan = $kueri->row_array();
            }
            if ($pilihan['is_upload'] == '1') { ?>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#add_ls" id="btn_add_ls"> Tambah Data</a>
                </div>
            <?php } else { ?>
                <span class="btn btn-primary mb-3" readonly>Tambah Data-disabled</span>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NO. SPP</th>
                            <th scope="col">NO. Dokumen</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nilai SPP</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($Lsp as $a) :
                            $id = $a['spp_id'];
                            $spp = $a['spp_no'];
                            $dok = $a['spp_dok_id'];
                            $tgl = $a['spp_tgl'];
                            $status = $a['status'];
                            $nilaispp = $a['spp_nilai'];
                        ?>

                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $spp; ?></td>
                                <td><?= $dok; ?></td>
                                <td><?= $tgl; ?></td>
                                <td><?= 'Rp. ' . $nilaispp; ?></td>
                                <td style="background-color: aqua;"><?= $status; ?></td>
                                <td>
                                    <!-- Kondisi dimana user boleh download atau tidak -->
                                    <?php if ($pilihan['is_download'] == '1') { ?>
                                        <!-- 1 : Boleh -->
                                        <span class="btn-viewlsprj badge badge-pill badge-success" data-toggle="modal" data-target="#view_ls" data-id="<?= $id; ?>">View</span>
                                        <span class="btn-editlsprj badge badge-pill badge-warning" data-toggle="modal" data-target="#edit_ls" data-id="<?= $id; ?>"> Edit</span>
                                        <span class="btn-deletelsprj badge badge-pill badge-danger" data-toggle="modal" data-target="#hapus_ls" data-id="<?= $id; ?>">Delete</span>
                                    <?php } else { ?>
                                        <span class="badge badge-pill badge-success" readonly>View-disabled</span>
                                        <span class="badge badge-pill badge-warning" readonly>Edit-disabled</span>
                                        <span class="badge badge-pill badge-danger" readonly>Deleted-disabled</span>
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
<div class="modal fade" id="add_ls" tabindex="-1" role="dialog" aria-labelledby="add_lsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('lsperjadin/simpan_lsperjadin'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_lslabel">Upload Pengajuan LS Bendahara - Perjalanan Dinas</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div id="field">
                            <div id="field0">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label for="no">Nomor SPP</label>
                                            <input id="no" name="no[]" maxlength="5" onkeypress="return hanyaAngka(event)" type="text" placeholder="" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label for="tgl">Tanggal SPP</label>
                                            <input name="tgl[]" type="text" placeholder="" class="tgl form-control" autocomplete="off">

                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label for="nilai">Nilai SPP</label>
                                            <input id="nilai" onkeyup="convertToRupiah(this);" name="nilai[]" type="text" placeholder="" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="form_add">

                        </div>
                        <button id="add-more" name="add-more" class="btn btn-primary">Add More</button>
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label for="sender">Pengirim</label>
                                    <input id="created_by" name="created_by" type="text" value="<?= $this->session->userdata['name']; ?>" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <fieldset>
                                        <legend>Upload Dokumen</legend>
                                        <div class="row">
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">Dokumen Daftar Nominatif</label>
                                                    <input name="file_nominatif" type="file" class="form-control-file">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">Dokumen ST/SK</label>
                                                    <input name="file_sk" type="file" class="form-control-file">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">Dokumen SPP</label>
                                                    <input name="file_spp" type="file" class="form-control-file">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
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


<!--modal view-->

<div class="modal fade" id="view_ls" tabindex="-1" role="dialog" aria-labelledby="view_lsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_lslabel">Download Dokumen LS - Perjalanan Dinas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nomor SPP</label>
                                    <input type="text" class="form-control" id="vnospp" name="nospp" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Tanggal SPP</label>
                                    <input type="text" class="form-control" id="vtgl" name="tgl" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nilai SPP</label>
                                    <input type="text" class="form-control" id="vnilaispp" name="nilaispp" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Kode Dokumen</label>
                                    <input type="text" class="form-control" id="vkode_ls" name="kode_ls" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <fieldset>
                                <legend>Download Dokumen</legend>
                                <div class="row">
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File SPP</label>
                                            <a href="" name="file_spp" id="vfile_spp" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File Daftar Nominatif</label>
                                            <a href="" name="file_nominatif" id="vfile_nominatif" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File ST/SK Kegiatan</label>
                                            <a href="" name="file_sk" id="vfile_sk" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!--modal edit-->

<div class="modal fade" id="edit_ls" tabindex="-1" role="dialog" aria-labelledby="edit_lsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('lsperjadin/ubah_lsperjadin'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_lslabel">Edit Dokumen LS - Perjalanan Dinas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nomor SPP</label>
                                    <input type="text" maxlength="5" onkeypress="return hanyaAngka(event)" class="form-control" id="enospp" name="nospp[]">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Tanggal SPP</label>
                                    <input type="text" class="tgl form-control" id="etgl" name="tgl[]">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nilai SPP</label>
                                    <input type="text" onkeyup="convertToRupiah(this);" class="form-control" id="enilaispp" name="nilaispp[]">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Kode Dokumen</label>
                                    <input type="text" class="form-control" id="ekode_ls" name="kode_ls" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <fieldset>
                                <legend>Upload Dokumen</legend>
                                <div class="row">
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File SPP</label>
                                            <input id="file_spp" name="file_spp" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_spp" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File Daftar Nominatif</label>
                                            <input id="file_nominatif" name="file_nominatif" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_nominatif" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File ST/SK Kegiatan</label>
                                            <input id="file_sk" name="file_sk" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_sk" readonly>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
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

<!-- modal hapus -->
<div class="modal fade" id="hapus_ls" tabindex="-1" role="dialog" aria-labelledby="hapus_lsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus_lslabel">Perhatian!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="" action="<?= base_url('lsperjadin/hapus_lsperjadin'); ?>" method="post">
                        <div class="position-relative form-group">
                            <p>Apakah Anda Yakin ingin menghapus data <span style="color:red;font-weight:bold" id="txtid"></span> ?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="dkode_ls" name="dkode_ls">
                            <input type="hidden" id="dfile_spp" name="dfile_spp">
                            <input type="hidden" id="dfile_nominatif" name="dfile_nominatif">
                            <input type="hidden" id="dfile_sk" name="dfile_sk">
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
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
            $kueri = $this->db->get_where('login', ['role_id' => $id]);
            if ($kueri->num_rows() > 0) {
                $pilihan = $kueri->row_array();
            }
            if ($pilihan['is_upload'] == '1') { ?>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#add_tup"> Tambah Data</a>
            <?php } else { ?>
                <span class="btn btn-primary mb-3" readonly>Tambah Data-disabled</span>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NO. SPP/SPM</th>
                            <th scope="col">NO. Dokumen</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nilai SPM</th>
                            <th scope="col">Uraian</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($Tup as $a) :
                            $spp = $a['lpj_nomorsppspm'];
                            $dok = $a['dokumen_id'];
                            $tgl = $a['lpj_tgl'];
                            $nilaispm = $a['lpj_nilaispm'];
                            $uraian = $a['lpj_uraian'];
                            $nosp2d = $a['lpj_nomorsp2d'];
                            $tglsp2d = $a['lpj_tglsp2d'];
                            $nilaisp2d = $a['lpj_nilaisp2d'];
                            $id = $a['lpj_id'];
                        ?>

                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $spp; ?></td>
                                <td><?= $dok; ?></td>
                                <td><?= $tgl; ?></td>
                                <td><?= 'Rp. ' . $nilaispm; ?></td>
                                <td><?= $uraian; ?></td>
                                <td>
                                    <!-- Kondisi dimana user boleh download atau tidak -->
                                    <?php if ($pilihan['is_download'] == '1') { ?>
                                        <!-- 1 : Boleh -->
                                        <span class="btn-viewtup badge badge-pill badge-success" data-toggle="modal" data-target="#view_tup" data-id="<?= $id; ?>">View</span>
                                        <span class="btn-edittup badge badge-pill badge-warning" data-toggle="modal" data-target="#edit_tup" data-id="<?= $id; ?>">Edit</span>
                                        <span class="btn-deletetup badge badge-pill badge-danger" data-toggle="modal" data-target="#hapus_tup" data-id="<?= $id; ?>">Delete</span>

                                    <?php } else { ?>
                                        <span class="badge badge-pill badge-success" readonly>View-disabled</span>
                                        <span class="badge badge-pill badge-warning" readonly>Deleted-disabled</span>
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
<div class="modal fade" id="add_tup" tabindex="-1" role="dialog" aria-labelledby="add_tupLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('tup/simpan_tup'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_tuplabel">Upload Dokumen TUP</h5>
                    <div class="form-group">
                        <span class="badge badge-pill badge-danger">Ukuran File Max. 100MB</span>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="text" maxlength="5" onkeypress="return hanyaAngka(event)" class="form-control" id="nospp" name="nospp" placeholder="Nomor SPP/SPM" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="tgl" name="tgl" placeholder="Tanggal" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" onkeyup="convertToRupiah(this);" class="form-control" id="nilaispm" name="nilaispm" placeholder="NIlai SPM" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Uraian" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" maxlength="5" onkeypress="return hanyaAngka(event)" class="form-control" id="nosp2d" name="nosp2d" placeholder="No SP2D" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="tglsp2d" name="tglsp2d" placeholder="Tanggal SP2D" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="text" onkeyup="convertToRupiah(this);" class="form-control" id="nilaisp2d" name="nilaisp2d" placeholder="Nilai SP2D" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="created_by" name="created_by" value="<?= $this->session->userdata['name']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <fieldset>
                                <legend>Upload Dokumen</legend>
                                <span class="badge badge-pill badge-warning">File yag diperboleh (.pdf, .doc, .docx, .ppt, .pptx)</span>
                                <div class="row">
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label for="file_spp">Dokumen SPP</label>
                                            <input name="file_spp" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label for="file_spm">Dokumen SPM</label>
                                            <input name="file_spm" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label for="file_sp2d">Dokumen SP2D</label>
                                            <input name="file_sp2d" type="file" class="form-control-file">
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label for="file_bukti">Dokumen Bukti Pengeluaran</label>
                                            <input name="file_bukti" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label for="file_pajak">Dokumen Setor Pajak</label>
                                            <input name="file_pajak" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label for="file_pengembalian">Dokumen Setor Pengembalian jika ada</label>
                                            <input name="file_pengembalian" type="file" class="form-control-file">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
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

<!--modal view-->

<div class="modal fade" id="view_tup" tabindex="-1" role="dialog" aria-labelledby="view_tupLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_tuplabel">Download Dokumen TUP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nomor SPP/SPM</label>
                                    <input type="text" class="form-control" id="vnospp" name="nospp" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal SPP/SPM</label>
                                    <input type="text" class="form-control" id="vtgl" name="tgl" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nilai SPM</label>
                                    <input type="text" class="form-control" id="vnilaispm" name="nilaispm" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Uraian</label>
                                    <input type="text" class="form-control" id="vuraian" name="uraian" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nomor SP2D</label>
                                    <input type="text" class="form-control" id="vnosp2d" name="nosp2d" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal SP2D</label>
                                    <input type="text" class="form-control" id="vtglsp2d" name="tglsp2d" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nilai SP2D</label>
                                    <input type="text" class="form-control" id="vnilaisp2d" name="nilaisp2d" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Kode Dokumen</label>
                                    <input type="text" class="form-control" id="vkode_tup" name="kode_tup" value="" readonly>
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
                                            <a href="" target="_blank" id="vfile_spp" name="file_spp" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File SPM</label>
                                            <a href="" target="_blank" id="vfile_spm" name="file_spm" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File SP2D</label>
                                            <a href="" target="_blank" id="vfile_sp2d" name="file_sp2d" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File Bukti Pengeluaran</label>
                                            <a href="" target="_blank" id="vfile_bukti" name="file_bukti" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File Setor Pajak</label>
                                            <a href="" target="_blank" id="vfile_pajak" name="file_pajak" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File Setor Pengembalian jika ada</label>
                                            <a href="" target="_blank" id="vfile_pengembalian" name="file_pengembalian" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
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

<div class="modal fade" id="edit_tup" tabindex="-1" role="dialog" aria-labelledby="edit_tupLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('tup/ubah_tup'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id="lpj_id" name="lpj_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_tuplabel">Edit Dokumen TUP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nomor SPP/SPM</label>
                                    <input type="text" maxlength="5" onkeypress="return hanyaAngka(event)" class="form-control" id="enospp" name="nospp">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal SPP/SPM</label>
                                    <input type="text" class="form-control" id="etgl" name="tgl">
                                </div>
                                <div class="form-group">
                                    <label>Nilai SPM</label>
                                    <input type="text" class="form-control" id="enilaispm" name="nilaispm">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Uraian</label>
                                    <input type="text" class="form-control" id="euraian" name="uraian">
                                </div>
                                <div class="form-group">
                                    <label>Nomor SP2D</label>
                                    <input type="text" class="form-control" id="enosp2d" name="nosp2d">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal SP2D</label>
                                    <input type="text" class="form-control" id="etglsp2d" name="tglsp2d">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nilai SP2D</label>
                                    <input type="text" class="form-control" id="enilaisp2d" name="nilaisp2d">
                                </div>
                                <div class="form-group">
                                    <label>Kode Dokumen</label>
                                    <input type="text" class="form-control" id="ekode_tup" name="kode_tup" readonly>
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
                                        <div class="form-group">
                                            <label>File SPM</label>
                                            <input id="file_spm" name="file_spm" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_spm" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>File SP2D</label>
                                            <input id="file_sp2d" name="file_sp2d" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_sp2d" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File Bukti Pengeluaran</label>
                                            <input id="file_bukti" name="file_bukti" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_bukti" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>File Setor Pajak</label>
                                            <input id="file_pajak" name="file_pajak" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_pajak" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>File Setor Pengembalian</label>
                                            <input id="file_pengembalian" name="file_pengembalian" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_pengembalian" readonly>
                                        </div>
                                    </div>
                            </fieldset>
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
<div class="modal fade" id="hapus_tup" tabindex="-1" role="dialog" aria-labelledby="hapus_tupLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus_tuplabel">Perhatian!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="" action="<?= base_url('tup/hapus_tup'); ?>" method="post">
                        <div class="position-relative form-group">
                            <p>Apakah Anda Yakin ingin menghapus data <span style="color:red;font-weight:bold" id="txtid"></span> ?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="dkode_tup" name="dkode_tup">
                            <input type="hidden" id="dfile_spp" name="dfile_spp">
                            <input type="hidden" id="dfile_spm" name="dfile_spm">
                            <input type="hidden" id="dfile_sp2d" name="dfile_sp2d">
                            <input type="hidden" id="dfile_bukti" name="dfile_bukti">
                            <input type="hidden" id="dfile_pajak" name="dfile_pajak">
                            <input type="hidden" id="dfile_pengembalian" name="dfile_pengembalian">
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
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

            //menghitung selisih hari
            date_default_timezone_set('Asia/Jakarta');
            $cd1 = new DateTime('2021-04-20');
            $selisih =date_diff( $cd1, new DateTime() );

            if ($kueri->num_rows() > 0) {
                $pilihan = $kueri->row_array();
            }
            if ($pilihan['is_upload'] == '1') { ?>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#add_perjadin">Tambah Data</a>
            <?php } else { ?>
                <span class="btn btn-primary mb-3" readonly>Tambah Data-disabled</span>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No. SPP/SPM</th>
                            <th scope="col">No. Dokumen</th>
                            <th scope="col">Tanggal Kegiatan</th>
                            <th scope="col">Nilai SPM</th>
                            <th scope="col">Uraian</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($Perjadin as $a) :
                            $spp = $a['lpj_nomorsppspm'];
                            $dok = $a['dokumen_id'];
                            $tgl = $a['tgl_keg'];
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
                                    <?php if (($pilihan['is_download'] == '1') && ($selisih->format('%d') < $pilihan['min_hari'] == '7')) { ?>
                                        <!-- 1 : Boleh -->
                                        <span class="btn-viewprj badge badge-pill badge-success" data-toggle="modal" data-target="#view_perjadin" data-id="<?= $id; ?>">View</span>
                                        <span class="btn-editprj badge badge-pill badge-warning" data-toggle="modal" data-target="#edit_perjadin" data-id="<?= $id; ?>"> Edit</span>
                                        <span class="btn-deleteprj badge badge-pill badge-danger" data-toggle="modal" data-target="#hapus_perjadin" data-id="<?= $id; ?>">Delete</span>
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
<div class="modal fade" id="add_perjadin" tabindex="-1" role="dialog" aria-labelledby="add_perjadinLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('perjadin/simpan_perjadin'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_perjadinlabel">Dokumen Perjalanan Dinas</h5>
                    <div class="form-group">
                        <span class="badge badge-pill badge-danger">Ukuran File Max. 2MB</span>
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
                                    <input type="text" class="tgl form-control" id="tgl" name="tgl" placeholder="Tanggal" autocomplete="off">
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
                                    <input type="text" class="form-control" id="nama_keg" name="nama_keg" placeholder="Nama Kegiatan" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="tgl form-control" id="tgl_keg" name="tgl_keg" placeholder="Tgl Kegiatan" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="kode_mak" name="kode_mak" placeholder="Kode MAK" autocomplete="off">
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
                                <div class="row">
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>Dokumen SPP</label>
                                            <input name="file_spp" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label>Dokumen SPM</label>
                                            <input name="file_spm" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label>Dokumen SP2D</label>
                                            <input name="file_sp2d" type="file" class="form-control-file">
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>Dokumen ST/SK Kegiatan</label>
                                            <input name="file_sk" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label>Dokumen Rekap dan Kuitansi</label>
                                            <input name="file_kuitansi" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label>Dokumen Laporan Kegiatan</label>
                                            <input name="file_laporan" type="file" class="form-control-file">
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>Dokumen Biodata</label>
                                            <input name="file_biodata" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label>Dokumen Daftar Hadir</label>
                                            <input name="file_daftar" type="file" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label>Dokumen Tanda Terima Perlengkapan Peserta</label>
                                            <input name="file_atk" type="file" class="form-control-file">
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

<div class="modal fade" id="view_perjadin" tabindex="-1" role="dialog" aria-labelledby="view_perjadinLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_perjadinlabel">Download Dokumen Perjalanan Dinas</h5>
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
                                    <label>Nama Kegiatan</label>
                                    <input type="text" class="form-control" id="vnama_keg" name="nama_keg" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Kegiatan</label>
                                    <input type="text" class="form-control" id="vtgl_keg" name="tgl_keg" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Kode MAK</label>
                                    <input type="text" class="form-control" id="vkode_mak" name="kode_mak" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nilai SP2D</label>
                                    <input type="text" onkeyup="convertToRupiah(this);" class="form-control" id="vnilaisp2d" name="nilaisp2d" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Kode Dokumen</label>
                                    <input type="text" class="form-control" id="vkode_prj" name="kode_prj" value="" readonly>
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
                                        <div class="form-group">
                                            <label>File SPM</label>
                                            <a href="" name="file_spm" id="vfile_spm" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File SP2D</label>
                                            <a href="" name="file_sp2d" id="vfile_sp2d" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File Dokumen ST/SK Kegiatan</label>
                                            <a href="" name="file_sk" id="vfile_sk" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File Dokumen Rekap dan Kuitansi</label>
                                            <a href="" name="file_kuitansi" id="vfile_kuitansi" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File Dokumen Laporan Kegiatan</label>
                                            <a href="" name="file_laporan" id="vfile_laporan" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File Dokumen Biodata</label>
                                            <a href="" name="file_biodata" id="vfile_biodata" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File Dokumen Daftar Hadir</label>
                                            <a href="" name="file_daftar" id="vfile_daftar" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label>File Dokumen Tanda Terima Perlengkapan Peserta</label>
                                            <a href="" name="file_atk" id="vfile_atk" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-fw fa-download" placeholder="download"></i></a>
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

<div class="modal fade" id="edit_perjadin" tabindex="-1" role="dialog" aria-labelledby="edit_perjadinLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('perjadin/ubah_perjadin'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id="lpj_id" name="lpj_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_perjadinlabel">Edit Dokumen Perjalanan Dinas</h5>
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
                                    <input type="text" class="tgl form-control" id="etgl" name="tgl">
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
                                    <label>Nama Kegiatan</label>
                                    <input type="text" class="form-control" id="enama_keg" name="nama_keg">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Kegiatan</label>
                                    <input type="text" class="form-control" id="etgl_keg" name="tgl_keg" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Kode MAK</label>
                                    <input type="text" class="form-control" id="ekode_mak" name="kode_mak" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nilai SP2D</label>
                                    <input type="text" class="form-control" id="enilaisp2d" name="nilaisp2d">
                                </div>
                                <div class="form-group">
                                    <label>Kode Dokumen</label>
                                    <input type="text" class="form-control" id="ekode_prj" name="kode_prj" readonly>
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
                                            <label>File ST/SK Kegiatan</label>
                                            <input id="file_sk" name="file_sk" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_sk" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>File Rekap dan Kuitansi</label>
                                            <input id="file_kuitansi" name="file_kuitansi" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_kuitansi" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>File Laporan Kegiatan</label>
                                            <input id="file_laporan" name="file_laporan" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_laporan" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <label>File Biodata</label>
                                            <input id="file_biodata" name="file_biodata" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_biodata" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>File Daftar Hadir</label>
                                            <input id="file_daftar" name="file_daftar" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_daftar" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>File Tanda Terima Perlengkapan Peserta</label>
                                            <input id="file_atk" name="file_atk" type="file" class="form-control-file">
                                            <input type="text" class="form-control" id="efile_atk" readonly>
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
<div class="modal fade" id="hapus_perjadin" tabindex="-1" role="dialog" aria-labelledby="hapus_perjadinLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus_perjadinlabel">Perhatian!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="" action="<?= base_url('perjadin/hapus_perjadin'); ?>" method="post">
                        <div class="position-relative form-group">
                            <p>Apakah Anda Yakin ingin menghapus data <span style="color:red;font-weight:bold" id="txtid"></span> ?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="dkode_prj" name="dkode_prj">
                            <input type="hidden" id="dfile_spp" name="dfile_spp">
                            <input type="hidden" id="dfile_spm" name="dfile_spm">
                            <input type="hidden" id="dfile_sp2d" name="dfile_sp2d">
                            <input type="hidden" id="dfile_sk" name="dfile_sk">
                            <input type="hidden" id="dfile_laporan" name="dfile_laporan">
                            <input type="hidden" id="dfile_kuitansi" name="dfile_kuitansi">
                            <input type="hidden" id="dfile_biodata" name="dfile_biodata">
                            <input type="hidden" id="dfile_daftar" name="dfile_daftar">
                            <input type="hidden" id="dfile_atk" name="dfile_atk">
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
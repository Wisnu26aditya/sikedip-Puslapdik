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
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#add_psediatr">Tambah Data</a>
            <?php } else { ?>
                <span class="btn btn-primary mb-3" readonly>Tambah Data-disabled</span>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Dokumen</th>
                            <th scope="col">No Bukti</th>
                            <th scope="col">Tgl Dokumen</th>
                            <th scope="col">Tgl Buku</th>
                            <th scope="col">Rupiah</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($Psedia as $a) :
                            $dok_id = $a['dok_id'];
                            $no_bukti = $a['no_bukti'];
                            $tgl_dok = $a['tgl_dok'];
                            $tgl_buku = $a['tgl_buku'];
                            $grand_total = $a['grand_total'];
                            $id = $a['tr_id'];
                        ?>

                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $dok_id; ?></td>
                                <td><?= $no_bukti; ?></td>
                                <td><?= $tgl_dok; ?></td>
                                <td><?= $tgl_buku; ?></td>
                                <td><?= 'Rp. ' . number_format($grand_total); ?></td>
                                <td>
                                    <!-- Kondisi dimana user boleh download atau tidak -->
                                    <?php if ($pilihan['is_download'] == '1') { ?>
                                        <!-- 1 : Boleh -->
                                        <span class="btn-viewpsdtr badge badge-pill badge-success" data-toggle="modal" data-target="#view_psediatr" data-id="<?= $dok_id; ?>">View</span>
                                        <span class="btn-editpsdtr badge badge-pill badge-warning" data-toggle="modal" data-target="#edit_psediatr" data-id="<?= $id; ?>">Add Item</span>
                                        <span class="btn-deletepsdtr badge badge-pill badge-danger" data-toggle="modal" data-target="#hapus_psediatr" data-id="<?= $id; ?>">Delete</span>
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
<div class="modal fade" id="add_psediatr" tabindex="-1" role="dialog" aria-labelledby="add_psediatrLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('psediabeli/ins_psediatr'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_psediatrlabel">Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="no_bukti" name="no_bukti" placeholder="No. Bukti" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="jml_in" name="jml_in" placeholder="Jumlah Masuk" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="text" class="tgl form-control" id="tgl_dok" name="tgl_dok" placeholder="Tgl Dokumen" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="akun" name="akun" placeholder="Akun" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="text" class="tgl form-control" id="tgl_buku" name="tgl_buku" placeholder="Tgl Buku" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" onkeyup="convertToRupiah(this);" onkeypress="return hanyaAngka(event)" class="form-control" id="hrg_satuan" name="hrg_satuan" placeholder="Harga Satuan" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <select class="chosen-select form-control" id="sskel_brg" name="sskel_brg" required>
                                        <option value="">Pilih SSKEL Barang</option>
                                        <?php foreach ($mstbrg as $row) : ?>
                                            <option value="<?= $row->sskel_brg; ?>"><?= $row->nama_brg; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="created_by" name="created_by" value="<?= $this->session->userdata['name']; ?>" readonly>
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

<!--modal view-->

<div class="modal fade" id="view_psediatr" tabindex="-1" role="dialog" aria-labelledby="view_psediatrLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" id="vid" name="vid">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_psediatrlabel">Lihat Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>No. Dokumen</label>
                                    <input type="text" class="form-control" id="vdok_id" name="vdok_id" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>No. Bukti</label>
                                    <input type="text" class="form-control" id="vno_bukti" name="vno_bukti" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Tgl Dokumen</label>
                                    <input type="text" class="form-control" id="vtgl_dok" name="vtgl_dok" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Tgl Buku</label>
                                    <input type="text" class="form-control" id="vtgl_buku" name="vtgl_buku" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Jumlah Masuk</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Harga Total</th>
                                        <th scope="col">Akun</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="isi">

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<!--modal edit-->

<div class="modal fade" id="edit_psediatr" tabindex="-1" role="dialog" aria-labelledby="edit_psediatrLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('psediabeli/up_psediatr'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id="eid" name="eid">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_psediatrlabel">Tambah Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>No. Dokumen</label>
                                    <input type="text" class="form-control" id="edok_id" name="edok_id" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>No. Bukti</label>
                                    <input type="text" class="form-control" id="eno_bukti" name="eno_bukti" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Tgl Dokumen</label>
                                    <input type="text" class="form-control" id="etgl_dok" name="etgl_dok" readonly>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Tgl Buku</label>
                                    <input type="text" class="form-control" id="etgl_buku" name="etgl_buku" readonly>
                                </div>
                            </div>
                        </div>
                        <div id="field">
                            <div id="field0">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <select class="chosen-select form-control" id="esskel_brg" name="esskel_brg" required>
                                                <option value="">Pilih SSKEL Barang</option>
                                                <?php foreach ($mstbrg as $row) : ?>
                                                    <option value="<?= $row->sskel_brg; ?>"><?= $row->nama_brg; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="ejml_in" name="ejml_in" placeholder="Jumlah Masuk" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" onkeyup="convertToRupiah(this);" onkeypress="return hanyaAngka(event)" class="form-control" id="ehrg_satuan" name="ehrg_satuan" placeholder="Harga Satuan" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="eakun" name="eakun" placeholder="Akun" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="eket" name="eket" placeholder="Keterangan" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group" id="form_add">
                        </div>
                        <button id="add-psedia" name="add-psedia" class="btn btn-primary">Add More</button> -->

                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- modal hapus -->
<div class="modal fade" id="hapus_psediatr" tabindex="-1" role="dialog" aria-labelledby="hapus_psediatrLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <input type="text" id="dsskel_brg" nama="dsskel_brg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus_psediatrlabel">Perhatian!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="" action="<?= base_url('psediabeli/del_psediatr'); ?>" method="post">
                        <div class="position-relative form-group">
                            <p>Apakah Anda Yakin ingin menghapus data <span style="color:red;font-weight:bold" id="d_dokid"></span> dengan No. Bukti <span style="color:red;font-weight:bold" id="dno_bukti"></span> ?</p>
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
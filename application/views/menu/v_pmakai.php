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
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#add_pmakai">Tambah Data</a>
            <?php } else { ?>
                <span class="btn btn-primary mb-3" readonly>Tambah Data-disabled</span>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Permintaan</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Harga Total</th>
                            <th scope="col">Keperluan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($Pemakai as $a) :
                            $nama_brg = $a['nama_brg'];
                            $jml_out = $a['jml_out'];
                            $satuan = $a['satuan'];
                            $hrg_satuan = $a['hrg_satuan'];
                            $hrg_total = $a['hrg_total'];
                            $ket = $a['ket'];
                            $status = $a['status'];
                            $dok_id = $a['dok_id'];
                        ?>

                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $nama_brg; ?></td>
                                <td> <?php if ($jml_out == '0') {
                                            echo '0 ' . $satuan;
                                        } else {
                                            echo $jml_out . ' ' . $satuan;
                                        }
                                        ?>
                                </td>
                                <td><?= 'Rp. ' . number_format($hrg_satuan, 0); ?></td>
                                <td><?= 'Rp. ' . number_format($hrg_total, 0); ?></td>
                                <td><?= $ket; ?></td>
                                <?php if ($status == 1) {
                                    echo '<td style="background-color: yellow;">';
                                    echo 'Request';
                                    echo '</td>';
                                } elseif ($status == 2) {
                                    echo '<td style="background-color: aqua;">';
                                    echo 'Accept';
                                    echo '</td>';
                                } else {
                                    echo 'Ignore';
                                } ?>
                                <td>
                                    <!-- Kondisi dimana user boleh download atau tidak -->
                                    <?php if (($pilihan['is_download'] == '1') and ($status == 1)) { ?>
                                        <!-- 1 : Boleh -->
                                        <span class="btn-accpmakai badge badge-pill badge-success" data-toggle="modal" data-target="#acc_pmakai" data-id="<?= $dok_id; ?>">Accept</span>
                                        <span class="btn-ignorepmakai badge badge-pill badge-warning" data-toggle="modal" data-target="#ignore_pmakai" data-id="<?= $dok_id; ?>">Ignore</span>

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
<div class="modal fade" id="add_pmakai" tabindex="-1" role="dialog" aria-labelledby="add_pmakaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('pmakai/ins_pmakai'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_pmakailabel">Data Pemakaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="col-md-auto">
                            <div class="form-group">
                                <input type="text" class="caripakai form-control" id="nm_brg" name="nm_brg" placeholder="Cari Barang" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" id="kodesskel" name="kodesskel" readonly>
                            </div>
                            <div class="form-group">
                                <label>Saldo Awal</label>
                                <input type="text" class="form-control" id="jml_in" name="jml_in" readonly>
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="text" onkeyup="convertToRupiah(this);" onkeypress="return hanyaAngka(event)" class="form-control" id="hrg_satuan" name="hrg_satuan" readonly>
                            </div>
                            <div class="form-group">
                                <label>Dibuat</label>
                                <input type="text" class="form-control" id="created_by" name="created_by" value="<?= $this->session->userdata['name']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-info">Reset</button>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="jml_out" name="jml_out" placeholder="Jumlah Keluar" autocomplete="off">
                                <input type="text" class="form-control" id="satuan" name="satuan" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="ket" name="ket" placeholder="Keterangan" autocomplete="off">
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

<!-- modal accept -->
<div class="modal fade" id="acc_pmakai" tabindex="-1" role="dialog" aria-labelledby="acc_pmakaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acc_pmakailabel">Perhatian!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="" action="<?= base_url('pmakai/acc_pmakai'); ?>" method="post">
                        <div class="position-relative form-group">
                            <p>Apakah Anda Yakin ingin terima permintaan barang ini dengan No. Dokumen <span style="color:black;font-weight:bold" id="adok"> </span>,
                                Kode Barang <span style="color:red;font-weight:bold" id="asskel_brg"></span> - Nama Barang <span style="color:red;font-weight:bold" id="anama_brg"></span>,
                                Jumlah Permintaan <span style="color:red;font-weight:bold" id="ajml_out"></span> <span id="asatuan"></span> ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Accept</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
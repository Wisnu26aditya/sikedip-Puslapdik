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

            //menghitung selisih hari
            date_default_timezone_set('Asia/Jakarta');
            $cd1 = new DateTime('2021-04-20');
            $selisih = date_diff($cd1, new DateTime());


            ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">SSKEL. Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Stok Awal</th>
                            <th scope="col">Jml Permintaan</th>
                            <th scope="col">Stok Akhir</th>
                            <th scope="col">Pokja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($Pstok as $a) :
                            $sskel = $a['sskel_brg'];
                            $nama_brg = $a['nama_brg'];
                            $jml_in = $a['jml_in'];
                            $satuan = $a['satuan'];
                            $jml_out = $a['jml_out'];
                            $stok_akhir = $jml_in - $jml_out;
                            $deptnama = $a['ms_deptnama'];
                        ?>

                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $sskel; ?></td>
                                <td><?= $nama_brg; ?></td>
                                <td><?= $jml_in . ' ' . $satuan; ?></td>
                                <td><?= $jml_out . ' ' . $satuan; ?></td>
                                <td><?= $stok_akhir . ' ' . $satuan; ?></td>
                                <td><?= $deptnama; ?></td>
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


</div>
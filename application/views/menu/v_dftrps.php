<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('messege'); ?>

            <form role="form" action="<?= base_url('dftrps'); ?>" method="POST" class="form-inline">
                <div class="form-group">
                    <select class="chosen-select form-control" name="vicon" id="vicon" required>
                        <option value="">Pilih Nama Rapat</option>
                        <?php foreach ($listvicon as $row) : ?>
                            <option value="<?= $row->kunci_id; ?>"><?= $row->kunci_namarapat; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="submit" class="btn btn-primary">Cari Data</button>
                </div>
            </form>

            <?php
            if (isset($_POST['vicon']) && $_POST['vicon'] != "") {
                $vicon =  $_POST['vicon'];
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Peserta</th>
                                <th scope="col">NIP/NIK</th>
                                <th scope="col">Unit Kerja</th>
                                <th scope="col">Golongan</th>
                                <th scope="col">Instansi</th>
                                <th scope="col">No. HP</th>
                                <th scope="col">Email</th>
                                <th scope="col">NPWP</th>
                                <th scope="col">No. Rek</th>
                                <th scope="col">Nama Rek</th>
                                <th scope="col">Nama Bank</th>
                                <th scope="col">Ttd</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            // return var_dump($searchingvicon);
                            // letak dir img absen vicon
                            $asalurl = "http://" . $_SERVER['HTTP_HOST'] . "/absenvicon/"; ?>

                            <?php foreach ($searchingvicon as $l) :
                                $data_nama = $l->data_nama;
                                $data_nip = $l->data_nip;
                                $data_uker   = $l->data_uker;
                                $data_gol   = $l->data_gol;
                                $data_instansi   = $l->data_instansi;
                                $data_tlp   = $l->data_tlp;
                                $data_email   = $l->data_email;
                                $data_npwp   = $l->data_npwp;
                                $data_norek   = $l->data_norek;
                                $data_namarek   = $l->data_namarek;
                                $data_namabank   = $l->data_namabank;
                                $ttd   = $l->ttd;
                                $id = $l->kunci_id;
                                $namarapat = $l->kunci_namarapat;

                            ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $data_nama; ?></td>
                                    <td><?= $data_nip; ?></td>
                                    <td><?= $data_uker; ?></td>
                                    <td><?= $data_gol; ?></td>
                                    <td><?= $data_instansi; ?></td>
                                    <td><?= $data_tlp; ?></td>
                                    <td><?= $data_email; ?></td>
                                    <td><?= $data_npwp; ?></td>
                                    <td><?= $data_norek; ?></td>
                                    <td><?= $data_namarek; ?></td>
                                    <td><?= $data_namabank; ?></td>
                                    <td><img src='<?= $asalurl . $ttd; ?>' width='40' height='50' /></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="footer">
                    <a href="<?= base_url('MpdfController/Report_vicon?id=' . $vicon . '&name=' . $namarapat); ?>" class="btn btn-info mb-3" target="_blank">Cetak Pdf</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>

</div>
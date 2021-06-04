<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('messege'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addvicon"> Add Schedule Vicon</a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Rapat</th>
                            <th scope="col">Kunci Awal</th>
                            <th scope="col">Kunci Akhir</th>
                            <th scope="col">Tanggal Rapat</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Akhir</th>
                            <th scope="col">Id Meeting</th>
                            <th scope="col">Password Meeting</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($list as $l) :
                            $id = $l['kunci_id'];
                            $rapat = $l['kunci_namarapat'];
                            $awal   = $l['kunci_awal'];
                            $akhir   = $l['kunci_akhir'];
                            $tgl   = $l['created_date'];
                            $jam1   = $l['jam_awal'];
                            $jam2   = $l['jam_akhir'];
                            $number   = $l['meeting_number'];
                            $pass   = $l['meeting_password'];
                            $pj   = $l['kunci_pj'];
                        ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $rapat; ?></td>
                                <td><?= $awal; ?></td>
                                <td><?= $akhir; ?></td>
                                <td><?= $tgl; ?></td>
                                <td><?= $jam1; ?></td>
                                <td><?= $jam2; ?></td>
                                <td><?= $number; ?></td>
                                <td><?= $pass; ?></td>
                                <td><?= $pj; ?></td>
                                <td>
                                    <span class="btn-viewvicon badge badge-pill badge-info" data-toggle="modal" data-target="#view_vicon" data-id="<?= $id; ?>">View</span>
                                    <span class="btn-editvicon badge badge-pill badge-warning" data-toggle="modal" data-target="#edit_vicon" data-id="<?= $id; ?>">Edit</span>
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
<div class="modal fade" id="addvicon" tabindex="-1" role="dialog" aria-labelledby="addviconLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('dvicon/simpan_vicon'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addviconlabel">Schedule Vicon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="text" class="tgl form-control" name="tanggal" placeholder="Tanggal" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="rapat">Nama Rapat</label>
                                    <textarea class="form-control" id="rapat" name="rapat" rows="6" cols="2"></textarea>
                                    <span id="hitung">100</span> Karakter Tersisa.
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="time" class="form-control" id="awal" name="awal" placeholder="Dari jam" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="time" class="form-control" id="akhir" name="akhir" placeholder="s.d jam" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="pic" name="pic" placeholder="PIC Rapat" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="meetnum" name="meetnum" placeholder="Meeting Number" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="meetpass" name="meetpass" placeholder="Meeting Password" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>TYPE RAPAT</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios" value="internal" checked>
                                        Internal
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios" value="eksternal">
                                        Eksternal
                                    </label>
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


<!-- Modal view -->
<div class="modal fade" id="view_vicon" tabindex="-1" role="dialog" aria-labelledby="view_viconLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('dvicon/edit_vicon'); ?>" method="post">
            <input type="hidden" id="kunci_id" name="kunci_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_viconLabel">View Vicon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <h5 class="card-title">Link Daftar Hadir Peserta : <span style="color:black;font-weight:bold" id="vlink"></span></h5>
                                    <p class="card-text">Kata Kunci Sesi Awal : *<span style="color:black;font-weight:bold" id="vkunawal"></span>*</p>
                                    <p class="card-text">Kata Kunci Sesi Akhir : *<span style="color:black;font-weight:bold" id="vkunakhir"></span>*</p>
                                    <p class="card-text"></p>
                                </div>
                            </div>
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


<!-- Modal edit -->
<div class="modal fade" id="edit_vicon" tabindex="-1" role="dialog" aria-labelledby="edit_viconLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('dvicon/edit_vicon'); ?>" method="post">
            <input type="hidden" id="kunci_id" name="kunci_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_viconLabel">Edit Vicon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Nama Rapat</label>
                                    <textarea class="form-control" id="erapat" rows="8"></textarea>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Kunci awal</label>
                                    <input type="text" class="form-control" id="ekunawal" name="kunawal">
                                </div>
                                <div class="form-group">
                                    <label>Kunci Akhir</label>
                                    <input type="text" class="form-control" id="ekunakhir" name="kunakhir">
                                </div>
                                <div class="form-group">
                                    <label>Meeting ID</label>
                                    <input type="text" class="form-control" id="emetid" name="metid">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Meeting Password</label>
                                    <input type="text" class="form-control" id="emetpas" name="metpas">
                                </div>
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" id="epic" name="pic">
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" class="form-control" id="elink" name="link">
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
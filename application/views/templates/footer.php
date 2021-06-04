<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Master-Admin <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attention!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<script>
    var base_url = '<?= base_url(); ?>';
</script>


<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>


<script type="text/javascript" src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>


<!-- Javascript Bootstrap Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.js"></script>

<script type="text/javascript" src="<?= base_url('assets/js/') . $js; ?>"></Script>

<script type="text/javascript" src="<?= base_url('assets/js/') . 'rupiah.js'; ?>"></Script>
<script type="text/javascript" src="<?= base_url('assets/js/') . 'footer.js'; ?>"></Script>
<script type="text/javascript" src="<?= base_url('assets/js/') . 'id.js'; ?>"></Script>

<!-- autocomplete js -->
<script type="text/javascript" src="<?= base_url('assets/js/') . 'autocomplete.js'; ?>"></Script>

<!-- select option chosen-->
<script type="text/javascript" src="<?= base_url('assets/js/chosen.jquery.min.js'); ?>"></script>

<script type="text/javascript">
    function checkAll(ele) {
        var checkboxes = document.getElementsByTagName('input');
        if (ele.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                }
            }
        }
    }
</script>
<script type="text/javascript">
    $(".chosen-select").chosen({
        width: "512px"
    });
</script>

<script type="text/javascript">
    // untuk pencarian data master barang
    var url2 = '<?= base_url(); ?>' + 'mstbrg/getMstBrgId';
    //autocomplete
    $('.caridata').autoComplete({
        resolver: 'custom',
        minLength: 2,

        events: {
            search: function(qry, callback) {
                // let's do a custom ajax call

                $.ajax(
                    url2,

                    {
                        data: {
                            'qry': qry
                        },
                        dataType: 'JSON',
                    }
                ).done(function(res) {
                    callback(res.results)
                });
            }
        }
    });

    $('.caridata').on('autocomplete.select', function(evt, item) {
        var e = $(this);
        e.prop('disable', true);
        console.log('selected', item.id);
        $("input:text[name='kodesskel']").val(item.id);
        return false;
    });
    $(document).on("click", "#reset", function(e) {
        e.preventDefault();
        $('.caridata').prop('disable', false);
        $('.caridata').val('');
        $("input:text[name='kodesskel']").val('');
    });
</script>
<script type="text/javascript">
    // untuk pencarian data pemakaian barang
    var url = '<?= base_url(); ?>' + 'pmakai/getPemakaiId';
    //autocomplete
    $('.caripakai').autoComplete({
        resolver: 'custom',
        minLength: 2,

        events: {
            search: function(qry2, callback) {
                // let's do a custom ajax call

                $.ajax(
                    url,

                    {
                        data: {
                            'qry2': qry2
                        },
                        dataType: 'JSON',
                    }
                ).done(function(res) {
                    callback(res.results)
                });
            }
        }
    });

    $('.caripakai').on('autocomplete.select', function(evt, item) {
        var e = $(this);
        e.prop('disable', true);
        console.log('selected', item.hrg_satuan);
        $("input:text[name='kode_dok']").val(item.kode_dok);
        $("input:text[name='kodesskel']").val(item.kode_brg);
        $("input:text[name='satuan']").val(item.satuan);
        $("input:text[name='hrg_satuan']").val(item.hrg_satuan);
        $("input:text[name='jml_in']").val(item.jml_in);
        return false;
    });
    $(document).on("click", "#reset", function(e) {
        e.preventDefault();
        $('.caripakai').prop('disable', false);
        $('.caripakai').val('');
        $("input:text[name='kode_dok']").val('');
        $("input:text[name='kodesskel']").val('');
        $("input:text[name='satuan']").val('');
        $("input:text[name='hrg_satuan']").val('');
        $("input:text[name='jml_in']").val('');
    });
</script>
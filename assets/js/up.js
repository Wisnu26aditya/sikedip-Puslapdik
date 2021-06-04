
        //btn klik LPJ UP
        $(document).on("click", ".btn-deleteup", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var url = base_url + 'up/getUpId?id=' + id;
            //  alert(id);
            $.ajax({
                url: url,
                method: 'GET',
                cache: false,
                dataType: 'JSON',
                success: function(data) {
                    //alert(data);
                    $("#txtid").html(data.dokumen_id);
                    $("#dkode_up").val(data.dokumen_id);
                    $("#dfile_spp").val(data.dokumen_spp);
                    $("#dfile_spm").val(data.dokumen_spm);
                    $("#dfile_sp2d").val(data.dokumen_sp2d);
                    $("#dfile_bukti").val(data.dokumen_buktipengeluaran);
                    $("#dfile_pajak").val(data.dokumen_setorpajak);
                    $("#dfile_pengembalian").val(data.dokumen_setorpengembalian);
                },
                error: function(e) {
                    alert("Fail");
                }
            })
        });

        $(document).on("click", ".btn-viewup", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var url = base_url + 'up/getUpId?id=' + id;
            var pathDownload = base_url + 'src/upload/lpj/';
            //  alert(id);
            $.ajax({
                url: url,
                method: 'GET',
                cache: false,
                dataType: 'JSON',
                success: function(data) {
                    //alert(data);
                    $("#vnospp").val(data.lpj_nomorsppspm);
                    $("#vtgl").val(data.lpj_tgl);
                    $("#vnilaispm").val(data.lpj_nilaispm);
                    $("#vuraian").val(data.lpj_uraian);
                    $("#vnosp2d").val(data.lpj_tgl);
                    $("#vcreated_by").val(data.created_by);
                    $("#vtglsp2d").val(data.lpj_nomorsp2d);
                    $("#vnilaisp2d").val(data.lpj_nilaisp2d);
                    $("#vkode_up").val(data.dokumen_id);
                    $("#vfile_spp").val(data.dokumen_spp);
                    $("#vfile_spm").val(data.dokumen_spm);
                    $("#vfile_sp2d").val(data.dokumen_sp2d);
                    $("#vfile_bukti").val(data.dokumen_buktipengeluaran);
                    $("#vfile_pajak").val(data.dokumen_setorpajak);
                    $("#vfile_pengembalian").val(data.dokumen_setorpengembalian);
                    
                    var filespp = pathDownload + data.dokumen_spp;
                    var filespm = pathDownload + data.dokumen_spm;
                    var filesp2d = pathDownload + data.dokumen_sp2d;
                    var filebukti = pathDownload + data.dokumen_buktipengeluaran;
                    var filepajak = pathDownload + data.dokumen_setorpajak;
                    var filepengembalian = pathDownload + data.dokumen_setorpengembalian;
        
                    $("#vfile_spp").attr("href", filespp);
                    $("#vfile_spm").attr("href", filespm);
                    $("#vfile_sp2d").attr("href", filesp2d);
                    $("#vfile_bukti").attr("href", filebukti);
                    $("#vfile_pajak").attr("href", filepajak);
                    $("#vfile_pengembalian").attr("href", filepengembalian);
                },
                error: function(e) {
                    alert("Fail");
                }
            })
        });

        $(document).on("click", ".btn-editup", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var url = base_url + 'up/getUpId?id=' + id;
            //  alert(id);
            $.ajax({
                url: url,
                method: 'GET',
                cache: false,
                dataType: 'JSON',
                success: function(data) {
                    $("#lpj_id").val(id);
                    $("#enospp").val(data.lpj_nomorsppspm);
                    $("#etgl").val(data.lpj_tgl);
                    $("#enilaispm").val(data.lpj_nilaispm);
                    $("#euraian").val(data.lpj_uraian);
                    $("#ecreated_by").val(data.created_by);
                    $("#enosp2d").val(data.lpj_nomorsp2d);
                    $("#etglsp2d").val(data.lpj_tgl);
                    $("#enilaisp2d").val(data.lpj_nilaisp2d);
                    $("#ekode_up").val(data.dokumen_id);
                    $("#efile_spp").val(data.dokumen_spp);
                    $("#efile_spm").val(data.dokumen_spm);
                    $("#efile_sp2d").val(data.dokumen_sp2d);
                    $("#efile_bukti").val(data.dokumen_buktipengeluaran);
                    $("#efile_pajak").val(data.dokumen_setorpajak);
                    $("#efile_pengembalian").val(data.dokumen_setorpengembalian);
                },
                error: function(e) {
                    alert("Fail");
                }
            })
        });
        // sampai disini btn klik LPJ UP

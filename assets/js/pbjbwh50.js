
        //btn klik LPJ PBJBWH50
        $(document).on("click", ".btn-deletepbjbwh50", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var url = base_url + 'pbjbwh50/getPbjbwh50Id?id=' + id;
            //  alert(id);
            $.ajax({
                url: url,
                method: 'GET',
                cache: false,
                dataType: 'JSON',
                success: function(data) {
                    //alert(data);
                    $("#txtid").html(data.dokumen_id);
                    $("#dkode_pbj").val(data.dokumen_id);
                    $("#dfile_spp").val(data.dokumen_spp);
                    $("#dfile_spm").val(data.dokumen_spm);
                    $("#dfile_sp2d").val(data.dokumen_sp2d);
                    $("#dfile_pembelian").val(data.dokumen_buktipembelian);
                },
                error: function(e) {
                    alert("Fail");
                }
            })
        });

        $(document).on("click", ".btn-viewpbjbwh50", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var url = base_url + 'pbjbwh50/getPbjbwh50Id?id=' + id;
            var pathDownload = base_url + 'src/upload/lpj/';
            //alert(id);
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
                    $("#vkode_pbj").val(data.dokumen_id);
                    $("#vfile_spp").val(data.dokumen_spp);
                    $("#vfile_spm").val(data.dokumen_spm);
                    $("#vfile_sp2d").val(data.dokumen_sp2d);
                    $("#vfile_pembelian").val(data.dokumen_buktipembelian);
                    
                    var filespp = pathDownload + data.dokumen_spp;
                    var filespm = pathDownload + data.dokumen_spm;
                    var filesp2d = pathDownload + data.dokumen_sp2d;
                    var filepembelian = pathDownload + data.dokumen_buktipembelian;
        
                    $("#vfile_spp").attr("href", filespp);
                    $("#vfile_spm").attr("href", filespm);
                    $("#vfile_sp2d").attr("href", filesp2d);
                    $("#vfile_pembelian").attr("href", filepembelian);
                },
                error: function(e) {
                    alert("Fail");
                }
            })
        });

        $(document).on("click", ".btn-editpbjbwh50", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var url = base_url + 'pbjbwh50/getPbjbwh50Id?id=' + id;
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
                    $("#ekode_pbj").val(data.dokumen_id);
                    $("#efile_spp").val(data.dokumen_spp);
                    $("#efile_spm").val(data.dokumen_spm);
                    $("#efile_sp2d").val(data.dokumen_sp2d);
                    $("#efile_pembelian").val(data.dokumen_buktipembelian);
                },
                error: function(e) {
                    alert("Fail");
                }
            })
        });
        // sampai disini btn klik LPJ PBJBWH50

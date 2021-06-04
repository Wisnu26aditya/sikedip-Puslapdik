

        //btn klik LPJ PBJATAS50
        $(document).on("click", ".btn-deletepbjatas50", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var url = base_url + 'pbjatas50/getPbjatas50Id?id=' + id;
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
                    $("#dfile_pengadaan").val(data.dokumen_pengadaan);
                    $("#dfile_karwas").val(data.dokumen_karwas);
                },
                error: function(e) {
                    alert("Fail");
                }
            })
        });

        $(document).on("click", ".btn-viewpbjatas50", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var url = base_url + 'pbjatas50/getPbjatas50Id?id=' + id;
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
                    $("#vfile_pengadaan").val(data.dokumen_pengadaan);
                    $("#vfile_karwas").val(data.dokumen_karwas);
                    
                    var filespp = pathDownload + data.dokumen_spp;
                    var filespm = pathDownload + data.dokumen_spm;
                    var filesp2d = pathDownload + data.dokumen_sp2d;
                    var filepengadaan = pathDownload + data.dokumen_pengadaan;
                    var filekarwas = pathDownload + data.dokumen_karwas;
        
                    $("#vfile_spp").attr("href", filespp);
                    $("#vfile_spm").attr("href", filespm);
                    $("#vfile_sp2d").attr("href", filesp2d);
                    $("#vfile_pengadaan").attr("href", filepengadaan);
                    $("#vfile_karwas").attr("href", filekarwas);
                },
                error: function(e) {
                    alert("Fail");
                }
            })
        });

        $(document).on("click", ".btn-editpbjatas50", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var url = base_url + 'pbjatas50/getPbjatas50Id?id=' + id;
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
                    $("#efile_pengadaan").val(data.dokumen_pengadaan);
                    $("#efile_karwas").val(data.dokumen_karwas);
                },
                error: function(e) {
                    alert("Fail");
                }
            })
        });
        // sampai disini btn klik LPJ PBJATAS50

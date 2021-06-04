//btn klik LPJ Perjadin
$(document).on("click", ".btn-deleteprj", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'perjadin/getPerjadinId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#txtid").html(data.dokumen_id);
            $("#dkode_prj").val(data.dokumen_id);
            $("#dfile_spp").val(data.dokumen_spp);
            $("#dfile_spm").val(data.dokumen_spm);
            $("#dfile_sp2d").val(data.dokumen_sp2d);
            $("#dfile_sk").val(data.dokumen_sk);
            $("#dfile_laporan").val(data.dokumen_laporan);
            $("#dfile_kuitansi").val(data.dokumen_kuitansi);
            $("#dfile_biodata").val(data.dokumen_biodata);
            $("#dfile_daftar").val(data.dokumen_daftarhadir);
            $("#dfile_atk").val(data.dokumen_atk);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-viewprj", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'perjadin/getPerjadinId?id=' + id;
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
            $("#vnama_keg").val(data.nama_keg);
            $("#vtgl_keg").val(data.tgl_keg);
            $("#vkode_mak").val(data.kode_mak);
            $("#vkode_prj").val(data.dokumen_id);
            $("#vfile_spp").val(data.dokumen_spp);
            $("#vfile_spm").val(data.dokumen_spm);
            $("#vfile_sp2d").val(data.dokumen_sp2d);
            $("#vfile_sk").val(data.dokumen_sk);
            $("#vfile_kuitansi").val(data.dokumen_kuitansi);
            $("#vfile_laporan").val(data.dokumen_laporan);
            $("#vfile_biodata").val(data.dokumen_biodata);
            $("#vfile_daftar").val(data.dokumen_daftarhadir);
            $("#vfile_atk").val(data.dokumen_atk);
            var filespp = pathDownload + data.dokumen_spp;
            var filespm = pathDownload + data.dokumen_spm;
            var filesp2d = pathDownload + data.dokumen_sp2d;
            var filesk = pathDownload + data.dokumen_sk;
            var filekuitansi = pathDownload + data.dokumen_kuitansi;
            var filelaporan = pathDownload + data.dokumen_laporan;
            var filebiodata = pathDownload + data.dokumen_biodata;
            var filedaftar = pathDownload + data.dokumen_daftarhadir;
            var fileatk = pathDownload + data.dokumen_atk;

            $("#vfile_spp").attr("href", filespp);
            $("#vfile_spm").attr("href", filespm);
            $("#vfile_sp2d").attr("href", filesp2d);
            $("#vfile_sk").attr("href", filesk);
            $("#vfile_kuitansi").attr("href", filekuitansi);
            $("#vfile_laporan").attr("href", filelaporan);
            $("#vfile_biodata").attr("href", filebiodata);
            $("#vfile_daftar").attr("href", filedaftar);
            $("#vfile_atk").attr("href", fileatk);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-editprj", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'perjadin/getPerjadinId?id=' + id;
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
            $("#enama_keg").val(data.nama_keg);
            $("#etgl_keg").val(data.tgl_keg);
            $("#ekode_mak").val(data.kode_mak);
            $("#ekode_prj").val(data.dokumen_id);
            $("#efile_spp").val(data.dokumen_spp);
            $("#efile_spm").val(data.dokumen_spm);
            $("#efile_sp2d").val(data.dokumen_sp2d);
            $("#efile_sk").val(data.dokumen_sk);
            $("#efile_laporan").val(data.dokumen_laporan);
            $("#efile_kuitansi").val(data.dokumen_kuitansi);
            $("#efile_biodata").val(data.dokumen_biodata);
            $("#efile_daftar").val(data.dokumen_daftarhadir);
            $("#efile_atk").val(data.dokumen_atk);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});
// sampai disini btn klik LPJ Perjadin

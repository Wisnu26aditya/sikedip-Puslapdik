//btn klik LPJ Honkeg
$(document).on("click", ".btn-deletehkg", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'honkeg/getHonkegId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#txtid").html(data.dokumen_id);
            $("#dkode_hkg").val(data.dokumen_id);
            $("#dfile_spp").val(data.dokumen_spp);
            $("#dfile_spm").val(data.dokumen_spm);
            $("#dfile_sp2d").val(data.dokumen_sp2d);
            $("#dfile_sk").val(data.dokumen_sk);
            $("#dfile_kuitansi").val(data.dokumen_kuitansi);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-viewhkg", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'honkeg/getHonkegId?id=' + id;
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
            $("#vnilaisp2d").val(data.nama_keg);
            $("#vnilaisp2d").val(data.tgl_keg);
            $("#vnilaisp2d").val(data.kode_mak);
            $("#vkode_hkg").val(data.dokumen_id);
            $("#vfile_spp").val(data.dokumen_spp);
            $("#vfile_spm").val(data.dokumen_spm);
            $("#vfile_sp2d").val(data.dokumen_sp2d);
            $("#vfile_sk").val(data.dokumen_sk);
            $("#vfile_kuitansi").val(data.dokumen_kuitansi);
            
            var filespp = pathDownload + data.dokumen_spp;
            var filespm = pathDownload + data.dokumen_spm;
            var filesp2d = pathDownload + data.dokumen_sp2d;
            var filesk = pathDownload + data.dokumen_sk;
            var filekuitansi = pathDownload + data.dokumen_kuitansi;

            $("#vfile_spp").attr("href", filespp);
            $("#vfile_spm").attr("href", filespm);
            $("#vfile_sp2d").attr("href", filesp2d);
            $("#vfile_sk").attr("href", filesk);
            $("#vfile_kuitansi").attr("href", filekuitansi);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-edithkg", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'honkeg/getHonkegId?id=' + id;
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert($data);
            $("#lpj_id").val(id);
            $("#enospp").val(data.lpj_nomorsppspm);
            $("#etgl").val(data.lpj_tgl);
            $("#enilaispm").val(data.lpj_nilaispm);
            $("#euraian").val(data.lpj_uraian);
            $("#ecreated_by").val(data.created_by);
            $("#enosp2d").val(data.lpj_nomorsp2d);
            $("#etglsp2d").val(data.lpj_tgl);
            $("#enilaisp2d").val(data.lpj_nilaisp2d);
            $("#ekode_hkg").val(data.dokumen_id);
            $("#efile_spp").val(data.dokumen_spp);
            $("#efile_spm").val(data.dokumen_spm);
            $("#efile_sp2d").val(data.dokumen_sp2d);
            $("#efile_sk").val(data.dokumen_sk);
            $("#efile_kuitansi").val(data.dokumen_kuitansi);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});
// sampai disini btn klik LPJ Honkeg

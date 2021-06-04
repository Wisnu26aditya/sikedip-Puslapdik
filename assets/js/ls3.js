//btn klik LS Pihak Ketiga
$(document).on("click", ".btn-deletels3", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'ls3/getLsTiga?id=' + id;
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#txtid").html(data.spp_dok_id);
            $("#dkode_ls3").val(data.spp_dok_id);
            $("#dfile_pengadaan").val(data.dok_pengadaan);
            $("#dfile_karwas").val(data.dok_karwas);
            $("#dfile_persetujuan").val(data.dok_persetujuan);
            $("#dfile_spp").val(data.dok_spp);
            $("#dfile_ssp").val(data.dok_ssp);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-viewls3", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'ls3/getLsTiga?id=' + id;
    var pathDownload = base_url + 'src/upload/spp/';
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#vnospp").val(data.spp_no);
            $("#vtgl").val(data.spp_tgl);
            $("#vnilaispp").val(data.spp_nilai);
            $("#vkode_ls3").val(data.spp_dok_id);
            $("#vfile_pengadaan").val(data.dok_pengadaan);
            $("#vfile_karwas").val(data.dok_karwas);
            $("#vfile_persetujuan").val(data.dok_persetujuan);
            $("#vfile_spp").val(data.dok_spp);
            $("#vfile_ssp").val(data.dok_ssp);
            var filepengadaan = pathDownload + data.dok_pengadaan;
            var filekarwas = pathDownload + data.dok_karwas;
            var filepersetujuan = pathDownload + data.dok_persetujuan;
            var filespp = pathDownload + data.dok_spp;
            var filessp = pathDownload + data.dok_ssp;

            $("#vfile_pengadaan").attr("href", filepengadaan);
            $("#vfile_karwas").attr("href", filekarwas);
            $("#vfile_persetujuan").attr("href", filepersetujuan);
            $("#vfile_spp").attr("href", filespp);
            $("#vfile_ssp").attr("href", filessp);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-editls3", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'ls3/getLsTiga?id=' + id;
    var pathDownload = base_url + 'src/upload/spp/';
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#id").val(data.spp_dok_id);
            $("#enospp").val(data.spp_no);
            $("#etgl").val(data.spp_tgl);
            $("#enilaispp").val(data.spp_nilai);
            $("#ekode_ls3").val(data.spp_dok_id);
            $("#efile_pengadaan").val(data.dok_pengadaan);
            $("#efile_karwas").val(data.dok_karwas);
            $("#efile_persetujuan").val(data.dok_persetujuan);
            $("#efile_spp").val(data.dok_spp);
            $("#efile_ssp").val(data.dok_ssp);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});
// sampai disini btn klik LS Pihak Ketiga

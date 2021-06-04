//btn klik LS Uang Makan
$(document).on("click", ".btn-deleteum", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'uangmakan/getLsUangmakan?id=' + id;
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#txtid").html(data.spp_dok_id);
            $("#dkode_um").val(data.spp_dok_id);
            $("#dfile_dpp").val(data.dok_dpp);
            $("#dfile_spp").val(data.dok_spp);
            $("#dfile_ssp").val(data.dok_ssp);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-viewum", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'uangmakan/getLsUangmakan?id=' + id;
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
            $("#vkode_um").val(data.spp_dok_id);
            $("#vfile_dpp").val(data.dok_dpp);
            $("#vfile_spp").val(data.dok_spp);
            $("#vfile_ssp").val(data.dok_ssp);
            var filedpp = pathDownload + data.dok_dpp;
            var filespp = pathDownload + data.dok_spp;
            var filessp = pathDownload + data.dok_ssp;

            $("#vfile_dpp").attr("href", filedpp);
            $("#vfile_spp").attr("href", filespp);
            $("#vfile_ssp").attr("href", filessp);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-editum", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'uangmakan/getLsUangmakan?id=' + id;
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
            $("#ekode_um").val(data.spp_dok_id);
            $("#efile_dpp").val(data.dok_dpp);
            $("#efile_spp").val(data.dok_spp);
            $("#efile_ssp").val(data.dok_ssp);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});
// sampai disini btn klik LS Uangmakan

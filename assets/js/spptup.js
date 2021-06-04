//btn klik SPPTUP
$(document).on("click", ".btn-deletespptup", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'spptup/getSpptup?id=' + id;
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#txtid").html(data.spp_dok_id);
            $("#dkode_spptup").val(data.spp_dok_id);
            $("#dfile_drpp").val(data.dok_drpp);
            $("#dfile_sptb").val(data.dok_sptb);
            $("#dfile_spp").val(data.dok_spp);
            $("#dfile_ssp").val(data.dok_ssp);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-viewspptup", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'spptup/getSpptup?id=' + id;
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
            $("#vkode_spptup").val(data.spp_dok_id);
            $("#vfile_drpp").val(data.dok_drpp);
            $("#vfile_sptb").val(data.dok_sptb);
            $("#vfile_spp").val(data.dok_spp);
            $("#vfile_ssp").val(data.dok_ssp);
            var filedrpp = pathDownload + data.dok_drpp;
            var filesptb = pathDownload + data.dok_sptb;
            var filespp = pathDownload + data.dok_spp;
            var filessp = pathDownload + data.dok_ssp;

            $("#vfile_drpp").attr("href", filedrpp);
            $("#vfile_sptb").attr("href", filesptb);
            $("#vfile_spp").attr("href", filespp);
            $("#vfile_ssp").attr("href", filessp);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-editspptup", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'spptup/getSpptup?id=' + id;
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
            $("#ekode_spptup").val(data.spp_dok_id);
            $("#efile_drpp").val(data.dok_drpp);
            $("#efile_sptb").val(data.dok_sptb);
            $("#efile_spp").val(data.dok_spp);
            $("#efile_ssp").val(data.dok_ssp);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});
// sampai disini btn klik SPPTUP

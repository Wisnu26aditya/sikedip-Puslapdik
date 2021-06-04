//btn klik LS honor
$(document).on("click", ".btn-deletelsh", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'lshonor/getLsHonor?id=' + id;
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#txtid").html(data.spp_dok_id);
            $("#dkode_lsh").val(data.spp_dok_id);
            $("#dfile_spp").val(data.dok_spp);
            $("#dfile_nominatif").val(data.dok_nominatif);
            $("#dfile_sk").val(data.dok_sk);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-viewlsh", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'lshonor/getLsHonor?id=' + id;
    var pathDownload = base_url + 'src/upload/spp/';
    //  alert(id);
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
            $("#vkode_lsh").val(data.spp_dok_id);
            $("#vfile_spp").val(data.dok_spp);
            $("#vfile_nominatif").val(data.dok_nominatif);
            $("#vfile_sk").val(data.dok_sk);
            var filespp = pathDownload + data.dok_spp;
            var filesk = pathDownload + data.dok_sk;
            var filenominatif = pathDownload + data.dok_nominatif;

            $("#vfile_spp").attr("href", filespp);
            $("#vfile_sk").attr("href", filesk);
            $("#vfile_nominatif").attr("href", filenominatif);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-editlsh", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'lshonor/getLsHonor?id=' + id;
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
            $("#ekode_lsh").val(data.spp_dok_id);
            $("#efile_spp").val(data.dok_spp);
            $("#efile_nominatif").val(data.dok_nominatif);
            $("#efile_sk").val(data.dok_sk);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});
// sampai disini btn klik LPJ Honor

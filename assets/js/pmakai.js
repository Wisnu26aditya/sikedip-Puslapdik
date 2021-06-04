//btn klik Psedia
$(document).on("click", ".btn-accpmakai", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'pmakai/getDataPakaiId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#adok").html(data.dok_id);
            $("#ahrg_satuan").val(data.hrg_satuan);
            $("#ahrg_total").val(data.hrg_total);
            $("#aket").val(data.ket);
            $("#asskel_brg").html(data.sskel_brg);
            $("#anama_brg").html(data.nama_brg);
            $("#ajml_out").html(data.jml_out);
            $("#astatus").val(data.status);
            $("#asatuan").html(data.satuan);
            },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-editpsd", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'mstbrg/getPsediaId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            $("#eid").val(data.kode_id);   
            $("#esskel_brg").val(data.sskel_brg);
            $("#edept").val(data.ms_deptid);
            $("#ekd_brg").val(data.kode_brg);
            $("#enama_brg").val(data.nama_brg);
            $("#esatuan").val(data.satuan);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

//btn klik Psedia
$(document).on("click", ".btn-deletepsd", function(e) {
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
            //alert(data);
            $("#did").val(data.kode_id);
            $("#dsskel_brg").val(data.sskel_brg);
            $("#dkode_brg").val(data.kode_brg);
            $("#dnama_brg").val(data.nama_brg);
            $("#dsatuan").val(data.satuan);
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

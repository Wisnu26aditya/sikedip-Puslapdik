//btn klik vicon
$(document).on("click", ".btn-viewvicon", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'dvicon/getviconid?id=' + id;
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#vkunci_id").html(data.kunci_id);
            $("#vrapat").html(data.kunci_namarapat);
            $("#vkunawal").html(data.kunci_awal);
            $("#vkunakhir").html(data.kunci_akhir);
            $("#vmetid").html(data.meeting_number);
            $("#vmetpas").html(data.meeting_password);
            $("#vpic").html(data.kunci_pj);
            $("#vlink").html(data.kunci_link);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});
$(document).on("click", ".btn-editvicon", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'dvicon/getviconid?id=' + id;
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#kunci_id").val(data.kunci_id);
            $("#erapat").val(data.kunci_namarapat);
            $("#ekunawal").val(data.kunci_awal);
            $("#ekunakhir").val(data.kunci_akhir);
            $("#emetid").val(data.meeting_number);
            $("#emetpas").val(data.meeting_password);
            $("#epic").val(data.kunci_pj);
            $("#elink").val(data.kunci_link);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

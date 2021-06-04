$(document).on("click", ".btn-akses", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'akses/getAksesId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#urut").val(data.id);
            $("#userid").val(data.role_id);
            $("#nama").val(data.name);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-editakses", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'akses/getAksesId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#id").val(data.id);
            $("#aname").val(data.name);
            $("#aemail").val(data.email);
            $("#aimage").val(data.image);
            $("#arole").val(data.role_id);
            $("#aactive").val(data.is_active);
            $("#aupload").val(data.is_upload);
            $("#adownload").val(data.is_download);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});
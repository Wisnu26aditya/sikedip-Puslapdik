$(document).on("click", ".btn-editreg", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'reg/getRegId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#eid").val(data.id);
            $("#ename").val(data.name);
            $("#eemail").val(data.email);
            $("#eimage").val(data.image);
            $("#erole").val(data.role_id);
            $("#eactive").val(data.is_active);
            $("#eupload").val(data.is_upload);
            $("#edownload").val(data.is_download);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-ignorereg", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'reg/getRegId?id=' + id;
    //alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#aname").val(data.name);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});
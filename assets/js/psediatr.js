//btn klik Psedia
$(document).on("click", ".btn-deletepsdtr", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'psediabeli/getPsediatrId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            //alert(data);
            $("#d_dokid").html(data.dok_id);
            $("#dno_bukti").html(data.no_bukti);
            $("#dsskel_brg").val(data.sskel_brg);
            },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-editpsdtr", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'psediabeli/getPsediatrId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            $("#eid").val(data.tr_id);   
            $("#edok_id").val(data.dok_id);
            $("#eno_bukti").val(data.no_bukti);
            $("#etgl_dok").val(data.tgl_dok);
            $("#etgl_buku").val(data.tgl_buku);
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

$(document).on("click", ".btn-viewpsdtr", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var url = base_url + 'psediabeli/getPsediatrdtId?id=' + id;
    //  alert(id);
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            // alert(data.detail.dok_id);
            $("#vid").val(data.detail.dt_id);   
            $("#vdok_id").val(data.detail.dok_id);
            $("#vno_bukti").val(data.detail.no_bukti);
            $("#vtgl_dok").val(data.detail.tgl_dok);
            $("#vtgl_buku").val(data.detail.tgl_buku);
            $("#vjml_in").val(data.detail.jml_in);
            $("#vhrg_satuan").val(data.detail.hrg_satuan);
            $("#vhrg_total").val(data.detail.hrg_total);
            $("#vakun").val(data.detail.akun);
            $("#vket").val(data.detail.ket);
            var table='';
            for(i=0;i<data.results.length;i++){
                var a = data.results[i];
                table+="<tr>";
                table+="<td>"+(i+1)+"</td>";
                table+="<td>"+a.nama_brg+"</td>";
                table+="<td>"+a.jml_in+"</td>";
                table+="<td>"+a.satuan+"</td>";
                table+="<td>Rp. "+a.hrg_satuan+"</td>";
                table+="<td>Rp. "+a.hrg_total+"</td>";
                table+="<td>"+a.akun+"</td>";
                if (a.ket==null) {
                    table+="<td></td>";
                } else {
                    table+="<td>"+a.ket+"</td>";
                } 
                table+="</tr>";
            }
            $("tbody#isi").html(table);
            
        },
        error: function(e) {
            alert("Fail");
        }
    })
});

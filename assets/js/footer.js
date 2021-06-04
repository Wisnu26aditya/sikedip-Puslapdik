$('#table-akses').DataTable({
    "pageLength": 5,
    "lengthMenu": [
        [5, 25, 50, -1],
        [5, 25, 50, "All"]
    ],
    "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        },
        {
            "targets": [-2], //2 last column (photo)
            "orderable": false, //set not orderable
        },
    ],

}),

$('#submenu').DataTable({
    "pageLength": 5,
    "lengthMenu": [
        [5, 25, 50, -1],
        [5, 25, 50, "All"]
    ],
    "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        },
        {
            "targets": [-2], //2 last column (photo)
            "orderable": false, //set not orderable
        },
    ],
    
})

$('#tglsp2d').datepicker({
uiLibrary: "bootstrap4"
});
$('.tgl').datepicker({
locale:'id',
format:'d-mm-yyyy'
});
$('#tglpengajuan').datepicker({
uiLibrary: "bootstrap4"
});
$('#awal').datetimepicker({
uiLibrary: "bootstrap4",
});
$('#akhir').timepicker({
uiLibrary: "bootstrap4"
});

function hanyaAngka(evt) {
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))

return false;
return true;
}
var next = 0;

$("#add-more").click(function(e) {
e.preventDefault();
var addto = "#field" + next;
var addRemove = "#field" + (next);
next = next + 1;
var newIn = ' <div id="field' + next + '" name="field' + next +
    '" class="fieldadd"><div class="row"><div class="col-md-auto"><div class="form-group"><label for="no">Nomor SPP</label>' +
    '<input id="no" name="no[]" maxlength="5" onkeypress="return hanyaAngka(event)" type="text" placeholder="" class="form-control" autocomplete="off"></div></div>' +
    '<div class="col-md-auto"><div class="form-group"><label for="tgl">Tanggal SPP</label>' +
    '<input  name="tgl[]" type="text" placeholder="" class="tgl form-control" autocomplete="off"></div></div>' +
    '<div class="col-md-auto"><div class="form-group"><label for="nilai">Nilai SPP</label>' +
    '<input id="nilai" name="nilai[]"  onkeyup="convertToRupiah(this);" type="text" placeholder="" class="form-control" autocomplete="off"></div></div></div>';
var newInput = $(newIn);
var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="field"><div class="row">';
var removeButton = $(removeBtn);
$(addto).after(newInput);
$(addRemove).after(removeButton);
$("#field" + next).attr('data-source', $(addto).attr('data-source'));
$("#count").val(next);
$("input.tgl").datepicker({
    uiLibrary: "bootstrap4"
});
$('.remove-me').click(function(e) {
    e.preventDefault();
    var fieldNum = this.id.charAt(this.id.length - 1);
    var fieldID = "#field" + fieldNum;
    $(this).remove();
    $(fieldID).remove();
});
});

$(document).on("click", "#btn_add_ls", function(e) {
e.preventDefault();
$(".remove-me").remove();
$(".fieldadd").remove();
});

$("#add-psedia").click(function(e) {
  e.preventDefault();
  var addto = "#field" + next;
  var addRemove = "#field" + (next);
  next = next + 1;
  var newIn = ' <div id="field' + next + '" name="field' + next +
      '" class="fieldadd"><div class="row"><div class="col-md-auto"><div class="form-group">' +
      '<select class="chosen-select form-control" id="esskel_brg" name="esskel_brg[]" required>'+
      '<option value="">Pilih SSKEL Barang</option><?php foreach ($mstbrg as $row) : ?><option value="<?= $row->sskel_brg;?>"><?= $row->nama_brg;?></option>'+
      '<?php endforeach; ?></select></div></div>' +
      '<div class="col-md-auto">'+
      '<div class="form-group">' +
      '<input type="text" class="form-control" id="ejml_in" name="ejml_in[]" placeholder="Jumlah Masuk" autocomplete="off">'+
      '</div>' +
      '<div class="form-group">'+
      '<input type="text" onkeyup="convertToRupiah(this);" onkeypress="return hanyaAngka(event)" class="form-control" id="ehrg_satuan" name="ehrg_satuan[]" placeholder="Harga Satuan" autocomplete="off">'+
      '</div></div>' +
      '<div class="col-md-auto"><div class="form-group">' +
      '<input type="text" class="form-control" id="eakun" name="eakun[]" placeholder="Akun" autocomplete="off">'+
      '</div>' +
      '<div class="form-group">'+
      '<input type="text" class="form-control" id="eket" name="eket" placeholder="Keterangan" autocomplete="off">'+
      '</div></div>' +
      '</div>';
  var newInput = $(newIn);
  var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="field"><div class="row">';
  var removeButton = $(removeBtn);
  $(addto).after(newInput);
  $(addRemove).after(removeButton);
  $("#field" + next).attr('data-source', $(addto).attr('data-source'));
  $("#count").val(next);
  $(".chosen-select").chosen({
    width: "512px"
  });
  $('.remove-me').click(function(e) {
      e.preventDefault();
      var fieldNum = this.id.charAt(this.id.length - 1);
      var fieldID = "#field" + fieldNum;
      $(this).remove();
      $(fieldID).remove();
  });
  });
  
  $(document).on("click", "btn-editpsdtr", function(e) {
  e.preventDefault();
  $(".remove-me").remove();
  $(".fieldadd").remove();
  });

  
  
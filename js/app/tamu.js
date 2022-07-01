function add(){
    $('#tombol').hide();
    $('#form_box').show()
    $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-12');
    $('#tabel_box').addClass('col-md-8');
}
function resetApp(){
    $('#tombol').show();
    $('#form_box').hide()
    // $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-8');
    $('#tabel_box').addClass('col-md-12');
    $('#idx').val("");
    $('#tamu_nama').val("")
    $('#err_tamu_nama').html("")
    $('#err_tamu_status').html("")
}
function edit(idx,tamu_tgl,tamu_nama,tamu_telp,tamu_email,tamu_komentar,tamu_status){
    add();
    $('#idx').val(idx);
    $('#tamu_nama').html(tamu_nama)
    $('#tamu_tgl').html(tamu_tgl)
    $('#tamu_telp').html(tamu_telp)
    $('#tamu_email').html(tamu_email)
    $('#tamu_komentar').html(tamu_komentar)
    if(tamu_status==0) {
        $('#tamu_status').prop('checked',true);
        // alert("checked")
    }
    else  $('#tamu_status').prop('checked',false);
}
function simpan(){
    var url;
    url = base_url + "admin/tamu/simpan";
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data : formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(data)
        {
            if(data["status"]==true){
                if(data["error"]==true){
                    // $('#csrf').val(data["csrf"]);
                    if(data["err_tamu_nama"]!="") $('#err_tamu_nama').html(data["err_tamu_nama"]); else $('#err_tamu_nama').html("");
                    if(data["err_tamu_status"]!="") $('#err_tamu_status').html(data["err_tamu_status"]); else $('#err_tamu_status').html("");
                
                }else{
                    var start=$('#start').val();
                    getData(start);
                    resetApp();
                    swal({
                     title: "Sukses",
                     text: data["message"],
                     type: "success",
                     timer: 5000
                    });
                }
            }
            else{
                swal({
                    title: "Peringatan",
                    text: data["message"],
                    type: "warning",
                    timer: 5000
                });
            }
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal({
             title: "Terjadi Kesalahan ",
             text: "Gagal Menyimpan Data",
             type: "error",
             timer: 5000
            });
        }
    });
}

function hapus(id) {
    var isConfirm = confirm("Apakah anda yakin akan menghapus")
    if (isConfirm) {
        $.ajax({
            url: base_url + "admin/tamu/hapus/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                var start=$('#start').val();
                getData(start);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error')
            }
        });
    }
}
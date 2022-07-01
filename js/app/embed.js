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
    $('#video_katid').val("")
    $('#err_video_katid').html("")
    $('#err_video_publish').html("")
}
function edit(idx){
    add();
    // $('#idx').val(idx);
    // $('#video_katid').val(video_katid)
    // $('#video_embed').val(embed)
    // $('#video_judul').val(judul)
    // if(video_publish==1) {
    //     $('#video_publish').prop('checked',true);
    //     // alert("checked")
    // }
    // else  $('#video_publish').prop('checked',false);
    $.ajax({
        url: base_url + "admin/embed/edit/" + idx,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if(data.status==true){
                $('#idx').val(data.data.idx);
                $('#video_katid').val(data.data.video_katid)
                $('#video_embed').val(data.data.video_embed)
                $('#video_judul').val(data.data.video_judul)
                if(data.data.video_publish==1) {
                    $('#video_publish').prop('checked',true);
                    // alert("checked")
                }
                else  $('#video_publish').prop('checked',false);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
}
function simpan(){
    var url;
    url = base_url + "admin/embed/simpan";
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
                    if(data["err_video_katid"]!="") $('#err_video_katid').html(data["err_video_katid"]); else $('#err_video_katid').html("");
                    if(data["err_video_publish"]!="") $('#err_video_publish').html(data["err_video_publish"]); else $('#err_video_publish').html("");
                
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
            url: base_url + "admin/embed/hapus/" + id,
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
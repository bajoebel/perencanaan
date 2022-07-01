function create(){
    $('#form')[0].reset(); 
    var root=$('#root').val();
    // var filepath=$('#filepath').val();
    $('#curent_dir').val(root);
    $('#newfolder').modal('show'); 
}
function viewUpload(){
    // $('#form1')[0].reset(); 
    var root=$('#root').val();
    var filepath=$('#filepath').val();
    $('#curent_dir1').val(root+'/'+filepath);
    $('#uploadfile').modal('show');
}
function uploadFile(){
    var url=base_url+"admin/media/uploadfile";
    var formData = new FormData($('#form1')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data : formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function (data) {
            if(data.status==false){
                swal({
                    title: "Error",
                    text: data["message"],
                    type: "error",
                    timer: 15000
                });
            }
            var media_dirid=$('#media_dirid').val();
            openDir(media_dirid);
            $('#uploadfile').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("terjadi Kesalahan")
        }
    });
}
function filemanager(dir=''){
    var root = $('#root').val();
    var filepath=$('#filepath').val()+dir;
    // alert(filepath)
    var url=base_url+"admin/media/filemanager?dir="+root+ "/"+filepath
    $.ajax({
        url: url,
        type: "GET",
        dataType: "HTML",
        success: function (data) {
            $('#filepath').val(filepath);
            $('#files').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("terjadi Kesalahan")
        }
    });
}
function getData(start){
    $('#start').val(start);
    var search = $('#q').val();
    var limit = $('#limit').val();
    var url = base_url+'admin/media/getdata?keyword=' + search + "&start=" + start + "&limit=" + limit 
    console.clear()
    console.log(url)
    $.ajax({
        url     : url,
        type    : "GET",
        dataType: "json",
        data    : {get_param : 'value'},
        beforeSend: function () {
            var tabel = "<tr id='loading'><td colspan='5'><b>Loading...</b></td></tr>";
            $('#data').html(tabel);
            $('#pagination').html('');
        },
        success : function(data){
        //menghitung jumlah data
            console.log(data);
            var tombol='<a href="#" class="btn" onclick="create()">'+
            '<span class="fa fa-plus"></span> Buat Folder'+
            '</a>';
            $('#tombol').html(tombol);
            $('#btnKembali').prop('disabled',true);
            if(data["status"]==true){
                $('#data').html('');
                var res    = data["data"];
                console.log(res);
                var jmlData=res.length;
                var limit   = data["limit"];
                var tabel   = "";
                //Create Tabel
                var no = (parseInt(start)*parseInt(limit))-parseInt(limit);
                var dari = no+1;
                var sampai = no+parseInt(limit);
                var desc = "<button class='btn btn-default btn-sm' type='button'>Showing "+ dari + " To " + sampai + " of " +data["row_count"]+"</button>";
                for(var i=0; i<jmlData;i++){
                    no++;
                    tabel="<div class='col-md-1 col-xs-3' style='text-align:center;font-weight:bold'>"+
                    '<div class="btn-group"><a href="#" class="btn btn-warning btn-xs" onclick="edit('+res[i].dir_id+',\''+res[i].dir_nama+'\',\''+res[i].dir_status+'\',\''+res[i].dir_galery+'\',\''+res[i].dir_download+'\',\''+res[i].dir_ppid+'\')"><span class="fa fa-pencil"></span> </a>'+
                    '<button onclick="hapus('+res[i].dir_id+')" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> </button></div>'+
                    "<a href='#' onmousedown='cekAction(event,\""+res[i].dir_id+"\")' onclick='openDir(\""+res[i].dir_id+"\")'><img src='"+base_url+"img/icon/folder.png"+"' class='img img-responsive' /></a>"+res[i].dir_nama+"</div>";
                    $('#data').append(tabel);
                }
                console.log(data);
                //Create Pagination
                if(data["row_count"]<=limit){
                    $('#pagination').html("");
                }else{
                    console.log("buat Pagination");
                    var pagination="";
                    var btnIdx="";
                    jmlPage = Math.ceil(data["row_count"]/limit);
                    offset  = data["start"] % limit;
                    var curIdx = start;
                    var btn="btn-default";
                    //var lastSt=jmlPage;
                    var btnFirst="<button class='btn btn-default btn-sm' onclick='getData(1)'><span class='fa fa-angle-double-left'></span></button>";
                    if (curIdx > 1) {
                        var prevSt=curIdx-1;
                        btnFirst+="<button class='btn btn-default btn-sm' onclick='getData("+prevSt+")'><span class='fa fa-angle-left'></span></button>";
                    }

                    var btnLast="";
                    if(curIdx<jmlPage){
                        var nextSt=curIdx+1;
                        btnLast+="<button class='btn btn-default btn-sm' onclick='getData("+nextSt+")'><span class='fa fa-angle-right'></span></button>";
                    }
                    console.log(curIdx);
                    btnLast+="<button class='btn btn-default btn-sm' onclick='getData("+jmlPage+")'><span class='fa fa-angle-double-right'></span></button>";
                    
                    if(jmlPage>=5){
                        console.clear();
                        console.log('Jumlah Halaman > 5');
                        if(curIdx>=3){
                            console.log('Cur Idx >= 3');
                            var idx_start=curIdx - 2;
                            var idx_end=curIdx + 2;
                            if(idx_end>=jmlPage) idx_end=jmlPage;
                        }else{
                            var idx_start=1;
                            var idx_end=5;
                        }
                        for (var j = idx_start; j<=idx_end; j++) {
                            if(curIdx==j)  btn="btn-primary"; else btn= "btn-default";
                            btnIdx+="<button class='btn " +btn +" btn-sm' onclick='getData("+ j +")'>" + j +"</button>";
                        }
                    }else{

                        for (var j = 1; j<=jmlPage; j++) {
                            if(curIdx==j)  btn="btn-primary"; else btn= "btn-default";
                            btnIdx+="<button class='btn " +btn +" btn-sm' onclick='getData("+ j +")'>" + j +"</button>";
                        }
                    }
                    pagination+="<div class='tabel-box'><div class='btn-group'>"+desc+btnFirst + btnIdx + btnLast+"</div></div>";
                    $('#pagination').html(pagination);
                }
            }
        },
        error: function(xhr) { // if error occured
            alert("Error occured.please try again");
            $('#data').append(xhr.statusText + xhr.responseText);
            // $(placeholder).removeClass('loading');
        },
        complete : function(){
            //$('#loading').hide();
        }
    });
}
getData(1)
function cekAction(event,dir=''){
    // alert(event.which)
    switch (event.which) {
        case 1:
            // filemanager('/'+dir)
            // openDir(dir)
            // alert('Left Mouse button pressed.');
            break;
        case 2:
            alert('Middle Mouse button pressed.');
            break;
        case 3:
            alert('Right Mouse button pressed.');
            break;
        default:
            alert('You have a strange Mouse!');
    }
}
function createFolder(){
    var url=base_url+"admin/media/createfolder";
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data : formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function (data) {
            if(data.status==false){
                swal({
                    title: "Error",
                    text: data["message"],
                    type: "error",
                    timer: 5000
                });
            }
            getData(1);
            $('#newfolder').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("terjadi Kesalahan")
        }
    });
}
// filemanager();
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
    $('#kategori_id').val("");
    $('#media_keterangan').val("")
    $('#kategori_status').val("")
    $('#err_media_keterangan').html("")
    $('#err_kategori_status').html("")
}
function edit(kategori_id,media_keterangan,dir_status,dir_galeri,dir_download,dir_ppid){
    add();
    $('#xdir_id').val(kategori_id);
    $('#xdir_nama').val(media_keterangan)
    $('#xold_dir').val(media_keterangan)
    if(dir_status==1) $('#dir_status').prop('checked',true); else  $('#dir_status').prop('checked',false);
    if(dir_galeri==1) $('#dir_galery').prop('checked',true); else  $('#dir_galery').prop('checked',false);
    if(dir_download==1) $('#dir_download').prop('checked',true); else  $('#dir_download').prop('checked',false);
    if(dir_ppid==1) $('#dir_ppid').prop('checked',true); else  $('#dir_ppid').prop('checked',false);
}   
function simpan(){
    var url;
    url = base_url + "admin/media/simpan";
    var formData = new FormData($('#form2')[0]);
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
                    if(data["err_media_keterangan"]!="") $('#err_media_keterangan').html(data["err_media_keterangan"]); else $('#err_media_keterangan').html("");
                    // if(data["err_kategori_status"]!="") $('#err_kategori_status').html(data["err_kategori_status"]); else $('#err_kategori_status').html("");
                
                }else{
                    var start=$('#media_dirid').val();
                    openDir(start);
                    
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
function updateDir(){
    var url;
    url = base_url + "admin/media/updatedir";
    var formData = new FormData($('#formupdate')[0]);
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
                    if(data["err_media_keterangan"]!="") $('#err_media_keterangan').html(data["err_media_keterangan"]); else $('#err_media_keterangan').html("");
                    // if(data["err_kategori_status"]!="") $('#err_kategori_status').html(data["err_kategori_status"]); else $('#err_kategori_status').html("");
                
                }else{
                    // var start=$('#xdir_id').val();
                    add();
                    getData(1);
                    
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
function hapusFile(id='') {
    var isConfirm = confirm("Apakah anda yakin akan menghapus")
    if (isConfirm) {
        if(id=='') id=$('#media_id').val();
        $.ajax({
            url: base_url + "admin/media/hapusfile/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                var start=$('#media_dirid').val();
                openDir(start);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error')
            }
        });
    }
}

function hapus(id='') {
    var isConfirm = confirm("Apakah anda yakin akan menghapus")
    if (isConfirm) {
        if(id=='') id=$('#media_id').val();
        $.ajax({
            url: base_url + "admin/media/hapus/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                // var start=$('#media_dirid').val();
                getData(1);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error')
            }
        });
    }
}
function openFile(id){
    $.ajax({
        url: base_url + "admin/media/openfile/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#priview').modal('show');
            // alert(data.media_keterangan)
            $('#media_id').val(data.media_id);
            $('#pmedia_keterangan').val(data.media_keterangan);
            $('#pmedia_dirid').val(data.media_dirid);
            let text = data.media_namafile;
            const arr = text.split(".");
            let lastidx = arr.length -1;
            let ext=arr[lastidx];
            if(ext=='jpg'||ext=='jpeg'||ext=='gif'||ext=='tiff'||ext=='gif'||ext=='png'){
                var img="<img src='"+base_url+"media/"+data.dir_nama+"/"+data.media_namafile+"' class='img img-responsive' />";
                $('#priview_images').html(img);
            }else{
                var img="<img src='"+base_url+"img/icon/"+ext+".png' style='height:95px' />";
                $('#priview_images').html(img);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
}
function openDir(id){
    $.ajax({
        url: base_url + "admin/media/files/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var tombol='<a href="#" class="btn" onclick="viewUpload()">'+
            '<span class="fa fa-plus"></span> Upload File'+
            '</a>';
            $('#tombol').html(tombol);
            $('#btnKembali').prop('disabled',false);
            var start=$('#start').val();
            // alert(id)
            $('#media_dirid').val(id);
            var res=data['data'];
            $('#filepath').val(data.dir.dir_nama);
            $('#galery').val(data.dir.dir_galery);
            $('#download').val(data.dir.dir_download);
            $('#ppid').val(data.dir.dir_ppid);
            var tabel="";
            if(data.status==true){
                if(res!=null){
                    
                    for (let i = 0; i < res.length; i++) {
                        let text = res[i].media_namafile;
                        const arr = text.split(".");
                        let lastidx = arr.length -1;
                        let ext=arr[lastidx];
                        // alert(ext);
                        if(ext=='jpg'||ext=='jpeg'||ext=='gif'||ext=='tiff'||ext=='gif'||ext=='png'){
                            tabel+="<div class='col-md-1 col-xs-3' style='text-align:center;font-weight:bold'><a href='#' onmousedown='cekAction(event,\""+res[i].media_keterangan+"\")' onclick='openFile(\""+res[i].media_id+"\")'>"+
                            "<img src='"+base_url+"media/"+data.dir.dir_nama+"/"+text+"' class='img img-responsive' style='height:95px'/></a>"+res[i].media_keterangan+"</div>";
                        }else{
                            tabel+="<div class='col-md-1 col-xs-3' style='text-align:center;font-weight:bold'><a href='#' onmousedown='cekAction(event,\""+res[i].media_keterangan+"\")' onclick='openFile(\""+res[i].media_id+"\")'>"+
                            "<img src='"+base_url+"img/icon/"+ext+".png"+"' class='img img-responsive' /></a>"+res[i].media_keterangan+"</div>";
                        }
                        
                        
                    }
                }
                
                $('#data').html(tabel);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
}
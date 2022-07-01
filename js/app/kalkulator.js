function bentukHarta() {
    var jeniszakat=$('#jeniszakat').val();
    $('#hasil').html("")
    $.ajax({
        url: base_url + "welcome/bentukharta/" + jeniszakat,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var jenis=data.jeniszakat;
            let option="<option value=''>Pilih Jenis Harta</option><option value='0'>Uang Tunai</option>";
            for (let index = 0; index < jenis.length; index++) {
                const row = jenis[index];
                option+="<option value='"+row.idx+"'>"+row.jenisharta+"</option>";
            }
            var penambah=data.penambah;
            var inputt="<legend>Penambah</legend>";
            for (let i = 0; i < penambah.length; i++) {
                const row = penambah[i];
                inputt+='<div class="form-group">'+
                    '<label class="control-label col-sm-3" for="pwd" id="labelpenambah'+i+'">'+row.namavariabel+' (<span class="satuan">Rupiah</span>):</label>'+
                    '<div class="col-sm-9">'+
                    '<input type="number" id="penambah'+i+'" class="form-control" value="">'+
                    '</div>'+
                '</div>';
            }

            var pengurang=data.pengurang;
            var inputk="<legend>Pengurang</legend>";
            for (let i = 0; i < pengurang.length; i++) {
                const row = pengurang[i];
                inputk+='<div class="form-group">'+
                    '<label class="control-label col-sm-3" for="pwd" id="labelpengurang'+i+'">'+row.namavariabel+' (<span class="satuan">Rupiah</span>):</label>'+
                    '<div class="col-sm-9">'+
                    '<input type="number" id="pengurang'+i+'" class="form-control" value="">'+
                    '</div>'+
                '</div>';
            }

            if(penambah.length>0) $('#penambah').html(inputt);
            if(pengurang.length>0)$('#pengurang').html(inputk); else $('#pengurang').html("");
            $('#jmlpenambah').val(penambah.length);
            $('#jmlpengurang').val(pengurang.length);
            $('#nisab').val(jenis[0].nishab);
            $('#persentase').val(jenis[0].persentase);
            if(jenis[0].perkiraanharga>0) $('#perkiraan').prop('readonly',true);
            else $('#perkiraan').prop('readonly',false);
            $('#perkiraan').val(jenis[0].perkiraanharga);
            $('#labelperkiraan').html("Perkiraan Harga "+jenis[0].jenisharta +"/"+jenis[0].satuan)
            $('#jenisharta').html(option);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
}
function SetBentukHarta(){
    var jenisharta=$('#jenisharta').val();
    $.ajax({
        url: base_url + "welcome/getbentukharta/" + jenisharta,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if(data==null){
                $('#satuan').html("Rupiah")
            }else{
                if(jenisharta==0) $('.satuan').html("Rupiah");
                else $('.satuan').html(data.satuan);
                $('#nisab').val(data.nishab);
                $('#persentase').val(data.persentase);
                $('#perkiraan').val(data.perkiraanharga);
                $('#labelperkiraan').html("Perkiraan Harga "+data.jenisharta +"/"+data.satuan)
            }
            
            // $('#jenisharta').html(option);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
}
function hitung(){
    var jenisharta=$('#jenisharta').val();
    var nisab=$('#nisab').val();
    var persentase=$('#persentase').val();
    var perkiraan=$('#perkiraan').val();
    var jmlpenambah=$('#jmlpenambah').val();
    var jmlpengurang=$('#jmlpengurang').val();
    var penambah=0;
    var pengurang=0;
    var pena=0;
    var peng=0;
    var labeltambah="";
    var labelkurang="";
    var satuan =$('.satuan').html();
    var tabelhasil="<table class='table '><tr class='bg-green'><td >Variabel</td><td colspan='2'>Nominal</td></tr>"+
    "<tr class='bg-green'><td colspan='3'>Pemasukan</td></tr>";
    if(parseInt(jmlpenambah)>0){
        for (let index = 0; index < jmlpenambah; index++) {
            pena=$('#penambah'+index).val();
            penambah+=parseInt(pena);
            labeltambah=$('#labelpenambah'+index).html();
            tabelhasil+="<tr><td>"+labeltambah+"</td><td class='text-right'>"+pena+" "+satuan+"</td><td></td></tr>"
        }
        tabelhasil+="<tr><td colspan='2'>Total Pemasukan</td><td class='text-right'>"+penambah+" "+satuan+"</td></tr>"
    }
    
    if(parseInt(jmlpengurang)>0){
        tabelhasil+="<tr class='bg-green'><td colspan='3'>Pengeluaran</td></tr>";
        for (let index = 0; index < jmlpengurang; index++) {
            peng=$('#pengurang'+index).val();
            pengurang+=parseInt(peng);
            labelkurang=$('#labelpengurang'+index).html();
            tabelhasil+="<tr><td>"+labelkurang+"</td><td class='text-right'>"+peng+" "+satuan+"</td><td></td></tr>"
            // alert(pengurang)
        }
        tabelhasil+="<tr><td colspan='2'>Total Biaya</td><td class='text-right' >"+pengurang+" "+satuan+"</td></tr>"
    }
    var nominal=penambah-pengurang;
    tabelhasil+="<tr><td colspan='2'>Total Harta (Total Pemasukan - Total Biaya)</td><td class='text-right'>"+nominal+" "+satuan+"</td></tr>"
    
    
    // alert("Penambah : "+penambah+" Pengurang : "+pengurang+" = "+nominal)
    var satuan=$('.satuan').html();
    var nisabrp=nisab*perkiraan;
    if(jenisharta==0){
        // Jika jenis harta uang tunai,
        
        // alert(nisab +" X "+perkiraan+" = " +nisabrp )
        if(nisabrp>nominal) {
            // alert("Belum Sampai Nisab, Nisab Zakat sekitar "+nisabrp+" dengan perkiraan harga emas "+perkiraan);
            swal({
                title: "Info",
                text: "Belum Sampai Nisab, Nisab Zakat sekitar Rp. "+nisabrp+" dengan perkiraan harga emas Rp. "+perkiraan,
                type: "warning",
                timer: 50000
            });
            tabelhasil+="<tr><td colspan='3'>Belum Sampai Nisab, Nisab Zakat sekitar Rp. "+nisabrp+" dengan perkiraan harga emas Rp. "+perkiraan+"</td></tr>"
        }else {
            var zakat = persentase*nominal/100;
            swal({
                title: "Hasil",
                text: "zakat yang harus dibayarkan adalah : Rp."+zakat,
                type: "success",
                timer: 50000
            });
            tabelhasil+="<tr><td colspan='2'>Total Zakat "+persentase+" x Total Harta</td><td class='text-right'>Rp. "+zakat+" "+satuan+"</td></tr>"
            // alert("zakat yang harus dibayarkan adalah : "+zakat);
        }
    }else{
        nisab=parseInt(nisab);
        var namajenisharta=$('#jenisharta :selected').html();
        if(nisab>nominal){
            
            swal({
                title: "Info",
                text: "Belum Sampai Nisab, Nisab Zakat sekitar "+nisab+" "+satuan+" "+namajenisharta+" Atau Setara dengan Rp. "+nisabrp+" dengan perkiraan harga "+namajenisharta+" Rp."+perkiraan +"/"+satuan,
                type: "warning",
                timer: 50000
            });
            tabelhasil+="<tr><td colspan='3'>Belum Sampai Nisab, Nisab Zakat sekitar "+nisab+" "+satuan+" "+namajenisharta+" Atau Setara dengan Rp. "+nisabrp+" dengan perkiraan harga "+namajenisharta+" Rp."+perkiraan +"/"+satuan+"</td></tr>"
        }else{
            var zakat = persentase*nominal/100;
            var zakatrp=persentase*(nominal*perkiraan)/100;
            swal({
                title: "Hasil",
                text: "zakat yang harus dibayarkan adalah "+zakat +" "+satuan +" "+namajenisharta+" atau Rp." +zakatrp+" jika menggunakan uang tunai dengan perkiraan harga "+namajenisharta+" adalah Rp."+perkiraan,
                type: "success",
                timer: 50000
            });
            tabelhasil+="<tr><td colspan='2'>Total Zakat "+persentase+"% x Total Harta</td><td class='text-right'>"+zakat+" "+satuan+"</td></tr>"
        }
    }
    tabelhasil+="</table>";
    $('#hasil').html(tabelhasil)
} 
function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1) ) + min;
}
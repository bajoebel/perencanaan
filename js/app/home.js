$(document).ready(function() {
    $('.keyboard').keyboard();
    $('.num_keybord').keyboard({
		layout: 'custom',
        customLayout: {
            'default' : [
                '0 1 2 3 4 5',
                '6 7 8 9 {a} {c}',
                '{bksp}',
            ]
        }
	})
    // $('#no_bpjs').keyboard({
	// 	layout: 'custom',
    //     customLayout: {
    //         'default' : [
    //             '0 1 2 3 4 5',
    //             '6 7 8 9 {a} {c}',
    //             '{bksp}',
    //         ]
    //     }
	// })
    $("div.ftl-vertical-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        // alert(index);
        $("div.ftl-vertical-tab>div.ftl-vertical-tab-content").removeClass("active");
        $("div.ftl-vertical-tab>div.ftl-vertical-tab-content").eq(index).addClass("active");
    });
});

function daftarMandiri(){
    $('.list-group-item').removeClass('active')
    $('.ftl-vertical-tab-content').removeClass('active');
    $('#mandiri').addClass('active')
    $('#contentmandiri').addClass('active')
    $('.step').hide();
    $('#step1').show();
    $('#keyword-nomr').val("");
    resetForm();
    // alert('daftar')
}
function resetForm(){
    $('#id_pasien').val("")
    $('#nomr').val("")
    $('#nama_pasien').val("")
    $('#no_ktp').val("")
    $('#no_bpjs').val("")
    $('#tempat_lahir').val("")
    $('#tgl_lahir').val("")
    $('#jns_kelamin').val("")
    $('#status_kawin').val("")
    $('#pekerjaan').val("")
    $('#agama').val("")
    $('#no_telpon').val("")
    $('#kewarganegaraan').val("")
    $('#nama_negara').val("")
    $('#nama_provinsi').val("")
    $('#nama_kab_kota').val("")
    $('#nama_kecamatan').val("")
    $('#nama_kelurahan').val("")
    $('#bahasa').val("")
    $('#suku').val("")
    $('#alamat').val("")
    $('#penanggung_jawab').val("")
    $('#pjPasienNama').val("")
    $('#pjPasienTelp').val("")
    $('#pjPasienHubKel').val("")
    $('#pjPasienPekerjaan').val("")
    $('#pjPasienAlamat').val("");
    $('#jkn').val("");
    $('#id_ruang').val("");
    $('#nama_ruang').val("");
    $('#id_dokter').val("");
    $('#namaDokterJaga').val("");
    $('#label_antrian').val("");
    $('#no_rujuk').val("");
    $('#id_rujuk').val("");
    $('#rujukan').val("");
    $('#carabayar').html("");
    $('#control-form').hide();
    $('#control-keyword').show();
}
function resetFormOnline(){
    $('#o-id_pasien').val("")
    $('#o-nomr').val("")
    $('#o-nama_pasien').val("")
    $('#o-no_ktp').val("")
    $('#o-no_bpjs').val("")
    $('#o-tempat_lahir').val("")
    $('#o-tgl_lahir').val("")
    $('#o-jns_kelamin').val("")
    $('#o-status_kawin').val("")
    $('#o-pekerjaan').val("")
    $('#o-agama').val("")
    $('#o-no_telpon').val("")
    $('#o-kewarganegaraan').val("")
    $('#o-nama_negara').val("")
    $('#o-nama_provinsi').val("")
    $('#o-nama_kab_kota').val("")
    $('#o-nama_kecamatan').val("")
    $('#o-nama_kelurahan').val("")
    $('#o-bahasa').val("")
    $('#o-suku').val("")
    $('#o-alamat').val("")
    $('#o-penanggung_jawab').val("")
    $('#o-pjPasienNama').val("")
    $('#o-pjPasienTelp').val("")
    $('#o-pjPasienHubKel').val("")
    $('#o-pjPasienPekerjaan').val("")
    $('#o-pjPasienAlamat').val("");
    $('#o-jkn').val("");
    $('#o-id_ruang').val("");
    $('#o-nama_ruang').val("");
    $('#o-id_dokter').val("");
    $('#o-namaDokterJaga').val("");
    $('#o-label_antrian').val("");
    $('#o-no_rujuk').val("");
    $('#o-id_rujuk').val("");
    $('#o-rujukan').val("");
    $('#o-carabayar').html("");
    $('#o-control-form').hide();
    $('#o-control-keyword').show();
}
function daftarOnline(){
    $('.list-group-item').removeClass('active')
    $('.ftl-vertical-tab-content').removeClass('active');
    $('#online').addClass('active')
    $('#contentonline').addClass('active')
    $('.o-step').hide();
    $('#o-step1').show();
    $('#o-keyword-nomr').val("");
    $('#o-keyword-thnlahir').val("")
    resetFormOnline();
}

function jadwalDokter(){
    $('.list-group-item').removeClass('active')
    $('.ftl-vertical-tab-content').removeClass('active');
    $('#jadwal').addClass('active')
    $('#contentjadwal').addClass('active')
}   
function bedMonitoring(){
    $('.list-group-item').removeClass('active')
    $('.ftl-vertical-tab-content').removeClass('active');
    $('#bed').addClass('active')
    $('#contentbed').addClass('active')
}
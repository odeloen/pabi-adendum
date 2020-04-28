function detail_pengajuan(token, id){
    var loading = `<div class="text-center"> 
        <div class="pace-demo">
        <div class="theme_squares"><div class="pace-progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
        </div> 
        </div>`;
    // alert(id_member);
    $('#ModalBiru').modal('show');
    $('#ModalBiruLabel').html('Detail Pengajuan');
    $('#ModalBiruIsi').html(loading);
    var act = '/member/detail_pengajuan';
    $.post(act, {
        _token: token
        , id:id
    },
    function (data) {
        $('#ModalBiruIsi').html(data); 
    });
}

function ladda_start(idBtn){ 
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
}

function div_grafik_borang_bulan(token, target_grafik_stok, target_grafik_uang, link){

    $(target_grafik_stok).html(loading);
    var act = '/div_grafik_borang_bulan';
    $.post(act, {
        _token: token 
    },
    function (data1) {
        //alert(data1);
        $(target_grafik_stok).html(data1);
    });

    $(target_grafik_uang).html(loading);
    var act = '/div_grafik_borang_bulan_bar';
    $.post(act, {
        _token: token 
    },
    function (data2) {
        //alert(data2);
        $(target_grafik_uang).html(data2);
    });
}

function div_grafik_barang_masuk(token, target_grafik_stok, target_grafik_uang, link){

    $(target_grafik_stok).html(loading);
    var act = '/div_grafik_barang_masuk';
    $.post(act, {
        _token: token 
    },
    function (data1) {
        //alert(data1);
        $(target_grafik_stok).html(data1);
    });

    $(target_grafik_uang).html(loading);
    var act = '/div_grafik_uang_keluar';
    $.post(act, {
        _token: token 
    },
    function (data2) {
        //alert(data2);
        $(target_grafik_uang).html(data2);
    });
}

function tambah_modal_borang(token, tgl, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Borang');
    $(modal + 'Isi').html(loading);
    var act = '/member/master_borang_modal_tambah';
    $.post(act, {
        _token: token
        , tgl: tgl
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
} 


function div_master_borang(token, tgl, target) {
    $(target).html(loading);
    var act = '/member/div_master_borang';
    $.post(act, {
        _token: token
        , tgl: tgl
    },
    function (data) {
        $(target).html(data);
    });
}


function div_data_bank_keanggotaan(token, div1, id) { 
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_data_bank_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}


function delete_master_rumah_sakit(token, id) { 
    swal({
        title: "Yakin Untuk Menghapus Data Master Rumah Sakit Ini?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF5722",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Tidak!",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
    },
    function (isConfirm) {
        if (isConfirm) {
            var act = '/admin/master_rumah_sakit_hapus/' + id;
            $.post(act, {
                _token: token
            },
            function (data) {
                swal({
                    title: "Data Terhapus!",
                    text: "",
                    confirmButtonColor: "#4CAF50",
                    type: "success"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        location.reload();
                    }
                });
            });
        }
    });
}
 
function tambah_modal_rumah_sakit(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Rumah Sakit');
    $(modal + 'Isi').html(loading);
    var act = '/admin/tambah_modal_rumah_sakit';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
} 

function edit_modal_rumah_sakit(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Edit Data Rumah Sakit');
    $(modal + 'Isi').html(loading);
    var act = '/admin/edit_modal_rumah_sakit/'+id;
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}


function simpan_div_data_bank_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_bank';
    var id_form = $('#formKeanggotaanBank');
    $.post(act, {
        _token: token,
        nama_bank: id_form.find('input[name="nama_bank"]').val(),
        nama_pemilik_rekening: id_form.find('input[name="nama_pemilik_rekening"]').val(),
        nomor_rekening: id_form.find('input[name="nomor_rekening"]').val() 
    },
    function (data) {
        swal({
            title: data,
            text: "",
            confirmButtonColor: "#4CAF50",
            type: "success"
        },
        function (isConfirm) {
            if (isConfirm) {
                l.stop();
                alertKu('success', data); 
            }
        });
    });
}

function js_number_format(value, target){
    $(target).html('loading...');
    var res = addCommas(value);
    $(target).html(res);

}

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

function chk_status_harga(token, id_event, id_harga, value, div_chk){

    var val = 1;
    if(value == false){
        val = 2;
    }

    $(div_chk).prop('readonly',true);
    $(div_chk).prop('disabled',true);
    $(div_chk+'_loading').html('loading...');

    var act = '/admin/master_event/' + id_harga + '/edit_harga_event';
    $.post(act, {
        _token: token,
        id_event: id_event,
        val: val 
    },
    function (data) {
        $(div_chk).prop('readonly',false);
        $(div_chk).prop('disabled',false);
        // alertKu('warning', data);
        $(div_chk+'_loading').html('');
        swal({
            title: "Status Harga Berhasil Disimpan",
            text: "",
            confirmButtonColor: "#4CAF50",
            type: "success"
        },
        function (isConfirm) {
            if (isConfirm) { 
                // div_tabel_data_harga_event(token, '#div_tabel_data_harga_event', id_event);
            }
        });
    });

}

function modal_pengajuan_pindah_cabang(token, id_member, modal){
    // alert(id_member);
    $(modal).modal('show');
    $(modal + 'Label').html('Ajukan Perpindahan Cabang');
    $(modal + 'Isi').html(loading);
    var act = '/member/modal_pengajuan_pindah_cabang';
    $.post(act, {
        _token: token
        , id_member: id_member
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}


function div_grafik_borang_pie_cabang(token, target){ 
    $(target).html(loading);
    var act = '/div_grafik_borang_pie_cabang';
    $.post(act, {
        _token: token 
    },
    function (data1) {
        //alert(data1);
        $(target).html(data1);
    });  
}

function div_grafik_ranah_bar_cabang(token, target){ 
    $(target).html(loading);
    var act = '/div_grafik_ranah_bar_cabang';
    $.post(act, {
        _token: token 
    },
    function (data1) {
        //alert(data1);
        $(target).html(data1);
    });  
}
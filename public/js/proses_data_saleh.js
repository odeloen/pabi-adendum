function tambah_modal_admin_pusat(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Admin Pusat');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_admin_pusat/tambah';
    $.post(act, {
        _token: token
    },
    function (data) {
            //alert(data);
            $(modal + 'Isi').html(data);
        });
} 
function update_modal_admin_pusat(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Update Data Admin Pusat');
    $(modal + 'Isi').html(loading);
    var act = '/modal_edit_admin_pusat/' + id + '/modal_edit';
    $.post(act, {
        _token: token
    },
    function (data) {
            // alert(data);
            $(modal + 'Isi').html(data);
        });
}

function isi_buku_tamu(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Isi Data Buku Tamu');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_event/isi_buku_tamu';
    $.post(act, {
        _token: token
        , id: id
    },
    function (data) {
            // alert(data);
            $(modal + 'Isi').html(data);
        });
}

function update_status_hadir(token,id){ 
    var act = '/update_status_hadir'+id+'/buku_tamu';
    $.post(act,{
        _token : token,
        id:id
    },
    function (data){
        alert('bisa');
    });
}

function daftar_event(token,id_event,id_member) 
{   
    swal({
        title: "Anda yakin ingin mendaftar event ?",
        text: "",
        type: "warning",    
        showCancelButton: true,
        confirmButtonColor: "#4CAF50",
        confirmButtonText: "Ya, Daftar!",
        cancelButtonText: "Tidak!",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
    },
    function(isConfirm){
        if (isConfirm) { 
            $.post('/member/buku_tamu', {    
                _token: token, 
                id_event:id_event,
                id_member: id_member
            }, 
            function (data) {  
                if(data == 'success'){ 
                    swal({
                        html: true,
                        title: "Berhasil",
                        text: "Data berhasil disimpan",
                        type: "success",     
                        confirmButtonColor: "#4CAF50"
                    },
                    function(isConfirm){ 
                        if(isConfirm){  
                            div_tabel_event_pusat_member(token, '#div_tabel_event_pusat_member');
                            //$('.modal').modal('hide'); 
                        }
                    });
                } else if(data == 'failed'){
                    alertKu('warning', 'anda sudah terdaftar');
                } else {
                    alertKu('warning', data);
                }
            });
        }
    });
}

function div_pekerjaan_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_pekerjaan_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_div_data_pekerjaan_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_pekerjaan';
    var id_form = $('#formKeanggotaanDataPekerjaan');
    $.post(act, {
        _token: token,
        nama_pekerjaan: id_form.find('input[name="nama_pekerjaan"]').val(), 
        tempat_pekerjaan: id_form.find('input[name="tempat_pekerjaan"]').val()
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
                div_tabel_data_pekerjaan_keanggotaan(token, '#div_tabel_data_pekerjaan_keanggotaan', id);
            }
        });
    });
}

function div_tabel_data_pekerjaan_keanggotaan(token, div1, id, view) {
    view = view || "";
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_tabel_data_pekerjaan_keanggotaan';
    $.post(act, {
        _token: token
        , view
    },
    function (data) {
        $(div1).html(data);
    });
}

function delete_myprofile_pekerjaan(token, id, member_id) {

    swal({
        title: "Yakin Untuk Menghapus Data Pekerjaan?",
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
            var act = '/member/myprofilemember/tabel_detail_pekerjaan/' + id + '/hapus';
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
                        div_tabel_data_pekerjaan_keanggotaan(token, '#div_tabel_data_pekerjaan_keanggotaan', member_id);
                    }
                });
            });
        }
    });
}

function div_praktek_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_praktek_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_div_data_praktek_keanggotaan(token, id, idBtn) {
    no_sip = $('#no_sip_praktek').val();
    nama_tempat = $('#tempat_praktek').val();
    tanggal_sip = $('#tanggal_sip').val();
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_praktek';
    var id_form = $('#formKeanggotaanDataPekerjaan');
    $.post(act, {
        _token: token,
        no_sip: no_sip, 
        nama_tempat: nama_tempat,
        tanggal_sip : tanggal_sip
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
                div_tabel_data_praktek_keanggotaan(token, '#div_tabel_data_praktek_keanggotaan', id);
            }
        });
    });
}
function div_tabel_data_praktek_keanggotaan(token, div1, id, view) {
    view = view || "";
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_tabel_data_praktek_keanggotaan';
    $.post(act, {
        _token: token
        , view: view
    },
    function (data) {
        $(div1).html(data);
    });
}
 
function delete_myprofile_member_praktek(token, id, member_id) {

    swal({
        title: "Yakin Untuk Menghapus Data Praktek?",
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
            var act = '/member/myprofilemember/tabel_detail_praktek/' + id + '/hapus';
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
                        div_tabel_data_praktek_keanggotaan(token, '#div_tabel_data_praktek_keanggotaan', member_id);
                    }
                });
            });
        }
    });
}

function inactive_master_member(token, id, modal, url_back) {
    $(modal).modal('show');
    $(modal + 'Label').html('Active Member');
    $(modal + 'Isi').html(loading);
    var act = '/modal_active_member/'+id;
    $.post(act, {
        _token: token,
        url_back: url_back
    },
    function (data) {
            // alert(data);
            $(modal + 'Isi').html(data);
        });
}

function tambah_modal_minat_bidang(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Minat Bidang');
    $(modal + 'Isi').html(loading);
    var act = '/admin/tambah_modal_minat_bidang';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
} 

function edit_modal_minat_bidang(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Edit Data Minat Bidang');
    $(modal + 'Isi').html(loading);
    var act = '/admin/edit_modal_minat_bidang/'+id;
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}


function delete_master_minat_bidang(token, id) { 
    swal({
        title: "Yakin Untuk Menghapus Data Master Minat Bidang Ini?",
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
            var act = '/admin/master_minat_bidang_hapus/' + id;
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


function tambah_modal_banner(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Banner');
    $(modal + 'Isi').html(loading);
    var act = '/admin/tambah_modal_banner';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}  
function edit_modal_banner(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Edit Data Banner');
    $(modal + 'Isi').html(loading);
    var act = '/admin/edit_modal_banner/'+id;
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function delete_master_banner(token, id) { 
    swal({
        title: "Yakin Untuk Menghapus Data Banner Ini?",
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
            var act = '/admin/master_banner_hapus/' + id;
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
function tambah_modal_berita(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Berita');
    $(modal + 'Isi').html(loading);
    var act = '/admin/tambah_modal_berita';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}   
function edit_modal_berita(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Edit Data Berita');
    $(modal + 'Isi').html(loading);
    var act = '/admin/edit_modal_berita/'+id;
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function delete_master_berita(token, id) { 
    swal({
        title: "Yakin Untuk Menghapus Data Berita Ini?",
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
            var act = '/admin/master_berita_hapus/' + id;
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

function tambah_modal_tentang_pabi(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data');
    $(modal + 'Isi').html(loading);
    var act = '/admin/tambah_modal_tentang_pabi';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}  
function edit_modal_tentang_pabi(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Edit Data');
    $(modal + 'Isi').html(loading);
    var act = '/admin/edit_modal_tentang_pabi/'+id;
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function delete_master_tentang_pabi(token, id) { 
    swal({
        title: "Yakin Untuk Menghapus Data Ini?",
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
            var act = '/admin/master_tentang_pabi_hapus/' + id;
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

function div_tabel_pembayaran_pusat(token, div1) {
    $(div1).html(loading);
    var event_id = $('#event_id_pembayaran').val();
    var limit = $('#limit_pembayaran').val();
    var act = '/admin/master_event/div_tabel_pembayaran_pusat';
    var id_form = $('#formFilterDataMasterEventPusat');
    $.post(act, {
        _token: token,
        event_id:event_id,
        limit:limit
    },
    function (data) {
        $(div1).html(data);
    });
}

function event_by_admin_pusat(token, id) { 
    var act = '/admin/master_event/pembayaran_pusat_page';
    $.post(act, {
        _token: token,
        id: id
    },
    function (data) {
        $('#event_id_pembayaran').html(data);
        $('.select22').select2();
    });
}
 
function set_status_bayar(token, id,status_bayar_param) {  
    var status_bayar = 2;
    if($(status_bayar_param).is(':checked')){
        status_bayar = 1;
    }
    // alert(status_bayar_param);
    // alert(status_bayar);
    swal({
        title: "Yakin Untuk Mengubah Status Ini?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF5722",
        confirmButtonText: "Ya, Ubah!",
        cancelButtonText: "Tidak!",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
    },
    function (isConfirm) {
        if (isConfirm) {
            var act = '/admin/master_event/set_status_bayar/' + id;
            $.post(act, {
                _token: token,
                status_bayar:status_bayar
            },
            function (data) {
                swal({
                    title: "Status Berubah!",
                    text: '',
                    confirmButtonColor: "#4CAF50",
                    type: "success"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        // $('.btn_tampilkan').click(); 
                    }
                });
            });
        } else { 
            $(status_bayar_param).click(); 
        }
    });
}
 
function div_tabel_pembayaran_cabang(token, div1) {
    $(div1).html(loading);
    var event_id = $('#event_id_pembayaran').val();
    var limit = $('#limit_pembayaran').val();
    var act = '/admin/master_event/div_tabel_pembayaran_cabang';
    var id_form = $('#formFilterDataMasterEventPusat');
    $.post(act, {
        _token: token,
        event_id:event_id,
        limit:limit
    },
    function (data) {
        $(div1).html(data);
    });
}

function event_by_admin_cabang(token, id) { 
    var act = '/admin/master_event/pembayaran_cabang_page';
    $.post(act, {
        _token: token,
        id: id
    },
    function (data) {
        $('#event_id_pembayaran').html(data);
        $('.select22').select2();
    });
}

function div_grafik_jumlah_kredit_poin(token, target){ 
    $(target).html(loading);
    var act = '/div_grafik_jumlah_kredit_poin';
    $.post(act, {
        _token: token 
    },
    function (data1) {
        //alert(data1);
        $(target).html(data1);
    });  
} 

function div_grafik_borang(token, target){ 
    $(target).html(loading);
    var act = '/div_grafik_borang';
    $.post(act, {
        _token: token 
    },
    function (data1) {
        //alert(data1);
        $(target).html(data1);
    });  
}

function div_grafik_ranah(token, target){ 
    $(target).html(loading);
    var act = '/div_grafik_ranah';
    $.post(act, {
        _token: token 
    },
    function (data1) {
        //alert(data1);
        $(target).html(data1);
    });  
}
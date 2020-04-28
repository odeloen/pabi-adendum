var loading = `<div class="text-center"> 
<div class="pace-demo">
<div class="theme_squares"><div class="pace-progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
</div> 
</div>`;

function gagal() {
    alertKu('warning', 'Gagal Dev'); 
}


// START contoh ------------------------------------------------------
function edit_modal_my_profile_member(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Edit My Profile');
    $(modal + 'Isi').html(loading);
    var act = '/member/myprofilemember/edit';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function set_kota_by_prov(token, id_select_data, id_select_isi) {
    var act = '/member/set_kota_by_prov';
    var dt_select = $(id_select_data).val();
    $(id_select_isi).html('<option value="">loading...</option>');
    $.post(act, {
        _token: token,
        id_prov: dt_select
    },
    function (data) {
        $(id_select_isi).html(data);
        $('.select22').select2();
    });
}

function tambah_modal_admin_cabang(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Admin Cabang');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_admin_cabang/tambah';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
} 

function update_modal_admin_cabang(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Update Data Admin Cabang');
    $(modal + 'Isi').html(loading);
    var act = '/modal_edit_admin_cabang/' + id + '/modal_edit';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function delete_myprofile_member_pasangan(token, id, member_id) {

    swal({
        title: "Yakin Untuk Menghapus Data Pasangan?",
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
            var act = '/member/myprofilemember/tabel_detail_pasangan/' + id + '/hapus';
            $.post(act, {
                _token: token
            },
            function (data) {
                if (data == 'success') {
                    swal({
                        title: "Data Pasangan Member Behasil Dihapus!",
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "success"
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            div_tabel_data_pasangan_keanggotaan(token, '#div_tabel_data_pasangan_keanggotaan', member_id);
                        }
                    });
                } else {
                    gagal();
                }
            });
        }
    });
}

// END contoh ------------------------------------------------------


function tabel_detail_pasangan(token, id, target) { 
    $(target).html(loading);
    var act = '/member/myprofilemember/tabel_detail_pasangan';
    $.post(act, {
        _token: token, 
        id: id
    },
    function (data) {
        $(target).html(data);
    });
}

function delete_myprofile_member_anak(token, id, member_id) {

    swal({
        title: "Yakin Untuk Menghapus Data Anak?",
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
            var act = '/member/myprofilemember/tabel_detail_anak/' + id + '/hapus';
            $.post(act, {
                _token: token
            },
            function (data) {
                if (data == 'success') {
                    swal({
                        title: "Data Anak Member Behasil Dihapus!",
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "success"
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            div_tabel_data_anak_keanggotaan(token, '#div_tabel_data_anak_keanggotaan', member_id);
                        }
                    });
                } else {
                    gagal();
                }
            });
        }
    });
}

function delete_myprofile_member_pendidikan(token, id, member_id) {

    swal({
        title: "Yakin Untuk Menghapus Data Pendidikan?",
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
            var act = '/member/myprofilemember/tabel_detail_pendidikan/' + id + '/hapus';
            $.post(act, {
                _token: token
            },
            function (data) {
                if (data == 'success') {
                    swal({
                        title: "Data Pendidikan Member Behasil Dihapus!",
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "success"
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            div_tabel_data_pendidikan_keanggotaan(token, '#div_tabel_data_pendidikan_keanggotaan', member_id);
                        }
                    });
                } else {
                    gagal();
                }
            });
        }
    });
}

function delete_myprofile_member_minat_bidang(token, id, member_id) {

    swal({
        title: "Yakin Untuk Menghapus Data Minat Bidang?",
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
            var act = '/member/myprofilemember/tabel_detail_minat_bidang/' + id + '/hapus';
            $.post(act, {
                _token: token
            },
            function (data) {
                if (data == 'success') {
                    swal({
                        title: "Data Minat Bidang Member Behasil Dihapus!",
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "success"
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            div_tabel_minat_bidang_keanggotaan(token, '#div_tabel_minat_bidang_keanggotaan', member_id);
                        }
                    });
                } else {
                    gagal();
                }
            });
        }
    });
}

function delete_myprofile_member_ujian(token, id, member_id) {

    swal({
        title: "Yakin Untuk Menghapus Data Ujian?",
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
            var act = '/member/myprofilemember/tabel_detail_ujian/' + id + '/hapus';
            $.post(act, {
                _token: token
            },
            function (data) { 
                swal({
                    title: "Data Ujian Member Behasil Dihapus!",
                    text: "",
                    confirmButtonColor: "#4CAF50",
                    type: "success"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        div_tabel_data_ujian_keanggotaan(token, '#div_tabel_data_ujian_keanggotaan', member_id);
                    }
                }); 
            });
        }
    });
}

function delete_master_admin_pusat(token, id) {

    swal({
        title: "Yakin Untuk Menghapus Data Admin Pusat?",
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
            var act = '/admin/master_admin_pusat/' + id + '/hapus';
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

function delete_master_admin_cabang(token, id) {

    swal({
        title: "Yakin Untuk Menghapus Data Master Admin Cabang?",
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
            var act = '/admin/master_admin_cabang/' + id + '/hapus';
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

function tambah_modal_event(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Event');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_event/tambah_pusat';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
} 

function update_modal_event(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Update Data Event');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_event/' + id + '/ubah_pusat';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function delete_master_event(token, id) {

    swal({
        title: "Yakin Untuk Menghapus Data Master Event?",
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
            var act = '/admin/master_event/' + id + '/hapus';
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
                        $('.btn_tampilkan').click();
                    }
                });
            });
        }
    });
}

function tambah_modal_master_member(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Member');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_member/tambah';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
} 

function update_modal_master_member(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Update Data Member');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_member/' + id + '/ubah';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function delete_master_member(token, id) {

    swal({
        title: "Yakin Untuk Menghapus Data Master Member?",
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
            var act = '/admin/master_member/' + id + '/hapus';
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

function tambah_modal_event_cabang(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Master Data Event');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_event/tambah_cabang';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
} 

function update_modal_event_cabang(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Update Data Event');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_event/' + id + '/ubah_cabang';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function histori_master_member(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Update Data Event');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_member/' + id + '/histori_pengajuan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}
function histori_master_member_target(token, id, target) { 
    $(target).html(loading);
    var act = '/admin/master_member/' + id + '/histori_pengajuan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(target).html(data);
    });
}

function edit_modal_keanggotaan(token, modal, id) {
    $(modal).modal('show');
    $(modal + 'Label').html('Edit Data Pengajuan Keanggotaan Member');
    $(modal + 'Isi').html(loading);
    var act = '/member/keanggotaan/' + id + '/edit';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function div_identitas_diri_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_identitas_diri_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_data_idi_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_data_idi_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_foto_profile_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_foto_profile_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_div_data_idi_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 

    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_idi';
    $.post(act, {
        _token: token,
        admin_cab_id: $('#keanggotaan_admin_cab_id').val(),
        admin_pst_id: $('#keanggotaan_admin_pst_id').val(),
        tempat_kerja: $('#keanggotaan_tempat_kerja').val(),
        alamat_kantor: $('#keanggotaan_alamat_kantor').val(),
        no_telp_kantor: $('#keanggotaan_no_telp_kantor').val(),
        jabatan: $('#keanggotaan_jabatan').val(),
        card_no: $('#keanggotaan_card_no').val(),
        valid_until_card_no: $('#keanggotaan_valid_until_card_no').val(),
        no_pabi_sejahtera: $('#keanggotaan_no_pabi_sejahtera').val(),
        tgl_pabi_sejahtera: $('#keanggotaan_tgl_pabi_sejahtera').val(),
        no_str: $('#keanggotaan_no_str').val(), 
        sjk_tahun_no_str: $('#keanggotaan_sjk_tahun_no_str').val(), 

        no_skk_bedah: $('#keanggotaan_no_skk_bedah').val(), 
        tgl_skk_bedah: $('#keanggotaan_tgl_skk_bedah').val(), 
        no_sip_terakhir: $('#keanggotaan_no_sip_terakhir').val(), 
        tgl_sip_mulai: $('#keanggotaan_tgl_sip_mulai').val(), 
        tgl_sip_selesai: $('#keanggotaan_tgl_sip_selesai').val(), 

        keterangan: $('#keanggotaan_keterangan').val()
    },
    function (data) {
        l.stop();
        alertKu('success', data);
    });
}

function simpan_div_identitas_diri_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_identitas_diri';
    $.post(act, {
        _token: token,
        firstname: $('#keanggotaan_firstname').val(),
        lastname: $('#keanggotaan_lastname').val(),
        nickname: $('#keanggotaan_nickname').val(),
        gelar: $('#keanggotaan_gelar').val(),
        email: $('#keanggotaan_email').val(),
        tempat_lahir: $('#keanggotaan_tempat_lahir').val(),
        tgl_lahir: $('#keanggotaan_tgl_lahir').val(),
        gender: $('#formKeanggotaanIdentitasDiri').find('input[name="gender"]:checked').val(),
        alamat_rumah: $('#keanggotaan_alamat_rumah').val(),
        kota: $('#keanggotaan_kota').val(),
        no_telp: $('#keanggotaan_no_telp').val(), 
        no_hp: $('#keanggotaan_no_hp').val(), 
        hobi: $('#keanggotaan_hobi').val()
    },
    function (data) {
        l.stop();
        alertKu('success', data);
    });
}

function div_data_pasangan_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_data_pasangan_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_data_pasangan_keanggotaan(token, div1, id, view) {
    view = view || "";
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_tabel_data_pasangan_keanggotaan';
    $.post(act, {
        _token: token
        , view: view
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_data_anak_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_data_anak_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_data_anak_keanggotaan(token, div1, id, view) {
    view = view || "";
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_tabel_data_anak_keanggotaan';
    $.post(act, {
        _token: token
        , view: view
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_data_pendidikan_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_data_pendidikan_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_data_pendidikan_keanggotaan(token, div1, id, view) {
    view = view || "";
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_tabel_data_pendidikan_keanggotaan';
    $.post(act, {
        _token: token
        , view: view
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_minat_bidang_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_minat_bidang_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_minat_bidang_keanggotaan(token, div1, id, view) {
    view = view || "";
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_tabel_minat_bidang_keanggotaan';
    $.post(act, {
        _token: token
        , view: view
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_data_ujian_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_data_ujian_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_data_ujian_keanggotaan(token, div1, id, view) {
    view = view || "";
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_tabel_data_ujian_keanggotaan';
    $.post(act, {
        _token: token
        , view: view
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_div_data_pasangan_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_pasangan';
    var id_form = $('#formKeanggotaanDataPasangan');
    //alert(id_form.find('textarea[name="alamat_rumah_pasangan"]').val());
    // alert(id_form.find('select[name="kota_pasangan"] option:selected').text());
    $.post(act, {
        _token: token,
        nama_pasangan: id_form.find('input[name="nama_pasangan"]').val(),
        gender: id_form.find('input[name="gender"]:checked').val(),
        tempat_lahir_pasangan: id_form.find('select[name="tempat_lahir_pasangan"] option:selected').val(),
        tgl_lahir_pasangan: id_form.find('input[name="tgl_lahir_pasangan"]').val(),
        alamat_rumah_pasangan: id_form.find('textarea[name="alamat_rumah_pasangan"]').val(),
        kota_pasangan: id_form.find('select[name="kota_pasangan"] option:selected').val(),
        pekerjaan_pasangan: id_form.find('input[name="pekerjaan_pasangan"]').val()
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
                div_tabel_data_pasangan_keanggotaan(token, '#div_tabel_data_pasangan_keanggotaan', id);
            }
        });
    });
}

function simpan_div_data_anak_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_anak';
    var id_form = $('#formKeanggotaanDataAnak');
    $.post(act, {
        _token: token,
        nama_anak: id_form.find('input[name="nama_anak"]').val(),
        gender: id_form.find('input[name="gender"]:checked').val(),
        tempat_lahir_anak: id_form.find('select[name="tempat_lahir_anak"] option:selected').val(),
        tgl_lahir_anak: id_form.find('input[name="tgl_lahir_anak"]').val()
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
                div_tabel_data_anak_keanggotaan(token, '#div_tabel_data_anak_keanggotaan', id);
            }
        });
    });
}

function simpan_div_data_pendidikan_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_pendidikan';
    var id_form = $('#formKeanggotaanDataPendidikan');
    $.post(act, {
        _token: token,
        jenjang_pendidikan: id_form.find('select[name="jenjang_pendidikan"] option:selected').val(),
        jurusan: id_form.find('input[name="jurusan"]').val(),
        tgl_lulus: id_form.find('input[name="tgl_lulus"]').val()
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
                div_tabel_data_pendidikan_keanggotaan(token, '#div_tabel_data_pendidikan_keanggotaan', id);
            }
        });
    });
}

function simpan_div_minat_bidang_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_minat_bidang';
    var id_form = $('#formKeanggotaanMinatBidang'); 
    $.post(act, {
        _token: token,
        jenis_minat: id_form.find('select[name="jenis_minat"] option:selected').val(),
        ket_minat_bidang: id_form.find('input[name="ket_minat_bidang"]').val()
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
                div_tabel_minat_bidang_keanggotaan(token, '#div_tabel_minat_bidang_keanggotaan', id);
            }
        });
    });
}

function simpan_div_data_ujian_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_ujian';
    var id_form = $('#formKeanggotaanDataUjian');
    $.post(act, {
        _token: token,
        nama_ujian: id_form.find('input[name="nama_ujian"]').val(),
        tgl_lulus: id_form.find('input[name="tgl_lulus"]').val(),
        valid_until: id_form.find('input[name="valid_until"]').val(),
        jenis: id_form.find('select[name="jenis"] option:selected').val()
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
                div_tabel_data_ujian_keanggotaan(token, '#div_tabel_data_ujian_keanggotaan', id);
            }
        });
    });
}

function div_tabel_member_belum_verif_cabang(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_member/div_tabel_member_belum_verif_cabang';
    var id_form = $('#formFilterDataMemberAdminCabangBelumVerif');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cab_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_member_sudah_verif_cabang(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_member/div_tabel_member_sudah_verif_cabang';
    var id_form = $('#formFilterDataMemberAdminCabangSudahVerif');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cab_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_member_belum_verif_pusat(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_member/div_tabel_member_belum_verif_pusat';
    var id_form = $('#formFilterDataMemberAdminPusatBelumVerif');
    $.post(act, {
        _token: token,
        admin_pusat_id: id_form.find('select[name="admin_pst_id"] option:selected').val(),
        admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_member_sudah_verif_pusat(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_member/div_tabel_member_sudah_verif_pusat';
    var id_form = $('#formFilterDataMemberAdminPusatSudahVerif');
    $.post(act, {
        _token: token,
        admin_pusat_id: id_form.find('select[name="admin_pst_id"] option:selected').val(),
        admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function update_modal_verif_pusat(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Update Verifikasi Admin Pusat Member');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_member_pusat/' + id + '/update_modal_verif_pusat';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function update_modal_verif_cabang(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Update Verifikasi Admin Cabang Member');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_member_cabang/' + id + '/update_modal_verif_cabang';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function div_tabel_event_cabang(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_event/div_tabel_event_cabang';
    var id_form = $('#formFilterDataMasterEventCabang');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cab_id"] option:selected').val(),
        tgl_event_awal: id_form.find('input[name="tgl_event_awal"]').val(),
        tgl_event_akhir: id_form.find('input[name="tgl_event_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_event_pusat(token, div1) {
    $(div1).html(loading);
    
    var act = '/admin/master_event/div_tabel_event_pusat';
    var id_form = $('#formFilterDataMasterEventPusat');
    $.post(act, {
        _token: token,
        admin_pusat_id: id_form.find('select[name="admin_pst_id"] option:selected').val(),
        tgl_event_awal: id_form.find('input[name="tgl_event_awal"]').val(),
        tgl_event_akhir: id_form.find('input[name="tgl_event_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function modal_onoff_pendaftaran_pusat(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Buka / Tutup Pendaftaran Event Nasional');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_event_pusat/' + id + '/modal_onoff_pendaftaran_pusat';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function simpan_modal_onoff_pendaftaran_pusat(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event_pusat/' + id + '/simpan_modal_onoff_pendaftaran_pusat';
    var id_form = $('#formModalOnOffPendaftaranPusat');
    var max_peserta = id_form.find('input[name="max_event"]').val();
    var status_open = 0;
    var t1 = "Yakin Untuk Menutup Pendaftaran pada Event ini?";
    var txt1 = "";
    var color1 = "#FF5722";
    var txtBtn1 = "#Ya, Tutup!";
    if (id_form.find('input[name="status_event"]').is(':checked')) {
        status_open = 1;
        t1 = "Yakin Untuk Membuka Pendaftaran pada Event ini?";
        txt1 = "Jika anda membuka pendaftaran event, anda tidak akan bisa merubah jumlah maxsimal peserta apabila terdapat peserta yang sudah terdaftar kedalam event.";
        color1 = "#4CAF50";
        txtBtn1 = "Ya, Buka!";
    }
    if (max_peserta == '' && max_peserta < 1) {
        swal({
            title: "Gagal Menyimpan!",
            text: "Isi Terlebih Dahulu Maxsimal Jumlah Peserta Event.",
            confirmButtonColor: "#4CAF50",
            type: "error"
        },
        function (isConfirm) {
            if (isConfirm) {
                l.stop();
            }
        });
    } else {
        swal({
            title: t1,
            text: txt1,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: color1,
            confirmButtonText: txtBtn1,
            cancelButtonText: "Tidak!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $.post(act, {
                    _token: token,
                    status_event: status_open
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
                            div_tabel_event_pusat(token, '#div_tabel_event_pusat');
                            $('.modal').modal('hide');
                        }
                    });
                });
            } else {
                l.stop();
            }
        });
    }
}

function div_tabel_event_pusat_member(token, div1) {
    $(div1).html(loading);
    var act = '/member/event/div_tabel_event_pusat_member';
    var id_form = $('#formFilterMemberEventPusat');
    $.post(act, {
        _token: token,
        admin_pusat_id: id_form.find('select[name="admin_pst_id"] option:selected').val(),
        tgl_event_awal: id_form.find('input[name="tgl_event_awal"]').val(),
        tgl_event_akhir: id_form.find('input[name="tgl_event_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function pemberitahuan(pesan) {
    swal({
        title: pesan,
        text: "",
        confirmButtonColor: "#4CAF50",
        type: "warning"
    },
    function (isConfirm) {
        if (isConfirm) {

        }
    });
}

function gagal(pesan) {
    swal({
        title: pesan,
        text: "",
        confirmButtonColor: "#4CAF50",
        type: "error"
    },
    function (isConfirm) {
        if (isConfirm) {

        }
    });
}

function simpan_form_update_buku_tamu_admin(token, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event/update_status_hadir_n_acc';
    var id_form = $('#formUpdateBukuTamuAdmin');
    var jumdat = id_form.find('input[name="jumlah_data"]').val();
    var ad = new Array();
    for (var i = 1; i <= jumdat; i++) {
        var id_buku_tamu = id_form.find('input[name="id_buku_tamu_'+i+'"]').val();
        var member_acc = id_form.find('select[name="member_acc_'+i+'"] option:selected').val();
        ad.push([id_buku_tamu, member_acc]);
    }

    $.post(act, {
        _token: token,
        arr_data: ad
    },
    function (data) {
        //$('#div_tabel_event_pusat').html(data);
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
                //div_tabel_data_ujian_keanggotaan(token, '#div_tabel_data_ujian_keanggotaan', id);
            }
        });
    });
}

function modal_onoff_pendaftaran_cabang(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Buka / Tutup Pendaftaran Event Nasional');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_event_cabang/' + id + '/modal_onoff_pendaftaran_cabang';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function simpan_modal_onoff_pendaftaran_cabang(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event_cabang/' + id + '/simpan_modal_onoff_pendaftaran_cabang';
    var id_form = $('#formModalOnOffPendaftaranCabang');
    var max_peserta = id_form.find('input[name="max_event"]').val();
    var status_open = 0;
    var t1 = "Yakin Untuk Menutup Pendaftaran pada Event ini?";
    var txt1 = "";
    var color1 = "#FF5722";
    var txtBtn1 = "#Ya, Tutup!";
    if (id_form.find('input[name="status_event"]').is(':checked')) {
        status_open = 1;
        t1 = "Yakin Untuk Membuka Pendaftaran pada Event ini?";
        txt1 = "Jika anda membuka pendaftaran event, anda tidak akan bisa merubah jumlah maxsimal peserta apabila terdapat peserta yang sudah terdaftar kedalam event.";
        color1 = "#4CAF50";
        txtBtn1 = "#Ya, Buka!";
    }
    if (max_peserta == '' && max_peserta < 1) {
        swal({
            title: "Gagal Menyimpan!",
            text: "Isi Terlebih Dahulu Maxsimal Jumlah Peserta Event.",
            confirmButtonColor: "#4CAF50",
            type: "error"
        },
        function (isConfirm) {
            if (isConfirm) {
                l.stop();
            }
        });
    } else {
        swal({
            title: t1,
            text: txt1,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: color1,
            confirmButtonText: txtBtn1,
            cancelButtonText: "Tidak!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $.post(act, {
                    _token: token,
                    status_event: status_open
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
                            div_tabel_event_cabang(token, '#div_tabel_event_cabang');
                            $('.modal').modal('hide');
                        }
                    });
                });
            } else {
                l.stop();
            }
        });
    }
}

function div_tabel_event_cabang_member(token, div1) {
    $(div1).html(loading);
    var act = '/member/event/div_tabel_event_cabang_member';
    var id_form = $('#formFilterMemberEventCabang');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cab_id"] option:selected').val(),
        tgl_event_awal: id_form.find('input[name="tgl_event_awal"]').val(),
        tgl_event_akhir: id_form.find('input[name="tgl_event_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function daftar_event_cabang(token,id_event,id_member) 
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
                            // div_tabel_event_cabang_member(token, '#div_tabel_event_cabang_member');
                            $('.btn_tampilkan').click();
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

function isi_buku_tamu_member(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Isi Data Buku Tamu');
    $(modal + 'Isi').html(loading);
    var act = '/member/event/isi_buku_tamu_member';
    $.post(act, {
        _token: token
        , id: id
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function simpan_form_tambah_event_admin_pusat(token,idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event/tambah/simpan';
    var id_form = $('#formTambahEventAdminPusat');
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('admin_pst_id', id_form.find('select[name="admin_pst_id"] option:selected').val());
    form_data.append('admin_cab_id', id_form.find('input[name="admin_cab_id"]').val());
    form_data.append('jenis_event', id_form.find('input[name="jenis_event"]').val());
    form_data.append('nama_event', id_form.find('input[name="nama_event"]').val());
    form_data.append('tgl_event', id_form.find('input[name="tgl_event"]').val());
    form_data.append('jam_mulai', id_form.find('input[name="jam_mulai"]').val());
    form_data.append('jam_selesai', id_form.find('input[name="jam_selesai"]').val());
    form_data.append('foto_event', id_form.find('input[name="foto_event"]')[0].files[0]);
    form_data.append('max_event', id_form.find('input[name="max_event"]').val());
    form_data.append('deskripsi', id_form.find('textarea[name="deskripsi"]').val());
    form_data.append('prov_id', id_form.find('select[name="prov_id"] option:selected').val());
    form_data.append('kota_id', id_form.find('select[name="kota_id"] option:selected').val());
    form_data.append('kec_id', id_form.find('select[name="kec_id"] option:selected').val());
    form_data.append('lokasi_alamat', id_form.find('textarea[name="lokasi_alamat"]').val());
    form_data.append('kordinat', id_form.find('input[name="kordinat"]').val());
    form_data.append('jenis_event_id', id_form.find('select[name="jenis_event_id"] option:selected').val());
    form_data.append('numpang_simposium_event_id', id_form.find('select[name="numpang_simposium_event_id"] option:selected').val());
    form_data.append('nama_bank', id_form.find('input[name="nama_bank"]').val());
    form_data.append('no_rek', id_form.find('input[name="no_rek"]').val());
    form_data.append('pemilik_rek', id_form.find('input[name="pemilik_rek"]').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) { 
            //$('#div_tabel_event_pusat').html(data);
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    $('.btn_tampilkan').click();
                }
            });
        }
    });
}

function simpan_form_tambah_event_admin_cabang(token,idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event/tambah/simpan';
    var id_form = $('#formTambahEventAdminCabang');
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('admin_cab_id', id_form.find('select[name="admin_cab_id"] option:selected').val());
    form_data.append('admin_pst_id', id_form.find('input[name="admin_pst_id"]').val());
    form_data.append('jenis_event', id_form.find('input[name="jenis_event"]').val());
    form_data.append('nama_event', id_form.find('input[name="nama_event"]').val());
    form_data.append('tgl_event', id_form.find('input[name="tgl_event"]').val());
    form_data.append('jam_mulai', id_form.find('input[name="jam_mulai"]').val());
    form_data.append('jam_selesai', id_form.find('input[name="jam_selesai"]').val());
    form_data.append('foto_event', id_form.find('input[name="foto_event"]')[0].files[0]);
    form_data.append('max_event', id_form.find('input[name="max_event"]').val());
    form_data.append('deskripsi', id_form.find('textarea[name="deskripsi"]').val());
    form_data.append('prov_id', id_form.find('select[name="prov_id"] option:selected').val());
    form_data.append('kota_id', id_form.find('select[name="kota_id"] option:selected').val());
    form_data.append('kec_id', id_form.find('select[name="kec_id"] option:selected').val());
    form_data.append('lokasi_alamat', id_form.find('textarea[name="lokasi_alamat"]').val());
    form_data.append('kordinat', id_form.find('input[name="kordinat"]').val());
    form_data.append('jenis_event_id', id_form.find('select[name="jenis_event_id"] option:selected').val());
    form_data.append('numpang_simposium_event_id', id_form.find('select[name="numpang_simposium_event_id"] option:selected').val());
    form_data.append('nama_bank', id_form.find('input[name="nama_bank"]').val());
    form_data.append('no_rek', id_form.find('input[name="no_rek"]').val());
    form_data.append('pemilik_rek', id_form.find('input[name="pemilik_rek"]').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) { 
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    $('.btn_tampilkan').click();
                }
            });
        }
    });
}

function simpan_form_ubah_event_admin_pusat(token,id,idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event/'+id+'/ubah/simpan';
    var id_form = $('#formUbahEventAdminPusat');
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('admin_pst_id', id_form.find('select[name="admin_pst_id"] option:selected').val());
    form_data.append('admin_cab_id', id_form.find('input[name="admin_cab_id"]').val());
    form_data.append('jenis_event', id_form.find('input[name="jenis_event"]').val());
    form_data.append('nama_event', id_form.find('input[name="nama_event"]').val());
    form_data.append('tgl_event', id_form.find('input[name="tgl_event"]').val());
    form_data.append('jam_mulai', id_form.find('input[name="jam_mulai"]').val());
    form_data.append('jam_selesai', id_form.find('input[name="jam_selesai"]').val());
    form_data.append('foto_event', id_form.find('input[name="foto_event"]')[0].files[0]);
    form_data.append('max_event', id_form.find('input[name="max_event"]').val());
    form_data.append('deskripsi', id_form.find('textarea[name="deskripsi"]').val());
    form_data.append('prov_id', id_form.find('select[name="prov_id"] option:selected').val());
    form_data.append('kota_id', id_form.find('select[name="kota_id"] option:selected').val());
    form_data.append('kec_id', id_form.find('select[name="kec_id"] option:selected').val());
    form_data.append('lokasi_alamat', id_form.find('textarea[name="lokasi_alamat"]').val());
    form_data.append('kordinat', id_form.find('input[name="kordinat"]').val());
    form_data.append('jenis_event_id', id_form.find('select[name="jenis_event_id"] option:selected').val());
    form_data.append('numpang_simposium_event_id', id_form.find('select[name="numpang_simposium_event_id"] option:selected').val());
    form_data.append('nama_bank', id_form.find('input[name="nama_bank"]').val());
    form_data.append('no_rek', id_form.find('input[name="no_rek"]').val());
    form_data.append('pemilik_rek', id_form.find('input[name="pemilik_rek"]').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            //$('#div_tabel_event_pusat').html(data);
            div_tabel_event_pusat(token, '#div_tabel_event_pusat');
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                }
            });
        }
    });
}

function simpan_form_ubah_event_admin_cabang(token,id,idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event/'+id+'/ubah/simpan';
    var id_form = $('#formUbahEventAdminCabang');
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('admin_cab_id', id_form.find('select[name="admin_cab_id"] option:selected').val());
    form_data.append('admin_pst_id', id_form.find('input[name="admin_pst_id"]').val());
    form_data.append('jenis_event', id_form.find('input[name="jenis_event"]').val());
    form_data.append('nama_event', id_form.find('input[name="nama_event"]').val());
    form_data.append('tgl_event', id_form.find('input[name="tgl_event"]').val());
    form_data.append('jam_mulai', id_form.find('input[name="jam_mulai"]').val());
    form_data.append('jam_selesai', id_form.find('input[name="jam_selesai"]').val());
    form_data.append('foto_event', id_form.find('input[name="foto_event"]')[0].files[0]);
    form_data.append('max_event', id_form.find('input[name="max_event"]').val());
    form_data.append('deskripsi', id_form.find('textarea[name="deskripsi"]').val());
    form_data.append('prov_id', id_form.find('select[name="prov_id"] option:selected').val());
    form_data.append('kota_id', id_form.find('select[name="kota_id"] option:selected').val());
    form_data.append('kec_id', id_form.find('select[name="kec_id"] option:selected').val());
    form_data.append('lokasi_alamat', id_form.find('textarea[name="lokasi_alamat"]').val());
    form_data.append('kordinat', id_form.find('input[name="kordinat"]').val());
    form_data.append('jenis_event_id', id_form.find('select[name="jenis_event_id"] option:selected').val());
    form_data.append('numpang_simposium_event_id', id_form.find('select[name="numpang_simposium_event_id"] option:selected').val());
    form_data.append('nama_bank', id_form.find('input[name="nama_bank"]').val());
    form_data.append('no_rek', id_form.find('input[name="no_rek"]').val());
    form_data.append('pemilik_rek', id_form.find('input[name="pemilik_rek"]').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            div_tabel_event_cabang(token, '#div_tabel_event_cabang');
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                }
            });
        }
    });
}

function div_tabel_event_saya_member(token, div1) {
    $(div1).html(loading);
    var act = '/member/event/div_tabel_event_saya_member';
    var id_form = $('#formFilterMemberEventSaya');
    $.post(act, {
        _token: token,
        member_id: id_form.find('input[name="member_id"]').val(),
        tgl_event_awal: id_form.find('input[name="tgl_event_awal"]').val(),
        tgl_event_akhir: id_form.find('input[name="tgl_event_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_event_saya_member_div_pendek(token, div1) {
    $(div1).html(loading);
    var act = '/member/event/div_tabel_event_saya_member_div_pendek';
    var id_form = $('#formFilterMemberEventSaya');
    $.post(act, {
        _token: token,
        member_id: id_form.find('input[name="member_id"]').val(),
        tgl_event_awal: id_form.find('input[name="tgl_event_awal"]').val(),
        tgl_event_akhir: id_form.find('input[name="tgl_event_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_event_saya_member2(token, div1) {
    $(div1).html(loading);
    var act = '/member/event/div_tabel_event_saya_member2';
    var id_form = $('#formFilterMemberEventSayaLunas');
    $.post(act, {
        _token: token,
        member_id: id_form.find('input[name="member_id"]').val(),
        tgl_event_awal: id_form.find('input[name="tgl_event_awal"]').val(),
        tgl_event_akhir: id_form.find('input[name="tgl_event_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function modal_kehadiran(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Isi Data Buku Tamu');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_event/' + id + '/modal_kehadiran';
    $.post(act, {
        _token: token
    },
    function (data) {
            // alert(data);
            $(modal + 'Isi').html(data);
        });
}

function simpan_form_update_kehadiran_admin(token, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event/update_status_hadir';
    var id_form = $('#formUpdateKehadiranAdmin');
    var jumdat = id_form.find('input[name="jumlah_data"]').val();
    var ad = new Array();
    for (var i = 1; i <= jumdat; i++) {
        var id_buku_tamu = id_form.find('input[name="id_buku_tamu_'+i+'"]').val();
        var status_hadir = 2;
        if (id_form.find('input[name="status_hadir_'+i+'"]').is(':checked')) {
            status_hadir = 1;
        }
        ad.push([id_buku_tamu, status_hadir]);
    }

    $.post(act, {
        _token: token,
        arr_data: ad
    },
    function (data) {
        //$('#div_tabel_event_pusat').html(data);
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
                //div_tabel_data_ujian_keanggotaan(token, '#div_tabel_data_ujian_keanggotaan', id);
            }
        });
    });
}

function update_reset_password_member_by_sa(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Update Data Admin Cabang');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_member/' + id + '/modal_reset_password';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function simpan_form_update_reset_password_admin(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_member/'+id+'/simpan_form_update_reset_password_admin';
    var id_form = $('#formResetPasswordMemberAdmin');
    $.post(act, {
        _token: token,
        new_password: id_form.find('input[name="f1_password"]').val(),
        new_password_confirmation: id_form.find('input[name="f1_password_confirmation"]').val()
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
                $('.modal').modal('hide');
            }
        });
    });
}

// --- Start Tambahan Baru ---

function div_data_jurnal_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_data_jurnal_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_data_jurnal_keanggotaan(token, div1, id, view) {
    view = view || "";
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_tabel_data_jurnal_keanggotaan';
    $.post(act, {
        _token: token
        , view
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_div_data_jurnal_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_jurnal';
    var id_form = $('#formKeanggotaanDataJurnal');
    if (id_form.find('input[name="file_name"]')[0].files[0].size <= 10000000) {
        var form_data = new FormData();
        form_data.append('_token', token);
        form_data.append('judul', id_form.find('input[name="judul"]').val());
        form_data.append('tgl_terbit', id_form.find('input[name="tgl_terbit"]').val());
        form_data.append('file_name', id_form.find('input[name="file_name"]')[0].files[0]);
        $.ajax({
            url: act,
            data: form_data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                swal({
                    title: data,
                    text: "",
                    confirmButtonColor: "#4CAF50",
                    type: "success"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        l.stop();
                        div_tabel_data_jurnal_keanggotaan(token, '#div_tabel_data_jurnal_keanggotaan', id);
                    }
                });
            }
        });
    } else {
        swal({
            title: "Jurnal yang anda inputkan lebih dari 10MB",
            text: "",
            confirmButtonColor: "#4CAF50",
            type: "warning"
        },
        function (isConfirm) {
            if (isConfirm) {
                l.stop();
            }
        });
    }
}

function delete_myprofile_member_jurnal(token, id, member_id) {
    swal({
        title: "Yakin Untuk Menghapus Data Jurnal?",
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
            var act = '/member/myprofilemember/tabel_detail_jurnal/' + id + '/hapus';
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
                        div_tabel_data_jurnal_keanggotaan(token, '#div_tabel_data_jurnal_keanggotaan', member_id);
                    }
                });
            });
        }
    });
}



function div_data_file_keanggotaan(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_data_file_keanggotaan';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_data_file_keanggotaan(token, div1, id, view) {
    view = view || "";
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_tabel_data_file_keanggotaan';
    $.post(act, {
        _token: token
        , view: view
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_div_data_file_keanggotaan(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_data_file';
    var id_form = $('#formKeanggotaanDataFile');
    if (id_form.find('input[name="file_name"]')[0].files[0].size <= 10000000) {
        var form_data = new FormData();
        form_data.append('_token', token);
        form_data.append('file_name', id_form.find('input[name="file_name"]')[0].files[0]);
        form_data.append('keterangan', id_form.find('textarea[name="keterangan"]').val());
        // alert(id_form.find('input[name="file_name"]')[0].files[0].size);
        $.ajax({
            url: act,
            data: form_data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                swal({
                    title: data,
                    text: "",
                    confirmButtonColor: "#4CAF50",
                    type: "success"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        l.stop();
                        //alertKu('success', data);
                        div_tabel_data_file_keanggotaan(token, '#div_tabel_data_file_keanggotaan', id);
                    }
                });
            }
        });
    } else {
        swal({
            title: "File yang anda inputkan lebih dari 10MB",
            text: "",
            confirmButtonColor: "#4CAF50",
            type: "warning"
        },
        function (isConfirm) {
            if (isConfirm) {
                l.stop();
            }
        });
    }
}

function delete_myprofile_member_file(token, id, member_id) {
    swal({
        title: "Yakin Untuk Menghapus Data File?",
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
            var act = '/member/myprofilemember/tabel_detail_file/' + id + '/hapus';
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
                        div_tabel_data_file_keanggotaan(token, '#div_tabel_data_file_keanggotaan', member_id);
                    }
                });
            });
        }
    });
}

// --- Finish Tambahan Baru ---

function modal_daftar_harga_event(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Daftar Harga Event');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_event/' + id + '/modal_daftar_harga_event';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function div_tabel_data_harga_event(token, div1, id) {
    $(div1).html(loading);
    var act = '/admin/master_event/' + id + '/div_tabel_data_harga_event';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_form_modal_harga_event(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event/' + id + '/simpan_harga_event';
    var id_form = $('#formModalTambahHargaEvent'); 
    $.post(act, {
        _token: token,
        kategori: id_form.find('input[name="kategori"]').val(),
        harga: id_form.find('input[name="harga"]').val(),
        kuota_peserta: id_form.find('input[name="kuota_peserta"]').val()
    },
    function (data) {
        l.stop();
        if (data == "success") {
            swal({
                title: "Berhasil Menyimpan Harga Event ",
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    div_tabel_data_harga_event(token, '#div_tabel_data_harga_event', id);
                    div_data_harga_event(token, '#div_data_harga_event', id, '0');
                }
            });
        } else {
            alertKu('warning', data);
        }
    });
}

function delete_harga_event(token, id, event_id) {
    swal({
        title: "Yakin Untuk Menghapus Data Harga Event?",
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
            var act = '/admin/master_event/' + id + '/delete_harga_event';
            $.post(act, {
                _token: token
            },
            function (data) {
                if (data == "sukses") {
                    swal({
                        title: "Berhasil Menghapus Harga Event ",
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "success"
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            div_tabel_data_harga_event(token, '#div_tabel_data_harga_event', event_id);
                        }
                    });
                } else {
                    swal({
                        title: data,
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "error"
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            div_tabel_data_harga_event(token, '#div_tabel_data_harga_event', event_id);
                        }
                    });
                }
            });
        }
    });
}

function tambah_point(target, token, koordinat, id_inputan){ 
    $(target).html(loading);
    var act = '/admin/master_event/tambah_point';
    $.post(act, { 
        _token: token, 
        koordinat: koordinat, 
        id_inputan: id_inputan
    },
    function (data) {
        $(target).html(data);
    }); 
}

function kota_by_provinsi_id(token, form_id, id) {
    var act = '/member/master_wilayah/kota_by_provinsi_id';
    var id_form = $(form_id);
    var prov_id = id_form.find('select[name="prov_id"] option:selected').val();
    var kota_id = 0;
    if (id != 0 && id !== null) {
        kota_id = id;
    }
    id_form.find('select[name="kota_id"]').html('<option value="">loading...</option>');
    id_form.find('select[name="kec_id"]').html('<option value="">-- Pilih Kecamatan --</option>');
    $.post(act, {
        _token: token,
        prov_id: prov_id,
        kota_id: kota_id
    },
    function (data) {
        id_form.find('select[name="kota_id"]').html(data);
        $('.select22').select2();
    });
}

function kecamatan_by_kota_id(token, form_id, id, id_kota) {
    var act = '/member/master_wilayah/kecamatan_by_kota_id';
    var id_form = $(form_id);
    var kota_id = id_form.find('select[name="kota_id"] option:selected').val();
    if (id_kota != 0 && id_kota !== null) {
        kota_id = id_kota;
    }
    var kec_id = 0;
    if (id != 0 && id !== null) {
        kec_id = id;
    }
    id_form.find('select[name="kec_id"]').html('<option value="">loading...</option>');
    $.post(act, {
        _token: token,
        kota_id: kota_id,
        kec_id: kec_id
    },
    function (data) {
        id_form.find('select[name="kec_id"]').html(data);
        $('.select22').select2();
    });
}

function modal_daftar_event(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Modal Pendaftaran Event');
    $(modal + 'Isi').html(loading);
    var act = '/member/master_event/' + id + '/modal_daftar_event';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function simpan_form_modal_daftar_event(token, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/master_event/simpan_form_modal_daftar_event';
    var id_form = $('#formModalDaftarEvent'); 
    if (id_form.find('input[name="kuota"]').val() > 0) {
        $.post(act, {
            _token: token,
            event_harga_id: id_form.find('select[name="event_harga_id"] option:selected').val(),
            event_id: id_form.find('input[name="event_id"]').val(),
            kode_unik: id_form.find('input[name="kode_unik"]').val(),
            nominal_bayar: id_form.find('input[name="nominal_bayar"]').val(),
            member_id: id_form.find('input[name="member_id"]').val()
        },
        function (data) {
            l.stop();
            if (data == "sukses" || data == "success") {
                swal({
                    title: "Berhasil Mengajukan Pendaftaran Event, Segera Lakukan Pembayaran",
                    text: "",
                    confirmButtonColor: "#4CAF50",
                    type: "success"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        // window.location.href = url;
                        $('.modal').modal('hide');
                    }
                });
            } else {
                swal({
                    title: data,
                    text: "",
                    confirmButtonColor: "#4CAF50",
                    type: "error"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        l.stop();
                        //$('#div_tabel_event_pusat_member').html(data);
                        $('.modal').modal('hide');
                    }
                });
            }
        });
    } else {
        swal({
            title: "Stok Kategori harga ini sudah habis, silahkan cek kembali stok yang lain.",
            text: "",
            confirmButtonColor: "#4CAF50",
            type: "error"
        },
        function (isConfirm) {
            if (isConfirm) {
                l.stop();
            }
        });
    }
}

function div_nomor_anggota_pabi(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_nomor_anggota_pabi';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_div_nomor_anggota_pabi(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_div_nomor_anggota_pabi';
    var id_form = $('#formDivNomorAnggotaPABI');
    $.post(act, {
        _token: token,
        card_no: id_form.find('input[name="card_no"]').val(),
        bulan: id_form.find('select[name="kode_bulan"] option:selected').val(),
        tahun: id_form.find('input[name="kode_tahun"]').val()
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
            }
        });
    });
}

function generate_kode_nomor_pabi(form_id) {
    var form_id = $(form_id);
    var t1 = form_id.find('select[name="kode_wilayah"] option:selected').val();
    var t2 = form_id.find('select[name="kode_kota"] option:selected').val();
    var t3 = form_id.find('select[name="kode_bulan"] option:selected').val();
    var t4 = form_id.find('input[name="kode_tahun"]').val().substring(2, 5);
    var t5 = form_id.find('input[name="no_urut"]').val();
    var semua = t1+'-'+t2+'-'+t3+'-'+t4+'-'+t5;
    form_id.find('input[name="card_no"]').val(semua);
}

function generate_kode_ujian_finacs(form_id) {
    var form_id = $(form_id);
    var t1 = form_id.find('select[name="kode_ujian"] option:selected').val();
    var t2 = form_id.find('select[name="kode_wilayah"] option:selected').val();
    var t3 = form_id.find('select[name="kode_bulan"] option:selected').val();
    var t4 = form_id.find('input[name="kode_tahun"]').val().substring(2, 5);
    var t5 = form_id.find('input[name="no_urut"]').val();
    var semua = t1+'-'+t2+'-'+t3+'-'+t4+'-'+t5;
    form_id.find('input[name="nama_ujian"]').val(semua);
}

function update_myprofile_member_ujian(token, id, member_id) {
    $('#div_data_ujian_keanggotaan').html(loading);
    var act = '/member/keanggotaan/' + id + '/div_data_ujian_keanggotaan_ubah';
    $.post(act, {
        _token: token
    },
    function (data) {
        $('#div_data_ujian_keanggotaan').html(data);
    });
}

function simpan_div_data_ujian_keanggotaan_ubah(token, id, idBtn, member_id) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_perubahan_data_ujian';
    var id_form = $('#formKeanggotaanDataUjianUbah');
    $.post(act, {
        _token: token,
        nama_ujian: id_form.find('input[name="nama_ujian"]').val(),
        tgl_lulus: id_form.find('input[name="tgl_lulus"]').val(),
        valid_until: id_form.find('input[name="valid_until"]').val(),
        jenis: id_form.find('select[name="jenis"] option:selected').val()
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
                //alertKu('success', data);
                div_data_ujian_keanggotaan(token, '#div_data_ujian_keanggotaan', member_id);
                div_tabel_data_ujian_keanggotaan(token, '#div_tabel_data_ujian_keanggotaan', member_id);
            }
        });
    });
}

function jenis_kegiatan_by_borang(token, form_id) {
    var act = '/member/master_borang/jenis_kegiatan_by_borang';
    var id_form = $(form_id);
    var borang = id_form.find('select[name="borang"] option:selected').val();
    
    id_form.find('select[name="jenis_kegiatan"]').html('<option value="">loading...</option>');
    id_form.find('select[name="nama_kegiatan"]').html('<option value="">-- Semua --</option>');
    $.post(act, {
        _token: token,
        borang: borang
    },
    function (data) {
        id_form.find('select[name="jenis_kegiatan"]').html(data);
        $('.select22').select2();
    });
}

function nama_kegiatan_by_jenis_kegiatan(token, form_id) {
    var act = '/member/master_borang/nama_kegiatan_by_jenis_kegiatan';
    var id_form = $(form_id);
    var jenis_kegiatan = id_form.find('select[name="jenis_kegiatan"] option:selected').val();
    
    id_form.find('select[name="nama_kegiatan"]').html('<option value="">loading...</option>');
    $.post(act, {
        _token: token,
        jenis_kegiatan: jenis_kegiatan
    },
    function (data) {
        id_form.find('select[name="nama_kegiatan"]').html(data);
        $('.select22').select2();
    });
}

function div_tabel_borang_belum_verif_cabang(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_borang/div_tabel_borang_belum_verif_cabang';
    var id_form = $('#formFilterDataBorangAdminCabangBelumVerif');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        ranah_borang_id: id_form.find('select[name="borang"] option:selected').val(),
        jenis_kegiatan_id: id_form.find('select[name="jenis_kegiatan"] option:selected').val(),
        kegiatan_id: id_form.find('select[name="nama_kegiatan"] option:selected').val(),
        nama_member: id_form.find('input[name="nama_member"]').val(),
        tgl_borang_awal: id_form.find('input[name="tgl_borang_awal"]').val(),
        tgl_borang_akhir: id_form.find('input[name="tgl_borang_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_borang_sudah_verif_cabang(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_borang/div_tabel_borang_sudah_verif_cabang';
    var id_form = $('#formFilterDataBorangAdminCabangSudahVerif');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        ranah_borang_id: id_form.find('select[name="borang"] option:selected').val(),
        jenis_kegiatan_id: id_form.find('select[name="jenis_kegiatan"] option:selected').val(),
        kegiatan_id: id_form.find('select[name="nama_kegiatan"] option:selected').val(),
        nama_member: id_form.find('input[name="nama_member"]').val(),
        tgl_borang_awal: id_form.find('input[name="tgl_borang_awal"]').val(),
        tgl_borang_akhir: id_form.find('input[name="tgl_borang_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_borang_belum_verif_pusat(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_borang/div_tabel_borang_belum_verif_pusat';
    var id_form = $('#formFilterDataBorangAdminPusatBelumVerif');
    $.post(act, {
        _token: token,
        admin_pusat_id: id_form.find('select[name="admin_pst_id"] option:selected').val(),
        admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        ranah_borang_id: id_form.find('select[name="borang"] option:selected').val(),
        jenis_kegiatan_id: id_form.find('select[name="jenis_kegiatan"] option:selected').val(),
        kegiatan_id: id_form.find('select[name="nama_kegiatan"] option:selected').val(),
        nama_member: id_form.find('input[name="nama_member"]').val(),
        tgl_borang_awal: id_form.find('input[name="tgl_borang_awal"]').val(),
        tgl_borang_akhir: id_form.find('input[name="tgl_borang_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_borang_sudah_verif_pusat(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_borang/div_tabel_borang_sudah_verif_pusat';
    var id_form = $('#formFilterDataBorangAdminPusatSudahVerif');
    $.post(act, {
        _token: token,
        admin_pusat_id: id_form.find('select[name="admin_pst_id"] option:selected').val(),
        admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        ranah_borang_id: id_form.find('select[name="borang"] option:selected').val(),
        jenis_kegiatan_id: id_form.find('select[name="jenis_kegiatan"] option:selected').val(),
        kegiatan_id: id_form.find('select[name="nama_kegiatan"] option:selected').val(),
        nama_member: id_form.find('input[name="nama_member"]').val(),
        tgl_borang_awal: id_form.find('input[name="tgl_borang_awal"]').val(),
        tgl_borang_akhir: id_form.find('input[name="tgl_borang_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function halaman_detail_event(url) {
    window.location.href = url;
}

function halaman_isi_buku_tamu(url) {
    window.location.href = url;
}
 
function halaman_kehadiran(url) {
    window.location.href = url;
}

function tambah_modal_borang(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Data Borang');
    $(modal + 'Isi').html(loading);
    var act = '/member/master_borang/tambah';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
} 

function tampilkan_form_borang_tambah(token, div, member_id, div2) {
    $(div).html(loading);
    var act = '/member/master_borang/tampilkan_form_borang_tambah';
    var id_form = $('#formPilihFormBorang');
    $.post(act, {
        _token: token,
        member_id: member_id,
        borang_id: id_form.find('select[name="borang"] option:selected').val(),
        jenis_kegiatan_id: id_form.find('select[name="jenis_kegiatan"] option:selected').val(),
        nama_kegiatan_id: id_form.find('select[name="nama_kegiatan"] option:selected').val(),
        borang: id_form.find('select[name="borang"] option:selected').text(),
        jenis_kegiatan: id_form.find('select[name="jenis_kegiatan"] option:selected').text(),
        nama_kegiatan: id_form.find('select[name="nama_kegiatan"] option:selected').text(),
        tanggal_tabel: id_form.find('input[name="tanggal_tabel"]').val()
    },
    function (data) {
        $(div).html(data);
        $(div2).hide(500);//css('display','none');
    });
}

function update_modal_borang(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Ubah Data Borang');
    $(modal + 'Isi').html(loading);
    var act = '/member/master_borang/' + id + '/ubah';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function delete_buku_tamu(token, id) {
    swal({
        title: "Yakin Untuk Membatalkan Pendaftaran Event?",
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
            var act = '/member/buku_tamu/' + id + '/hapus';
            $.post(act, {
                _token: token
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
                        div_tabel_event_saya_member(token, '#div_tabel_event_saya_member')
                    }
                });
            });
        }
    });
} 

function upload_bukti_bayar_event(token, buku_tamu_id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Upload Bukti Pembayaran');
    $(modal + 'Isi').html(loading);
    var act = '/member/master_event/upload_bukti_bayar_event';
    $.post(act, {
        _token: token,
        buku_tamu_id: buku_tamu_id
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function borang_ranah_kegiatan_pembelajaran_pribadi(form_id) {
    //alert();
    var id_form = $(form_id);
    var jenis_kegiatan_id = id_form.find('input[name="jenis_kegiatan_id"]').val();
    var jenis_kegiatan = id_form.find('input[name="jenis_kegiatan"]').val();
    switch(jenis_kegiatan_id) {
        // Kegiatan Belajar Mandiri
        case '1':
        //id_form.find('div[id="div_nama_jurnal_situsweb"]').css('display','none');
        //id_form.find('div[id="div_judul_artikel_topik"]').css('display','none');
        id_form.find('div[id="div_tempat"]').css('display','none');
        id_form.find('div[id="div_peran_serta"]').css('display','none');
        id_form.find('div[id="div_penyelenggara"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');

        //id_form.find('input[name="nama_jurnal_situsweb"]').removeAttr('required');
        //id_form.find('input[name="judul_artikel_topik"]').removeAttr('required');
        id_form.find('input[name="tempat"]').removeAttr('required');
        id_form.find('input[name="peran_serta"]').removeAttr('required');
        id_form.find('input[name="penyelenggara"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        // Kegiatan Pelatihan/Workshop/Lokakarya
        case '2':
        id_form.find('div[id="div_nama_jurnal_situsweb"]').css('display','none');
        id_form.find('div[id="div_judul_artikel_topik"]').css('display','none');
        //id_form.find('div[id="div_tempat"]').css('display','none');
        //id_form.find('div[id="div_peran_serta"]').css('display','none');
        //id_form.find('div[id="div_penyelenggara"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');

        id_form.find('input[name="nama_jurnal_situsweb"]').removeAttr('required');
        id_form.find('input[name="judul_artikel_topik"]').removeAttr('required');
        //id_form.find('input[name="tempat"]').removeAttr('required');
        //id_form.find('input[name="peran_serta"]').removeAttr('required');
        //id_form.find('input[name="penyelenggara"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        // Kegiatan Keikutsertaan Pertemuan Ilmiah
        case '3':
        id_form.find('div[id="div_nama_jurnal_situsweb"]').css('display','none');
        id_form.find('div[id="div_judul_artikel_topik"]').css('display','none');
        //id_form.find('div[id="div_tempat"]').css('display','none');
        //id_form.find('div[id="div_peran_serta"]').css('display','none');
        //id_form.find('div[id="div_penyelenggara"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');

        id_form.find('input[name="nama_jurnal_situsweb"]').removeAttr('required');
        id_form.find('input[name="judul_artikel_topik"]').removeAttr('required');
        //id_form.find('input[name="tempat"]').removeAttr('required');
        //id_form.find('input[name="peran_serta"]').removeAttr('required');
        //id_form.find('input[name="penyelenggara"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        // Kegiatan Fellowship
        case '4':
        id_form.find('div[id="div_nama_jurnal_situsweb"]').css('display','none');
        id_form.find('div[id="div_judul_artikel_topik"]').css('display','none');
        //id_form.find('div[id="div_tempat"]').css('display','none');
        //id_form.find('div[id="div_peran_serta"]').css('display','none');
        //id_form.find('div[id="div_penyelenggara"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');

        id_form.find('input[name="nama_jurnal_situsweb"]').removeAttr('required');
        id_form.find('input[name="judul_artikel_topik"]').removeAttr('required');
        //id_form.find('input[name="tempat"]').removeAttr('required');
        //id_form.find('input[name="peran_serta"]').removeAttr('required');
        //id_form.find('input[name="penyelenggara"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        // Kegiatan Evaluasi dan Uji Diri
        case '5':
        id_form.find('div[id="div_nama_jurnal_situsweb"]').css('display','none');
        id_form.find('div[id="div_judul_artikel_topik"]').css('display','none');
        //id_form.find('div[id="div_tempat"]').css('display','none');
        id_form.find('div[id="div_peran_serta"]').css('display','none');
        id_form.find('div[id="div_penyelenggara"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');

        id_form.find('input[name="nama_jurnal_situsweb"]').removeAttr('required');
        id_form.find('input[name="judul_artikel_topik"]').removeAttr('required');
        //id_form.find('input[name="tempat"]').removeAttr('required');
        id_form.find('input[name="peran_serta"]').removeAttr('required');
        id_form.find('input[name="penyelenggara"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        default:
        break;
    }
}

function borang_ranah_profesional(form_id) {
    //alert();
    var id_form = $(form_id);
    var jenis_kegiatan_id = id_form.find('input[name="jenis_kegiatan_id"]').val();
    var jenis_kegiatan = id_form.find('input[name="jenis_kegiatan"]').val();
    switch(jenis_kegiatan_id) {
        // Kegiatan Diagnostik
        case '6':
        //id_form.find('div[id="div_jenis_kegiatan_diagnostik"]').css('display','none');
        //id_form.find('div[id="div_peran_serta_diagnostik"]').css('display','none');
        id_form.find('div[id="div_jenis_tindakan_operasi"]').css('display','none');
        id_form.find('div[id="div_nama_tindakan_operasi"]').css('display','none');
        id_form.find('div[id="div_jenis_operasi"]').css('display','none');
        id_form.find('div[id="div_jenis_kasus_bedah"]').css('display','none');
        id_form.find('div[id="div_jenis_tindakan_bedah"]').css('display','none');
        id_form.find('div[id="div_nama_tindakan_bedah"]').css('display','none');
        id_form.find('div[id="div_jenis_kasus_rujukan"]').css('display','none');
        id_form.find('div[id="div_tujuan_rujukan"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');
        id_form.find('div[id="div_no_rekam_medik"]').css('display','none');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('div[id="div_koordinat"]').css('display','none');
        id_form.find('div[id="div_induk_peta_borang_profesional"]').css('display','none');

        //id_form.find('input[name="jenis_kegiatan_diagnostik"]').removeAttr('required');
        //id_form.find('input[name="peran_serta_diagnostik"]').removeAttr('required');
        id_form.find('select[name="jenis_tindakan_operasi"]').removeAttr('required');
        id_form.find('select[name="nama_tindakan_operasi"]').removeAttr('required');
        id_form.find('input[name="jenis_operasi"]').removeAttr('required');
        id_form.find('input[name="jenis_kasus_bedah"]').removeAttr('required');
        id_form.find('select[name="jenis_tindakan_bedah"]').removeAttr('required');
        id_form.find('select[name="nama_tindakan_bedah"]').removeAttr('required');
        id_form.find('input[name="jenis_kasus_rujukan"]').removeAttr('required');
        id_form.find('input[name="tujuan_rujukan"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');
        if (id_form.find('input[name="jenis_kegiatan_diagnostik"]').val() == '') {
            id_form.find('input[name="jenis_kegiatan_diagnostik"]').val(id_form.find('input[name="nama_kegiatan"]').val());
        }
        id_form.find('input[name="no_rekam_medik"]').removeAttr('required');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        id_form.find('input[name="koordinat"]').removeAttr('required');

        //id_form.find('div[id="div_rs_id"]').css('display','none');
        //id_form.find('select[name="rs_id"]').removeAttr('required');
        break;
        // Kegiatan Operasi
        case '7':
        id_form.find('div[id="div_jenis_kegiatan_diagnostik"]').css('display','none');
        id_form.find('div[id="div_peran_serta_diagnostik"]').css('display','none');
        //id_form.find('div[id="div_jenis_tindakan_operasi"]').css('display','none');
        //id_form.find('div[id="div_nama_tindakan_operasi"]').css('display','none');
        //id_form.find('div[id="div_jenis_operasi"]').css('display','none');
        id_form.find('div[id="div_jenis_kasus_bedah"]').css('display','none');
        id_form.find('div[id="div_jenis_tindakan_bedah"]').css('display','none');
        id_form.find('div[id="div_nama_tindakan_bedah"]').css('display','none');
        id_form.find('div[id="div_jenis_kasus_rujukan"]').css('display','none');
        id_form.find('div[id="div_tujuan_rujukan"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');
        //id_form.find('div[id="div_no_rekam_medik"]').css('display','none');
        //id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('div[id="div_koordinat"]').css('display','none');
        id_form.find('div[id="div_induk_peta_borang_profesional"]').css('display','none');

        id_form.find('input[name="jenis_kegiatan_diagnostik"]').removeAttr('required');
        id_form.find('input[name="peran_serta_diagnostik"]').removeAttr('required');
        //id_form.find('select[name="jenis_tindakan_operasi"]').removeAttr('required');
        //id_form.find('select[name="nama_tindakan_operasi"]').removeAttr('required');
        //id_form.find('input[name="jenis_operasi"]').removeAttr('required');
        id_form.find('input[name="jenis_kasus_bedah"]').removeAttr('required');
        id_form.find('select[name="jenis_tindakan_bedah"]').removeAttr('required');
        id_form.find('select[name="nama_tindakan_bedah"]').removeAttr('required');
        id_form.find('input[name="jenis_kasus_rujukan"]').removeAttr('required');
        id_form.find('input[name="tujuan_rujukan"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');
        if (id_form.find('input[name="jenis_operasi"]').val() == '') {
            id_form.find('input[name="jenis_operasi"]').val(id_form.find('input[name="nama_kegiatan"]').val());
        }
        //id_form.find('input[name="no_rekam_medik"]').removeAttr('required');
        //id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        id_form.find('input[name="koordinat"]').removeAttr('required');

        //id_form.find('div[id="div_rs_id"]').css('display','none');
        //id_form.find('select[name="rs_id"]').removeAttr('required');
        break;
        // Kegiatan Penanganan Kasus Bedah
        case '8':
        id_form.find('div[id="div_jenis_kegiatan_diagnostik"]').css('display','none');
        id_form.find('div[id="div_peran_serta_diagnostik"]').css('display','none');
        id_form.find('div[id="div_jenis_tindakan_operasi"]').css('display','none');
        id_form.find('div[id="div_nama_tindakan_operasi"]').css('display','none');
        id_form.find('div[id="div_jenis_operasi"]').css('display','none');
        //id_form.find('div[id="div_jenis_kasus_bedah"]').css('display','none');
        //id_form.find('div[id="div_jenis_tindakan_bedah"]').css('display','none');
        //id_form.find('div[id="div_nama_tindakan_bedah"]').css('display','none');
        id_form.find('div[id="div_jenis_kasus_rujukan"]').css('display','none');
        id_form.find('div[id="div_tujuan_rujukan"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');
        id_form.find('div[id="div_no_rekam_medik"]').css('display','none');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('div[id="div_koordinat"]').css('display','none');
        id_form.find('div[id="div_induk_peta_borang_profesional"]').css('display','none');

        id_form.find('input[name="jenis_kegiatan_diagnostik"]').removeAttr('required');
        id_form.find('input[name="peran_serta_diagnostik"]').removeAttr('required');
        id_form.find('select[name="jenis_tindakan_operasi"]').removeAttr('required');
        id_form.find('select[name="nama_tindakan_operasi"]').removeAttr('required');
        id_form.find('input[name="jenis_operasi"]').removeAttr('required');
        //id_form.find('input[name="jenis_kasus_bedah"]').removeAttr('required');
        //id_form.find('select[name="jenis_tindakan_bedah"]').removeAttr('required');
        //id_form.find('select[name="nama_tindakan_bedah"]').removeAttr('required');
        id_form.find('input[name="jenis_kasus_rujukan"]').removeAttr('required');
        id_form.find('input[name="tujuan_rujukan"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');
        if (id_form.find('input[name="jenis_kasus_bedah"]').val() == '') {
            id_form.find('input[name="jenis_kasus_bedah"]').val(id_form.find('input[name="nama_kegiatan"]').val());
        }
        id_form.find('input[name="no_rekam_medik"]').removeAttr('required');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        id_form.find('input[name="koordinat"]').removeAttr('required');

        //id_form.find('div[id="div_rs_id"]').css('display','none');
        //id_form.find('select[name="rs_id"]').removeAttr('required');
        break;
        // Kegiatan Rujukan
        case '9':
        id_form.find('div[id="div_jenis_kegiatan_diagnostik"]').css('display','none');
        id_form.find('div[id="div_peran_serta_diagnostik"]').css('display','none');
        id_form.find('div[id="div_jenis_tindakan_operasi"]').css('display','none');
        id_form.find('div[id="div_nama_tindakan_operasi"]').css('display','none');
        id_form.find('div[id="div_jenis_operasi"]').css('display','none');
        id_form.find('div[id="div_jenis_kasus_bedah"]').css('display','none');
        id_form.find('div[id="div_jenis_tindakan_bedah"]').css('display','none');
        id_form.find('div[id="div_nama_tindakan_bedah"]').css('display','none');
        //id_form.find('div[id="div_jenis_kasus_rujukan"]').css('display','none');
        //id_form.find('div[id="div_tujuan_rujukan"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');
        id_form.find('div[id="div_no_rekam_medik"]').css('display','none');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('div[id="div_koordinat"]').css('display','none');
        id_form.find('div[id="div_induk_peta_borang_profesional"]').css('display','none');

        id_form.find('input[name="jenis_kegiatan_diagnostik"]').removeAttr('required');
        id_form.find('input[name="peran_serta_diagnostik"]').removeAttr('required');
        id_form.find('select[name="jenis_tindakan_operasi"]').removeAttr('required');
        id_form.find('select[name="nama_tindakan_operasi"]').removeAttr('required');
        id_form.find('input[name="jenis_operasi"]').removeAttr('required');
        id_form.find('input[name="jenis_kasus_bedah"]').removeAttr('required');
        id_form.find('select[name="jenis_tindakan_bedah"]').removeAttr('required');
        id_form.find('select[name="nama_tindakan_bedah"]').removeAttr('required');
        //id_form.find('input[name="jenis_kasus_rujukan"]').removeAttr('required');
        //id_form.find('input[name="tujuan_rujukan"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');
        if (id_form.find('input[name="jenis_kasus_rujukan"]').val() == '') {
            id_form.find('input[name="jenis_kasus_rujukan"]').val(id_form.find('input[name="nama_kegiatan"]').val());
        }
        id_form.find('input[name="no_rekam_medik"]').removeAttr('required');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        id_form.find('input[name="koordinat"]').removeAttr('required');

        //id_form.find('div[id="div_rs_id"]').css('display','none');
        //id_form.find('select[name="rs_id"]').removeAttr('required');
        break;
        default:
        break;
    }
}

function borang_ranah_pengabdian_masyarakat(form_id) {
    //alert();
    var id_form = $(form_id);
    var jenis_kegiatan_id = id_form.find('input[name="jenis_kegiatan_id"]').val();
    var jenis_kegiatan = id_form.find('input[name="jenis_kegiatan"]').val();
    switch(jenis_kegiatan_id) {
        // Kegiatan Pengabdian Masyarakat
        case '10':
        id_form.find('div[id="div_nama_organisasi_event"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');

        id_form.find('input[name="nama_organisasi_event"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        // Kegiatan Organisasi
        case '11':
        id_form.find('div[id="div_jenis_kegiatan_detail"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');

        id_form.find('input[name="jenis_kegiatan_detail"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        default:
        break;
    }
}

function borang_ranah_publikasi_ilmiah(form_id) {
    //alert();
    var id_form = $(form_id);
    var jenis_kegiatan_id = id_form.find('input[name="jenis_kegiatan_id"]').val();
    var jenis_kegiatan = id_form.find('input[name="jenis_kegiatan"]').val();
    switch(jenis_kegiatan_id) {
        // Kegiatan Publikasi Ilmiah
        case '12':
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');
        
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        default:
        break;
    }
}

function borang_ranah_pengembangaan_ilmu_pendidikan(form_id) {
    //alert();
    var id_form = $(form_id);
    var jenis_kegiatan_id = id_form.find('input[name="jenis_kegiatan_id"]').val();
    var jenis_kegiatan = id_form.find('input[name="jenis_kegiatan"]').val();
    switch(jenis_kegiatan_id) {
        // Kegiatan Penelitian
        case '13':
        id_form.find('div[id="div_judul_matkul"]').css('display','none');
        id_form.find('div[id="div_institusi"]').css('display','none');
        id_form.find('div[id="div_peran_serta"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');

        id_form.find('input[name="judul_matkul"]').removeAttr('required');
        id_form.find('input[name="institusi"]').removeAttr('required');
        id_form.find('input[name="peran_serta"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        // Kegiatan Mengajar, Presentasi, Supervisi
        case '14':
        id_form.find('div[id="div_judul_penelitian"]').css('display','none');
        id_form.find('div[id="div_dipublikasikan_diserahkan_pada"]').css('display','none');
        //id_form.find('div[id="div_nilai_skp"]').css('display','none');
        id_form.find('div[id="div_tahun_periode"]').css('display','none');

        id_form.find('input[name="judul_penelitian"]').removeAttr('required');
        id_form.find('input[name="dipublikasikan_diserahkan_pada"]').removeAttr('required');
        //id_form.find('input[name="nilai_skp"]').removeAttr('required');
        id_form.find('input[name="tahun_periode"]').removeAttr('required');

        id_form.find('div[id="div_rs_id"]').css('display','none');
        id_form.find('select[name="rs_id"]').removeAttr('required');
        id_form.find('div[id="div_lokasi_alamat"]').css('display','none');
        id_form.find('textarea[name="lokasi_alamat"]').removeAttr('required');
        break;
        default:
        break;
    }
}

function halaman_invoce_1(url) {
    window.location.href = url;
}

function simpan_form_bukti_pembayaran_event(token, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/master_event/bukti_pembayaran/simpan';
    var id_form = $('#formBuktiPembayaranEvent');
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('nama_bank', id_form.find('input[name="nama_bank"]').val());
    form_data.append('tgl_bayar', id_form.find('input[name="tgl_bayar"]').val());
    form_data.append('nomor_rekening', id_form.find('input[name="nomor_rekening"]').val());
    form_data.append('nama_pemilik_rekening', id_form.find('input[name="nama_pemilik_rekening"]').val());
    form_data.append('nominal_terbayar', id_form.find('input[name="nominal_terbayar"]').val());
    form_data.append('bukti_bayar', id_form.find('input[name="bukti_bayar"]')[0].files[0]);
    form_data.append('buku_tamu_id', id_form.find('input[name="buku_tamu_id"]').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            //$('#div_tabel_event_saya_member').html(data);
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    if($('#div_tabel_event_saya_member').length){
                        div_tabel_event_saya_member(token, '#div_tabel_event_saya_member');
                    }
                }
            });
        }
    });
}

function simpan_kegiatan_pembelajaran_pribadi(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/kegiatan_pembelajaran_pribadi/simpan';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal', id_form.find('input[name="tanggal"]').val());
    form_data.append('nama_jurnal_situsweb', id_form.find('input[name="nama_jurnal_situsweb"]').val());
    form_data.append('judul_artikel_topik', id_form.find('input[name="judul_artikel_topik"]').val());
    form_data.append('tempat', id_form.find('input[name="tempat"]').val());
    form_data.append('peran_serta', id_form.find('input[name="peran_serta"]').val());
    form_data.append('penyelenggara', id_form.find('input[name="penyelenggara"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());
    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function simpan_pengabdian_masyarakat(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/pengabdian_masyarakat/simpan';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal_mulai', id_form.find('input[name="tanggal_mulai"]').val());
    form_data.append('tanggal_selesai', id_form.find('input[name="tanggal_selesai"]').val());
    form_data.append('jenis_kegiatan_detail', id_form.find('input[name="jenis_kegiatan_detail"]').val());
    form_data.append('nama_organisasi_event', id_form.find('input[name="nama_organisasi_event"]').val());
    form_data.append('jabatan', id_form.find('input[name="jabatan"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());
    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function simpan_pengembangan_ilmu_pendidikan(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/pengembangan_ilmu_pendidikan/simpan';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal', id_form.find('input[name="tanggal"]').val());
    form_data.append('judul_penelitian', id_form.find('input[name="judul_penelitian"]').val());
    form_data.append('ddp', id_form.find('input[name="ddp"]').val());
    form_data.append('ddp_time', id_form.find('input[name="ddp_time"]').val());
    form_data.append('judul_matkul', id_form.find('input[name="judul_matkul"]').val());
    form_data.append('institusi', id_form.find('input[name="institusi"]').val());
    form_data.append('peran_serta', id_form.find('input[name="peran_serta"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());
    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            //$('#div_master_borang').html(data);
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function simpan_profesional(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/profesional/simpan';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal', id_form.find('input[name="tanggal"]').val());
    form_data.append('kode_kegiatan', id_form.find('input[name="kode_kegiatan"]').val());
    form_data.append('jenis_kegiatan_diagnostik', id_form.find('input[name="jenis_kegiatan_diagnostik"]').val());
    form_data.append('peran_serta_diagnostik', id_form.find('input[name="peran_serta_diagnostik"]').val());
    form_data.append('jenis_tindakan_operasi', id_form.find('select[name="jenis_tindakan_operasi"] option:selected').val());
    form_data.append('nama_tindakan_operasi', id_form.find('select[name="nama_tindakan_operasi"] option:selected').val());
    form_data.append('jenis_operasi', id_form.find('input[name="jenis_operasi"]').val());
    form_data.append('jenis_kasus_bedah', id_form.find('input[name="jenis_kasus_bedah"]').val());
    form_data.append('jenis_tindakan_bedah', id_form.find('select[name="jenis_tindakan_bedah"] option:selected').val());
    form_data.append('nama_tindakan_bedah', id_form.find('select[name="nama_tindakan_bedah"] option:selected').val());
    form_data.append('jenis_kasus_rujukan', id_form.find('input[name="jenis_kasus_rujukan"]').val());
    form_data.append('tujuan_rujukan', id_form.find('input[name="tujuan_rujukan"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());

    form_data.append('no_rekam_medik', id_form.find('input[name="no_rekam_medik"]').val());
    form_data.append('lokasi_alamat', id_form.find('textarea[name="lokasi_alamat"]').val());
    form_data.append('koordinat', id_form.find('input[name="koordinat"]').val());

    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function simpan_publikasi_ilmiah(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/publikasi_ilmiah/simpan';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal', id_form.find('input[name="tanggal"]').val());
    form_data.append('judul_artikel', id_form.find('input[name="judul_artikel"]').val());
    form_data.append('nama_buku_jurnal', id_form.find('input[name="nama_buku_jurnal"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());
    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function detail_modal_borang(token, id, rb_id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Detail Data Borang');
    $(modal + 'Isi').html(loading);
    var act = '/member/master_borang/detail';
    $.post(act, {
        _token: token,
        id: id,
        rb_id: rb_id
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function update_modal_borang(token, id, rb_id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Ubah Data Borang');
    $(modal + 'Isi').html(loading);
    var act = '/member/master_borang/ubah';
    $.post(act, {
        _token: token,
        id: id,
        rb_id: rb_id
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function upload_modal_borang_file(token, id, rb_id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Upload File Data Borang');
    $(modal + 'Isi').html(loading);
    var act = '/member/master_borang/upload_file';
    $.post(act, {
        _token: token,
        id: id,
        rb_id: rb_id
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function delete_master_borang(token, id, rb_id) {
    swal({
        title: "Yakin Untuk Menghapus Data Borang?",
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
            var act = '/member/master_borang/delete';
            $.post(act, {
                _token: token,
                id: id,
                rb_id: rb_id
            },
            function (data) {
                //$('#div_master_borang').html(data);
                if (data == "success") {
                    swal({
                        title: "Berhasil Menghapus Borang ",
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "success"
                    },
                    function (isConfirm) {
                        // location.reload();
                        $('#btn_tgl_calendar').click();
                    });
                } else {
                    swal({
                        title: data,
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "error"
                    },
                    function (isConfirm) {
                        
                    });
                }
            });
        }
    });
}

function ubah_kegiatan_pembelajaran_pribadi(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/kegiatan_pembelajaran_pribadi/ubah';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('histori_id', id_form.find('input[name="histori_id"]').val());
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal', id_form.find('input[name="tanggal"]').val());
    form_data.append('nama_jurnal_situsweb', id_form.find('input[name="nama_jurnal_situsweb"]').val());
    form_data.append('judul_artikel_topik', id_form.find('input[name="judul_artikel_topik"]').val());
    form_data.append('tempat', id_form.find('input[name="tempat"]').val());
    form_data.append('peran_serta', id_form.find('input[name="peran_serta"]').val());
    form_data.append('penyelenggara', id_form.find('input[name="penyelenggara"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());
    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            //$('#div_master_borang').html(data);
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function ubah_pengabdian_masyarakat(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/pengabdian_masyarakat/ubah';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('histori_id', id_form.find('input[name="histori_id"]').val());
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal_mulai', id_form.find('input[name="tanggal_mulai"]').val());
    form_data.append('tanggal_selesai', id_form.find('input[name="tanggal_selesai"]').val());
    form_data.append('jenis_kegiatan_detail', id_form.find('input[name="jenis_kegiatan_detail"]').val());
    form_data.append('nama_organisasi_event', id_form.find('input[name="nama_organisasi_event"]').val());
    form_data.append('jabatan', id_form.find('input[name="jabatan"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());
    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function ubah_pengembangan_ilmu_pendidikan(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/pengembangan_ilmu_pendidikan/ubah';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('histori_id', id_form.find('input[name="histori_id"]').val());
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal', id_form.find('input[name="tanggal"]').val());
    form_data.append('judul_penelitian', id_form.find('input[name="judul_penelitian"]').val());
    form_data.append('ddp', id_form.find('input[name="ddp"]').val());
    form_data.append('ddp_time', id_form.find('input[name="ddp_time"]').val());
    form_data.append('judul_matkul', id_form.find('input[name="judul_matkul"]').val());
    form_data.append('institusi', id_form.find('input[name="institusi"]').val());
    form_data.append('peran_serta', id_form.find('input[name="peran_serta"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());
    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            //$('#div_master_borang').html(data);
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function ubah_profesional(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/profesional/ubah';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('histori_id', id_form.find('input[name="histori_id"]').val());
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal', id_form.find('input[name="tanggal"]').val());
    form_data.append('kode_kegiatan', id_form.find('input[name="kode_kegiatan"]').val());
    form_data.append('jenis_kegiatan_diagnostik', id_form.find('input[name="jenis_kegiatan_diagnostik"]').val());
    form_data.append('peran_serta_diagnostik', id_form.find('input[name="peran_serta_diagnostik"]').val());
    form_data.append('jenis_tindakan_operasi', id_form.find('select[name="jenis_tindakan_operasi"] option:selected').val());
    form_data.append('nama_tindakan_operasi', id_form.find('select[name="nama_tindakan_operasi"] option:selected').val());
    form_data.append('jenis_operasi', id_form.find('input[name="jenis_operasi"]').val());
    form_data.append('jenis_kasus_bedah', id_form.find('input[name="jenis_kasus_bedah"]').val());
    form_data.append('jenis_tindakan_bedah', id_form.find('select[name="jenis_tindakan_bedah"] option:selected').val());
    form_data.append('nama_tindakan_bedah', id_form.find('select[name="nama_tindakan_bedah"] option:selected').val());
    form_data.append('jenis_kasus_rujukan', id_form.find('input[name="jenis_kasus_rujukan"]').val());
    form_data.append('tujuan_rujukan', id_form.find('input[name="tujuan_rujukan"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());

    form_data.append('no_rekam_medik', id_form.find('input[name="no_rekam_medik"]').val());
    form_data.append('lokasi_alamat', id_form.find('textarea[name="lokasi_alamat"]').val());
    form_data.append('koordinat', id_form.find('input[name="koordinat"]').val());
    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function ubah_publikasi_ilmiah(token, idForm, idBtn) {
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/master_borang/publikasi_ilmiah/ubah';
    var id_form = $(idForm);
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('histori_id', id_form.find('input[name="histori_id"]').val());
    form_data.append('member_id', id_form.find('input[name="member_id"]').val());
    form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
    form_data.append('ranah_borang', id_form.find('input[name="ranah_borang"]').val());
    form_data.append('jenis_kegiatan_id', id_form.find('input[name="jenis_kegiatan_id"]').val());
    form_data.append('jenis_kegiatan', id_form.find('input[name="jenis_kegiatan"]').val());
    form_data.append('nama_kegiatan_id', id_form.find('input[name="nama_kegiatan_id"]').val());
    form_data.append('nama_kegiatan', id_form.find('input[name="nama_kegiatan"]').val());
    form_data.append('tanggal', id_form.find('input[name="tanggal"]').val());
    form_data.append('judul_artikel', id_form.find('input[name="judul_artikel"]').val());
    form_data.append('nama_buku_jurnal', id_form.find('input[name="nama_buku_jurnal"]').val());
    form_data.append('nilai_skp', id_form.find('select[name="nilai_skp"] option:selected').val());
    //form_data.append('nilai_skp', id_form.find('input[name="nilai_skp"]').val());
    form_data.append('tahun_periode', id_form.find('input[name="tahun_periode"]').val());
    form_data.append('rs_id', id_form.find('select[name="rs_id"] option:selected').val());
    
    $.ajax({
        url: act,
        data: form_data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            swal({
                title: data,
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                    $('.modal').modal('hide');
                    // location.reload();
                    $('#btn_tgl_calendar').click();
                }
            });
        }
    });
}

function ajukan_borang(token, id, rb_id) {
    swal({
        title: "Yakin Untuk Mengajukan Data Borang?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF5722",
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
    },
    function (isConfirm) {
        if (isConfirm) {
            var act = '/member/master_borang/ajukan_borang';
            $.post(act, {
                _token: token,
                id: id,
                rb_id: rb_id
            },
            function (data) {
                if (data == "success") {
                    swal({
                        title: "Berhasil Mengajukan Data Borang ",
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "success"
                    },
                    function (isConfirm) {
                        location.reload();
                    });
                } else {
                    swal({
                        title: data,
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "error"
                    },
                    function (isConfirm) {
                        
                    });
                }
            });
        }
    });
}

function div_data_borang_file(token, div1, idForm) {
    $(div1).html(loading);
    var act = '/member/master_borang/div_data_borang_file';
    var id_form = $(idForm);
    var id = id_form.find('input[name="histori_kegiatan_id"]').val();
    var rb_id = id_form.find('input[name="ranah_borang_id"]').val();
    $.post(act, {
        _token: token,
        id: id,
        rb_id: rb_id
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_borang_file(token, idForm, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/master_borang/simpan_borang_file';
    var id_form = $(idForm);
    if (id_form.find('input[name="path_file"]')[0].files[0].size <= 10000000) {
        var form_data = new FormData();
        form_data.append('_token', token);
        form_data.append('nama', id_form.find('input[name="nama"]').val());
        form_data.append('ranah_borang_id', id_form.find('input[name="ranah_borang_id"]').val());
        form_data.append('histori_kegiatan_id', id_form.find('input[name="histori_kegiatan_id"]').val());
        form_data.append('path_file', id_form.find('input[name="path_file"]')[0].files[0]);
        form_data.append('keterangan', id_form.find('textarea[name="keterangan"]').val());
        $.ajax({
            url: act,
            data: form_data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                //$('#div_data_borang_file').html(data);
                swal({
                    title: data,
                    text: "",
                    confirmButtonColor: "#4CAF50",
                    type: "success"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        l.stop();
                        div_data_borang_file(token, '#div_data_borang_file', '#formBorangFile');
                    }
                });
            }
        });
    } else {
        swal({
            title: "File yang anda inputkan lebih dari 10MB",
            text: "",
            confirmButtonColor: "#4CAF50",
            type: "warning"
        },
        function (isConfirm) {
            if (isConfirm) {
                l.stop();
            }
        });
    }
}

function hapus_borang_file(token, id) {
    swal({
        title: "Yakin Untuk Menghapus Data File Borang?",
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
            var act = '/member/master_borang/hapus_borang_file/'+id;
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
                        div_data_borang_file(token, '#div_data_borang_file', '#formBorangFile');
                    }
                });
            });
        }
    });
}

function simpan_pengajuan_pindah_cabang(token, id_member, idBtn){
    var l = Ladda.create(document.querySelector(idBtn));
    l.start(); 
    var act = '/member/simpan_pengajuan_pindah_cabang';
    var id_form = $('#formPindahCabang');
    // alert(id_form.find('#jenis_file').val());
    if (id_form.find('input[name="pindah_cb_file_name"]')[0].files[0].size <= 10000000) {
        var form_data = new FormData();
        form_data.append('_token', token);
        form_data.append('pindah_cb_file_name', id_form.find('input[name="pindah_cb_file_name"]')[0].files[0]);
        form_data.append('pindah_cb_dari', id_form.find('#pindah_cb_dari').val()); 
        form_data.append('pindah_cb_ke', id_form.find('#pindah_cb_ke').val()); 
        form_data.append('id_member', id_member); 
        // alert(id_form.find('input[name="pindah_cb_file_name"]')[0].files[0].size);
        $.ajax({
            url: act,
            data: form_data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                l.stop();
                if(data == 'success'){
                    swal({
                        title: 'Data berhasil disimpan',
                        text: "",
                        confirmButtonColor: "#4CAF50",
                        type: "success"
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            l.start();
                            location.reload();
                            //alertKu('success', data); 
                        }
                    });
                } else {
                    alertKu('warning', data);
                }
            }
        });
    } else {
        l.stop();
        swal({
            title: "File yang anda inputkan lebih dari 10MB",
            text: "",
            confirmButtonColor: "#4CAF50",
            type: "warning"
        },
        function (isConfirm) {
            if (isConfirm) {
                l.stop();
            }
        });
    }

}

function admin_cabang_by_admin_pusat(token, idForm){
    var act = '/member/master_admin/admin_cabang_by_admin_pusat';
    var id_form = $(idForm);
    var admin_pusat_id = id_form.find('select[name="admin_pusat_id"] option:selected').val();
    // alert(admin_pusat_id);
    $.post(act, {
        _token: token,
        admin_pusat_id: admin_pusat_id
    },
    function (data) {
        // alertKu('warning', data);
        id_form.find('select[name="admin_cabang_id"]').html(data);
        $('.select22').select2();
    });
}

function verif_modal_borang(token, id, rb_id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Verifikasi Data Borang');
    $(modal + 'Isi').html(loading);
    var act = '/admin/master_borang/verifikasi_cabang';
    $.post(act, {
        _token: token,
        id: id,
        rb_id: rb_id
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function div_tabel_pengajuan_pindah_cabang_belum_verif1(token, div1) {
    $(div1).html(loading);
    var act = '/admin/pengajuan_pindah_cabang/div_tabel_pengajuan_pindah_cabang_belum_verif1';
    var id_form = $('#formFilterDataPengajuanPindahCabangMemberBelumVerif1');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cab_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_pengajuan_pindah_cabang_sudah_verif1(token, div1) {
    $(div1).html(loading);
    var act = '/admin/pengajuan_pindah_cabang/div_tabel_pengajuan_pindah_cabang_sudah_verif1';
    var id_form = $('#formFilterDataPengajuanPindahCabangMemberSudahVerif1');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cab_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_pengajuan_pindah_cabang_belum_verif2(token, div1) {
    $(div1).html(loading);
    var act = '/admin/pengajuan_pindah_cabang/div_tabel_pengajuan_pindah_cabang_belum_verif2';
    var id_form = $('#formFilterDataPengajuanPindahCabangMemberBelumVerif2');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cab_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_pengajuan_pindah_cabang_sudah_verif2(token, div1) {
    $(div1).html(loading);
    var act = '/admin/pengajuan_pindah_cabang/div_tabel_pengajuan_pindah_cabang_sudah_verif2';
    var id_form = $('#formFilterDataPengajuanPindahCabangMemberSudahVerif2');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cab_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function modal_detail_verif_pindah_cabang(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Detail Data Pengajuan Pindah Cabang');
    $(modal + 'Isi').html(loading);
    var act = '/admin/pengajuan_pindah_cabang/detail';
    $.post(act, {
        _token: token,
        id: id
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function modal_verif_pindah_cabang1(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Verifikasi Data Pengajuan Pindah Cabang Lama');
    $(modal + 'Isi').html(loading);
    var act = '/admin/pengajuan_pindah_cabang/verifikasi_cabang_lama';
    $.post(act, {
        _token: token,
        id: id
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function modal_verif_pindah_cabang2(token, id, member_id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Verifikasi Data Pengajuan Pindah Cabang Baru');
    $(modal + 'Isi').html(loading);
    var act = '/admin/pengajuan_pindah_cabang/verifikasi_cabang_baru';
    $.post(act, {
        _token: token,
        id: id,
        member_id: member_id 
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function div_tabel_kredit_poin(token, div1, div2) {
    $(div1).html(loading);
    $(div2).html(loading);

    var act = '/member/kredit_poin/div_tabel_kredit_poin';
    var act2 = '/member/kredit_poin/div_tabel_per_member';

    var id_form = $('#formFilterLaporanKreditPoin');

    $.post(act, {
        _token: token,
        member_id: id_form.find('select[name="member_id"] option:selected').val(),
        tgl_awal: id_form.find('input[name="tgl_awal"]').val(),
        tgl_akhir: id_form.find('input[name="tgl_akhir"]').val(),
        laporan: id_form.find('select[name="laporan"] option:selected').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });

    $.post(act2, {
        _token: token,
        member_id: id_form.find('select[name="member_id"] option:selected').val(),
        tgl_awal: id_form.find('input[name="tgl_awal"]').val(),
        tgl_akhir: id_form.find('input[name="tgl_akhir"]').val(),
        laporan: id_form.find('select[name="laporan"] option:selected').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data2) {
        $(div2).html(data2);
    });
}

function div_periode_poin_member(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_periode_poin_member';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_div_periode_poin_member(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_div_periode_poin_member';
    var id_form = $('#formDivPeriodePoinMember');
    $.post(act, {
        _token: token,
        tahun_periode_awal: id_form.find('input[name="tahun_periode_awal"]').val(),
        tahun_periode_akhir: id_form.find('input[name="tahun_periode_akhir"]').val(),
        min_poin: id_form.find('input[name="min_poin"]').val()
    },
    function (data) {
        if (data == 'success') {
            swal({
                title: 'Periode dan Minimal Poin Member Sudah Disimpan',
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                }
            });
        } else {
            swal({
                title: 'Hubungi Pihak Develop',
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "error"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                }
            });
        }
    });
}

function isa_data_bank_admin(form_id, nama_cbo) {
    var id_form = $(form_id);
    var nama_bank = id_form.find('select[name="'+nama_cbo+'"] option:selected').attr('bank');
    var no_rek = id_form.find('select[name="'+nama_cbo+'"] option:selected').attr('rekening');
    var pemilik_rek = id_form.find('select[name="'+nama_cbo+'"] option:selected').attr('pemilik');
    
    id_form.find('input[name="nama_bank"]').val(nama_bank);
    id_form.find('input[name="no_rek"]').val(no_rek);
    id_form.find('input[name="pemilik_rek"]').val(pemilik_rek);
}

function cek_ikut_serta_event_induk(token, id, id_event_induk, member_id) {
    var act = '/member/master_event/cek_ikut_serta_event_induk';
    $.post(act, {
        _token: token,
        numpang_simposium_event_id: id_event_induk,
        member_id: member_id
    },
    function (data) {
        if (data == 'ada') {
            modal_daftar_event(token, id, '#ModalGreenSm');
        } else {
            alertKu('warning', 'Anda tidak bisa mendaftar, karena anda tidak mengikuti event induk dari event ini.');
        }
    });
}

function div_tabel_expired_pembayaran_pusat(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_event/div_tabel_expired_pembayaran_pusat';
    var id_form = $('#formFilterDataExpiredPembayaranEventPusat');
    $.post(act, {
        _token: token,
        event_id: id_form.find('select[name="event_id"] option:selected').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_expired_pembayaran_cabang(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_event/div_tabel_expired_pembayaran_cabang';
    var id_form = $('#formFilterDataExpiredPembayaranEventCabang');
    $.post(act, {
        _token: token,
        event_id: id_form.find('select[name="event_id"] option:selected').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function set_status_bayar_menunggu_bayar(token, id, status_bayar_param) {  
    var status_bayar = 3;
    if($(status_bayar_param).is(':checked')){
        status_bayar = 0;
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
            var act = '/admin/master_event/set_status_bayar_menunggu_bayar/' + id;
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
                        $('.btn_tampilkan').click(); 
                    }
                });
            });
        } else { 
            $(status_bayar_param).click(); 
        }
    });
}

function generate_kode_nomor_pabi_sejahtera(form_id) {
    var form_id = $(form_id);
    var t1 = form_id.find('select[name="kode_wilayah"] option:selected').val();
    var t2 = form_id.find('select[name="kode_kota"] option:selected').val();
    var t3 = form_id.find('select[name="kode_bulan"] option:selected').val();
    var t4 = form_id.find('input[name="kode_tahun"]').val().substring(2, 5);
    var t5 = form_id.find('input[name="no_urut"]').val();
    var semua = t1+'-'+t2+'-'+t3+'-'+t4+'-'+t5;
    form_id.find('input[name="no_pabi_sejahtera"]').val(semua);
}

function div_nomor_pabi_sejahtera(token, div1, id) {
    $(div1).html(loading);
    var act = '/member/keanggotaan/' + id + '/div_nomor_pabi_sejahtera';
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_div_nomor_pabi_sejahtera(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/' + id + '/edit/simpan_div_nomor_pabi_sejahtera';
    var id_form = $('#formDivNomorPABISejahtera');
    $.post(act, {
        _token: token,
        no_pabi_sejahtera: id_form.find('input[name="no_pabi_sejahtera"]').val(),
        bulan: id_form.find('select[name="kode_bulan"] option:selected').val(),
        tahun: id_form.find('input[name="kode_tahun"]').val()
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
            }
        });
    });
}

function div_data_harga_event(token, div1, id, harga_event_id) {
    $(div1).html(loading);
    if (harga_event_id == 0) {
        var act = '/admin/master_event/' + id + '/div_tambah_data_harga_event';
    } else {
        var act = '/admin/master_event/' + harga_event_id + '/div_ubah_data_harga_event';
    }
    $.post(act, {
        _token: token
    },
    function (data) {
        $(div1).html(data);
    });
}

function simpan_form_modal_ubah_harga_event(token, id, idBtn, event_harga_id) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/admin/master_event/' + event_harga_id + '/simpan_harga_event_ubah';
    var id_form = $('#formModalUbahHargaEvent'); 
    $.post(act, {
        _token: token,
        kategori: id_form.find('input[name="kategori"]').val(),
        harga: id_form.find('input[name="harga"]').val(),
        kuota_peserta: id_form.find('input[name="kuota_peserta"]').val()
    },
    function (data) {
        l.stop();
        if (data == "success") {
            swal({
                title: "Berhasil Mengubah Harga Event ",
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    div_tabel_data_harga_event(token, '#div_tabel_data_harga_event', id);
                    div_data_harga_event(token, '#div_data_harga_event', id, '0');
                }
            });
        } else {
            alertKu('warning', data);
        }
    });
}

function isa_data_akun_rumah_sakit(form_id, nama_cbo) {
    var id_form = $(form_id);
    var nama_bank = id_form.find('select[name="'+nama_cbo+'"] option:selected').attr('adpu');
    
    id_form.find('input[name="admin_pusat_id"]').val(nama_bank);
}

function edit_modal_akun_rs(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Ubah Data Akun Rumah Sakit');
    $(modal + 'Isi').html(loading);
    var act = '/admin/edit_modal_akun_rs/'+id;
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function reset_password_rs(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Ubah Password Rumah Sakit');
    $(modal + 'Isi').html(loading);
    var act = '/admin/reset_password_rs/'+id;
    $.post(act, {
        _token: token
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function div_tabel_borang_belum_verif_rs(token, div1) {
    $(div1).html(loading);
    var act = '/rumah-sakit/master_borang/div_tabel_borang_belum_verif';
    var id_form = $('#formFilterDataBorangRumahSakitBelumVerif');
    $.post(act, {
        _token: token,
        rs_id: id_form.find('select[name="rs_id"] option:selected').val(),
        //admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        ranah_borang_id: id_form.find('select[name="borang"] option:selected').val(),
        jenis_kegiatan_id: id_form.find('select[name="jenis_kegiatan"] option:selected').val(),
        kegiatan_id: id_form.find('select[name="nama_kegiatan"] option:selected').val(),
        nama_member: id_form.find('input[name="nama_member"]').val(),
        tgl_borang_awal: id_form.find('input[name="tgl_borang_awal"]').val(),
        tgl_borang_akhir: id_form.find('input[name="tgl_borang_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_borang_sudah_verif_rs(token, div1) {
    $(div1).html(loading);
    var act = '/rumah-sakit/master_borang/div_tabel_borang_sudah_verif';
    var id_form = $('#formFilterDataBorangRumahSakitSudahVerif');
    $.post(act, {
        _token: token,
        rs_id: id_form.find('select[name="rs_id"] option:selected').val(),
        //admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        ranah_borang_id: id_form.find('select[name="borang"] option:selected').val(),
        jenis_kegiatan_id: id_form.find('select[name="jenis_kegiatan"] option:selected').val(),
        kegiatan_id: id_form.find('select[name="nama_kegiatan"] option:selected').val(),
        nama_member: id_form.find('input[name="nama_member"]').val(),
        tgl_borang_awal: id_form.find('input[name="tgl_borang_awal"]').val(),
        tgl_borang_akhir: id_form.find('input[name="tgl_borang_akhir"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function verif_modal_borang_rs(token, id, rb_id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Verifikasi Data Borang');
    $(modal + 'Isi').html(loading);
    var act = '/rumah-sakit/master_borang/verifikasi';
    $.post(act, {
        _token: token,
        id: id,
        rb_id: rb_id
    },
    function (data) {
        $(modal + 'Isi').html(data);
    });
}

function div_tabel_member_inactive_cabang(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_member/div_tabel_member_inactive_cabang';
    var id_form = $('#formFilterDataMemberAdminCabangInactive');
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cab_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function div_tabel_member_inactive_pusat(token, div1) {
    $(div1).html(loading);
    var act = '/admin/master_member/div_tabel_member_inactive_pusat';
    var id_form = $('#formFilterDataMemberAdminPusatInactive');
    $.post(act, {
        _token: token,
        admin_pusat_id: id_form.find('select[name="admin_pst_id"] option:selected').val(),
        admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        name_member: id_form.find('input[name="name_member"]').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function tindakan_by_jenis_tindakan(token, form_id, target) {
    if (target == 'operasi') {
        var act = '/member/master_borang/tindakan_by_jenis_tindakan';
        var id_form = $(form_id);
        var jenis_tindakan = id_form.find('select[name="jenis_tindakan_operasi"] option:selected').val();

        id_form.find('select[name="nama_tindakan_operasi"]').html('<option value="">loading...</option>');
        $.post(act, {
            _token: token,
            jenis_tindakan: jenis_tindakan
        },
        function (data) {
            id_form.find('select[name="nama_tindakan_operasi"]').html('<option value="">-- Pilih Tindakan Operasi --</option>'+data);
            $('.select22').select2();
        });
    } else {
        var act = '/member/master_borang/tindakan_by_jenis_tindakan';
        var id_form = $(form_id);
        var jenis_tindakan = id_form.find('select[name="jenis_tindakan_bedah"] option:selected').val();

        id_form.find('select[name="nama_tindakan_bedah"]').html('<option value="">loading...</option>');
        $.post(act, {
            _token: token,
            jenis_tindakan: jenis_tindakan
        },
        function (data) {
            id_form.find('select[name="nama_tindakan_bedah"]').html('<option value="">-- Pilih Tindakan Bedah --</option>'+data);
            $('.select22').select2();
        });
    }
}

function add_div_periode_poin_member(token, id, idBtn) {
    var l = Ladda.create( document.querySelector(idBtn) );
    l.start(); 
    var act = '/member/myprofilemember/add_div_periode_poin_member';
    var id_form = $('#formAddDivPeriodePoinMember');
    $.post(act, {
        _token: token,
        member_id: id_form.find('input[name="member_id"]').val(),
        tahun_periode_awal: id_form.find('input[name="tahun_periode_awal"]').val(),
        tahun_periode_akhir: id_form.find('input[name="tahun_periode_akhir"]').val(),
        min_poin: id_form.find('input[name="min_poin"]').val()
    },
    function (data) {
        if (data == 'success') {
            swal({
                title: 'Periode dan Minimal Poin Member Sudah Disimpan',
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "success"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                }
            });
        } else {
            swal({
                title: 'Hubungi Pihak Develop',
                text: "",
                confirmButtonColor: "#4CAF50",
                type: "error"
            },
            function (isConfirm) {
                if (isConfirm) {
                    l.stop();
                }
            });
        }
    });
}
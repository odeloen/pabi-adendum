var loading = `<div class="text-center"> 
                    <div class="pace-demo">
                        <div class="theme_squares"><div class="pace-progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                    </div> 
                </div>`;


// START contoh ------------------------------------------------------
function tambah_modal_contoh(token, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Tambah Contoh');
    $(modal + 'Isi').html(loading);
    var act = '/contoh/tambah';
    $.post(act, {
            _token: token
        },
        function (data) {
            //alert(data);
            $(modal + 'Isi').html(data);
        });
}

function update_modal_contoh(token, id, modal) {
    $(modal).modal('show');
    $(modal + 'Label').html('Ubah Contoh');
    $(modal + 'Isi').html(loading);
    var act = '/contoh/' + id + '/ubah';
    $.post(act, {
            _token: token
        },
        function (data) {
            //alert(data);
            $(modal + 'Isi').html(data);
        });
}

function delete_contoh(token, id) {

    swal({
            title: "Yakin Untuk Menghapus Data Contoh?",
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
                var act = '/contoh/' + id + '/hapus';
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

// END contoh ------------------------------------------------------

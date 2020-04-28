var loading = "please wait...";
//"<center><img class=\"img-fluid\" src=\"{{asset('assets_member/images/loader.gif')}}\" alt=\"doctor-foto\"></center>";

function div_public_tabel_master_dokter(token, div1) {
    $(div1).html(loading);
    var act = '/master_dokter/div_public_tabel_master_dokter';
    var id_form = $('#formFilterMasterDokterHalamanAwal');
    // alert(id_form.find('input[name="limit"]').val());
    $.post(act, {
        _token: token,
        admin_cabang_id: id_form.find('select[name="admin_cabang_id"] option:selected').val(),
        nama_dokter: id_form.find('input[name="nama_dokter"]').val(),
        minat_bidang_id: id_form.find('select[name="minat_bidang_id"] option:selected').val(),
        limit: id_form.find('input[name="limit"]').val()
    },
    function (data) {
        $(div1).html(data);
    });
}

function detail_per_dokter(token, id, modal, nama_dokter) { 
    var act = '/identitas_dokter/'+nama_dokter;
    $.post(act, {
        _token: token,
        member_id: id
    } 
    );
}
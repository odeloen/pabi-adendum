@extends('Ods\Core::template.master')


@section('content')
<div class="col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading panel-indigo">
            <h6 class="panel-title">Announcement</h6>
        </div>

        <div class="panel-body">
            <div class="text-right mt-10">
                <button class="btn bg-primary" data-toggle="modal" data-target="#modal_add">Tambah Announcement</button>
            </div>
            <div class="content-group mt-10">
                
                <table class="table datatable-basic table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Judul</th>
                            <th class="text-center" width="15%">Tanggal</th>
                            <th class="text-center" width="10%"></th>
                            <th class="text-center" width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hasil rapat besar pengurus PABI</td>
                            <td class="text-center">12 Januari 2020</td>
                            <td class="text-center">
                                <button type="button" class="btn bg-teal-800" data-toggle="modal" data-target="#modal_detail"><span>Lihat Detail</span></button>
                            </td>
                            <td>
                                <button type="button" class="btn bg-info" data-toggle="modal" data-target="#modal_update" style="width: 90px; margin:2px;"><span>Ubah</span></button>
                                <button type="button" class="btn bg-danger"  style="width: 90px;margin:2px;"><span>Hapus</span></button>
                            </td>
                        </tr>

                    </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<div id="modal_add" class="modal fade" tabindex="-1" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Buat Announcement</h5>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Judul Announcement</h6>
                                <textarea name="description" class="form-control maxlength-textarea" autocomplete="off" maxLength="250" rows="2" style="resize:vertical"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Isi Announcement</h6>
                                <textarea rows="10" class="form-control" style="resize: vertical"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Lampiran Foto untuk Announcement</h6>
                                <input id="announcement_photo" type="hidden">
                                <div class="form-group" style="margin-left:1%; margin-right:1%">
                                    <div>
                                        <center><input type="file" class="file-styled" accept="image/*" id="imgInp" style=" max-height:250px;width:auto;" autocomplete="off"></center>
                                        <img id="upload" src="" alt="" style="width:100%; margin-top:10px;"/>
                                    </div>
                                    <img id="result" width="100%" style="margin-top:1%;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="modal_update" class="modal fade" tabindex="-1" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Ubah Announcement</h5>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Judul Announcement</h6>
                                <textarea name="description" class="form-control maxlength-textarea" autocomplete="off" maxLength="250" rows="2" style="resize:vertical"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Isi Announcement</h6>
                                <textarea rows="10" class="form-control" style="resize: vertical"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Lampiran Foto untuk Announcement</h6>
                                <input id="announcement_photo" type="hidden">
                                <div class="form-group" style="margin-left:1%; margin-right:1%">
                                    <div>
                                        <center><input type="file" class="file-styled" accept="image/*" id="imgInp" style=" max-height:250px;width:auto;" autocomplete="off"></center>
                                        <img id="upload" src="" alt="" style="width:100%; margin-top:10px;"/>
                                    </div>
                                    <img id="result" width="100%" style="margin-top:1%;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('addjs')
<!-- Theme JS files -->
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/autosize.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/maxlength.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<!-- /theme JS files -->
<script>
    // START SCRIPT TABEL
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: false,
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Cari:</span>',
            lengthMenu: '<span>Menampilkan :</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
            emptyTable: '<span>Tidak ada data untuk ditampilkan</span>',
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            zeroRecords:"Tidak ditemukan data yang sesuai",
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    $('.datatable-basic').DataTable({
        "order":[[1,'desc']],
        "columnDefs": [
            { "orderable": false, "targets": [2,3] },
        ]
    });

    document.addEventListener('DOMContentLoaded', function() {

        // Default file input style
        $(".file-styled").uniform({
            fileButtonClass: 'action btn btn-default'
        });


        // Primary file input
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    });
    //code for autoresize textarea
    var ta = document.querySelectorAll('textarea');
    autosize(ta);

    // Dispatch a 'autosize:update' event to trigger a resize:
    var evt = document.createEvent('Event');
    evt.initEvent('autosize:update', true, false);

    for (i = 0; i < ta.length; ++i) {
        ta[i].dispatchEvent(evt);
    }
    //end code

    //code for maxlength in textarea
    $('.maxlength-textarea').maxlength({
        threshold: 250,
        warningClass: "label label-primary",
        limitReachedClass: "label label-danger"
    });
    //end code

    //Fungsi pada Upload Foto
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#result').attr('src', e.target.result);
                document.getElementById("upload").style.display = "none";
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });
    //END
</script>
@endsection
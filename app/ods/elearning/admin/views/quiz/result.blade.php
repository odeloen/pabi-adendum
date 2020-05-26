@extends('Ods\Core::template.master')

@section('content')
<div class="col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading panel-indigo">
            <h6 class="panel-title">Hasil Kuis</h6>
        </div>

        <div class="panel-body">
            <div class="content-group mt-10">
                
                <table class="table datatable-basic datatable-all table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No PABI Sejahtera</th>
                            <th class="text-center" >Nama</th>
                            <th class="text-center">Nilai Tertinggi yang Diraih</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:20%;">131231</td>
                            <td class="text-center">Twingky Gans</td>
                            <td class="text-center" style="width:20%;">90</td>
                            <td class="text-center" style="width:20%">
                                <button type="button" class="btn bg-indigo-300" data-toggle="modal" data-target="#modal_record"><span>Lihat Rekam Nilai</span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="modal_record" class="modal fade" tabindex="-1" style="overflow-y: auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-indigo-300">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Rekam Nilai</h5>
            </div>

            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-3"><label class="text-semibold">Nama:</label></div>
                    <div class="col-lg-9"><span>Victoria Anna Davidson</span></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"><label class="text-semibold">No PABI:</label></div>
                    <div class="col-lg-9"><span>1231231231</span></div>
                </div>
                <table class="table datatable-basic datatable-one table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Tanggal Pengerjaan</th>
                            <th class="text-center" >Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td >12 desember 2011</td>
                            <td class="text-center">100</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addjs')
<!-- Theme JS files -->
<script src="{{asset('template/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
<!-- /theme JS files -->
<script>
    // START SCRIPT TABEL
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Cari:</span>',
            lengthMenu: '<span>Menampilkan :</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
            emptyTable: '<span>Tidak ada data untuk ditampilkan</span>',
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            zeroRecords:"Tidak ditemukan data yang sesuai",
        }
    });
    $('.datatable-all').DataTable({
        "order":[[1,'desc']],
        "columnDefs": [
            { "orderable": false, "targets": [3] },
        ],
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        buttons: {
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                {
                    extend: 'excel',
                    exportOptions : {
                        columns: [ 0,1,2 ]
                    },
                    title: 'PABI Nilai Kuis',
                },
                {
                    extend: 'pdf',
                    exportOptions : {
                        columns: [ 0,1,2 ]
                    },
                    title: 'PABI Nilai Kuis',
                },
                {
                    extend: 'print',
                    exportOptions : {
                        columns: [ 0,1,2 ]
                    },
                    title: 'PABI Nilai Kuis',
                }
            ]
        }
    });
    
    $('.datatable-one').DataTable({
        "searching": false,
    });

</script>
@endsection
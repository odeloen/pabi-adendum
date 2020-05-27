@extends('Ods\Core::template.master')

@section('content')
<div class="col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading panel-indigo">
            <h6 class="panel-title">Hasil Kuis</h6>
        </div>

        <div class="panel-body">
            <div class="content-group mt-10">

                <table class="table datatable-all table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Tanggal Ambil Tes</th>
                            <th class="text-center">No PABI Sejahtera</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Nama Kelas</th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quiz_histories as $quiz_history)
                            <tr>
                                <td style="width: 15%">{{$quiz_history->started_at_string}}</td>
                                <td style="width: 15%">{{$quiz_history->member->pabi_sejahtera}}</td>
                                <td class="text-center">{{$quiz_history->member->fullname}}</td>
                                <td style="width:20%;">{{$quiz_history->course->name}} oleh {{$quiz_history->course->lecturer->fullname}}</td>
                                <td class="text-center" style="width: 15%">{{$quiz_history->score}}</td>
                                <td class="text-center" style="width: 15%">
                                    @if($quiz_history->verdict == 1)
                                        Lulus
                                    @else
                                        Tidak Lulus
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        columnDefs: [{
            orderable: true,
            width: '100px'
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
                    title: 'PABI Nilai Kuis',
                },
                {
                    extend: 'pdf',
                    title: 'PABI Nilai Kuis',
                },
                {
                    extend: 'print',
                    title: 'PABI Nilai Kuis',
                }
            ]
        }
    });

</script>
@endsection

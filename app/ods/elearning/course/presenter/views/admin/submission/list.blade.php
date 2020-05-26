
@extends('Ods\Core::template.master')

@section('addcss')
<style>
    .content-group{
        margin-top: 20px;
    }
    .thumbnail:hover{
        margin-top: -7px;
        -moz-box-shadow:    0 0 20px #b4abab;
        -webkit-box-shadow: 0 0 20px #b4abab;
        box-shadow:         0 0 20px #b4abab;
    }
</style>
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading panel-indigo">
        <h6 class="panel-title">Pengajuan</h6>

    </div>

    <div class="panel-body">
        <table class="table datatable-basic table-hover table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th style="width:20%" ><center>Tanggal</center></th>
                    <th><center>Kode Unik</center></th>
                    <th><center>Nama Kelas</center></th>
                    <th><center>Ringkasan Pengajuan</center></th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($submissions as $submission)
                    <tr>
                        <td>{{$submission->created_at}}</td>
                        <td>{{$submission->created_at_string}}</td>
                        <td style="width:1%;whitespace:nowrap;">{{$submission->unique_code}}</td>
                        <td>
                            "{{$submission->name}}"<br>
                            oleh <b> {{$submission->lecturer->fullname}} </b>
                        </td>
                        <td>
                            {{$submission->summary}}
                        </td>
                        <td class="text-center" style="width:1%;whitespace:nowrap;">
                            <a href="{{route('admin.submission.show', $submission->id)}}">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_detail"><span>Lihat Detail</span></button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('addjs')
<!-- Theme JS files -->

<script src="{{asset('template/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<!-- /theme JS files -->
<script>
// START SCRIPT TABEL
$.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: true,
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
        "columnDefs":[
            {
                "targets" : [0],
                "visible" : false,
            },
            { "orderable": false, "targets": [0,1,2,3,4,5] },
        ],
        "order":[[0,'desc']],
    });
    // END SCRIPT TABEL
</script>
@endsection

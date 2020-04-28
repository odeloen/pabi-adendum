
@extends('Ods\Core::template.master')
<?php Carbon\Carbon::setLocale('id')?>

@section('need_sidebar')
<div hidden="hidden">{{$need_sidebar="1"}}</div>
@endsection

@section('addcss')
<style>

    /*table.dataTable {
        border-color: aqua !important;
    }*/
    thead {
             position: absolute !important;
             top: -9999px !important;
             left: -9999px !important;
    }

    .dataTables_filter input { width: 400px; }

</style>
@endsection
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading panel-indigo"></div>
    <div class="panel-body">

        <h3 class="text-center content-group-lg">
            Selamat Datang di Pembelajaran Online PABI
        </h3>
        <table class="table datatable-basic table-hover">
            <tbody>
                @if (!empty($materials))
                    @foreach ($materials as $material)
                    <tr class="clickable-row" href="{{route('general.article.show', $material->instance->id)}}" style="cursor:pointer;">
                        <td style="width:1%;white-space:nowrap;"><i class="icon-file-text2"></i></td>
                        <td>{{$material->instance->name}}</td>
                        <td class="text-right" style="width:1%;white-space:nowrap;">Diperbarui {{$material->instance->created_at_string}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script type="text/javascript">
    // START SCRIPT TABEL
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: true,
            searchable:true,
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span">Cari:</span>',
            lengthMenu: '<span>Menampilkan :</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    $('.datatable-basic').DataTable({
        "order":[[1,'asc']],
        "columnDefs": [
            { "orderable": false, "targets": [0,1,2] },
            {"searchable": false, "targets": [0,2] },
        ],
        "paging":false,
        "info":false,
    });

    // END SCRIPT TABEL
    document.addEventListener('DOMContentLoaded', function() {
            $(".clickable-row").on('click', function() {
                    url = $(this).attr('href');
                    window.open(url, '_blank');
            });

        });
</script>
@endsection


@extends('Ods\Core::template.master')
<?php Carbon\Carbon::setLocale('id')?>
@section('addcss')
<style>
    .content-group{
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="page-header page-header-inverse">
    <div class="page-header-content bg-indigo">
        <div class="page-title">
            <h5>
                <span class="text-semibold">Pengajuan</span>
            </h5>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading bg-indigo">
        <h6 class="panel-title">Histori Pengajuan<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <div class="text-right mt-10">
            <button class="btn bg-pink" data-toggle="modal" data-target="#modal_submission">Buat Pengajuan Baru</button>
        </div>
        <div class="content-group">
            <table class="table datatable-basic datatable-histori table-bordered table-striped">
				<thead>
					<tr>
                        <th>Waktu</th>
                        <th>Kode Unik</th>
                        <th>Ringkasan Pengajuan</th>
                        <th>Status</th>
                        <th>Detail</th>
					</tr>
				</thead>
			    <tbody>
                    @if (!empty($submissions))
                        @foreach ($submissions as $submission)
                        <tr>
                            <td style="width:1%;whitespace:nowrap;">{{$submission->instance->created_at}}</td>
                            <td>{{$submission->instance->unique_code}}</td>
                            <td>
                                {{$submission->instance->summary}}
                            </td>
                            <td style="width:1%;whitespace:nowrap;">
                                <center>
                                    {!!$submission->instance->getStatusTag()!!}
                                </center>
                            </td><td style="width:1%;whitespace:nowrap;">
                                <a href="{{route('lecturer.submission.show', [$course->instance->id, $submission->instance->id])}}"><button type="button" class="btn btn-default"><span>Lihat Detail</span></button></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
				</tbody>
            </table>
        </div>
    </div>
</div>
<div id="modal_comment" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-grey-600">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Detail Penolakan</h5>
            </div>

            <form action="#">
                <div class="modal-body">
                    <div class="content-group">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="font-size:13px;">
                                <thead>
                                    <td style="width:25%"><strong>Perubahan</strong></td>
                                    <td ><strong>Komentar</strong></td>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Perubahan Materi A</td>
                                        <td>Materi tidak valid</td>
                                    </tr>
                                    <tr>
                                        <td>Perubahan Materi A</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if (!empty($course))
<div id="modal_submission" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-pink">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Pengajuan Baru</h5>
            </div>
            <?php $today = Carbon\Carbon::today()->format('d F Y')?>
            <form action="{{route('lecturer.submission.create')}}" method="POST">
                @csrf
                <input type="hidden" name="course_id" value="{{$course->instance->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                Tanggal
                                <input value="{{$today}}" type="text" class="form-control" id="today-date" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                Kelas
                                <input value="{{$course->instance->name}}" type="text" class="form-control" placeholder="Bedah Jantung" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">

                            Ringkasan Pengajuan
                            <textarea name="summary" class="form-control" rows="1" id="test" style="resize:vertical;"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn bg-pink">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="modal_detail" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header bg-teal">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Detail Pengajuan</h5>
            </div>

            <div class="modal-body">

                <div class="content-group">
                    <table class="table datatable-basic datatable-detail table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Detail</th>
                                <th style="width:25px;">Terjadi Perubahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mengubah Informasi Kelas</td>
                                <td><i class="icon-checkmark4"></i></td>
                            </tr>

                            <tr>
                                <td>Mengubah Materi X</td>
                                <td><i class="icon-checkmark4"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('addjs')
<!-- Theme JS files -->
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/autosize.min.js')}}"></script>
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
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    $('.datatable-histori').DataTable({
        "order":[[0,'desc']],
        "columnDefs": [
            { "orderable": false, "targets": [1,2,3,4,5] },
        ]
    });
    $('.datatable-detail').DataTable({
    });
    // END SCRIPT TABEL
    // var today = new Date();
    // var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    // document.getElementById('today-date').value=date;
    // document.getElementById("today-date").readOnly = true;


    //code for autoresize textarea
    var ta = document.querySelector('textarea');

    autosize(ta);

    // Dispatch a 'autosize:update' event to trigger a resize:
    var evt = document.createEvent('Event');
    evt.initEvent('autosize:update', true, false);
    ta.dispatchEvent(evt);
    //end code
</script>
@endsection

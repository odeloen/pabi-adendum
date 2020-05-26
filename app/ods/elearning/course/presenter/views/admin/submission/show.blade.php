
@extends('Ods\Core::template.master')

@section('addcss')
<style>
    .content-group{
        margin-top: 20px;
    }
    .table tr:first-child td{
		border-top: none;
	}
    .table-responsive{
        border:none;
    }
</style>
@endsection
@section('two_sidebar')
<div hidden="hidden">{{$two_sidebar="1"}}</div>
@endsection
@section('content')
@if (!empty($course->topics))
    <div class="page-header page-header-inverse">
        <div class="page-header-content bg-indigo">
            <div class="page-title">
                <h5 class="text-semibold">
                    {{$course->instance->name}}
                </h5>
                <h5 class="text-right">
                    Kode Pengajuan: #{{$course->instance->unique_code}}
                </h5>
            </div>
        </div>
    </div>
    @if ($course->instance->isDeleted())
        <div class="alert alert-warning alert-styled-left">
            Pembuat kelas ingin menutup kelas
        </div>
    @endif
    @foreach ($course->topics as $topic)
        <div class="panel">
            @if (!empty($topic->instance->modifier))
            <div class="panel-heading bg-grey-300">
            @else
            <div class="panel-heading bg-indigo">
            @endif
                <h6 class="panel-title">{{$topic->instance->name}}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                @if ($topic->instance->isModified())
                    {!!$topic->instance->getActionTag()!!}
                @endif
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div style="text-align:justify;">
                    {{$topic->instance->description}}
                </div>
                @if($topic->materials->count() > 0)
                    <div class="text-right mt-5">
                @else
                    <div class="text-center mt-5">
                @endif
                </div>
                <div class="content-group mt-15">
                    <div class="table-responsive">
                        <table class="table table-hover" style="font-size:13px;">
                            <tbody>
                                @foreach ($topic->materials as $material)
                                <tr class="clickable-row" href="{{route('admin.material.show', [$course->instance->id, $topic->instance->id, $material->instance->id])}}"style="cursor:pointer;">
                                    <td class="clickable" style="width:1%;white-space:nowrap;"><i class="{{$material->type->icon}}"></i></td>
                                    <td class="clickable">{{$material->instance->name}}</td>
                                    <td class="clickable" style="width:1%;white-space:nowrap;">
                                        <center>
                                            @if ($material->instance->isModified())
                                                {!!$material->instance->getActionTag()!!}
                                            @endif
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
<div id="modal_commentClass" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger-700">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Alasan Penolakan Pengajuan</h5>
            </div>

            <form action="{{route('admin.submission.decline')}}" method="POST">
                @csrf
                <input type="hidden" name="submitted_course_id" value="{{$course->instance->id}}">
                <div class="modal-body">
                    <div class="form-group" style="margin-left:1%; margin-right:1%">
                        <textarea name="comment" class="form-control" rows="1" id="test" placeholder="Alasan penolakan informasi kelas" style="resize:vertical;"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-danger-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('sidebar-right')
@if (!empty($course))
    <form id="accept_submission_form" action="{{route('admin.submission.accept')}}" method="post">
        @csrf
        <input type="hidden" name="submitted_course_id" value="{{$course->instance->id}}">
    </form>

<div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
    <div class="sidebar-content">
        <button onclick="sendAcceptSubmissionForm()" type="button" class="btn bg-primary-700 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;">
            <i class="icon-checkmark4"></i><span>Terima</span>
        </button>
        <button type="button" class="btn bg-danger-700 btn-float btn-float-lg tutup-kelas" style="width:100%; margin-bottom: 10px;" data-toggle="modal" data-target="#modal_commentClass">
            <i class="icon-cross2"></i> <span>Tolak</span>
        </button>

        <div class="thumbnail">
            <div class="thumb">
                @if (!empty($course->instance->image_path != null))
                    <img src="{{env('APP_URL')}}/sl/images/{{$course->instance->image_path}}" class="img-responsive img-rounded" alt="">
                @else
                    <img src="{{asset('template/global_assets/images/placeholders/placeholder.jpg')}}" class="img-responsive img-rounded" alt="">
                @endif
            </div>

            <div class="caption">
                <div class="content-group-sm media">
                    <div class="media-body">
                        <h6 class="text-semibold no-margin">{{$course->instance->name}}</h6>
                        <ul class="list-inline list-inline-separate no-margin text-muted">
                            <li>oleh <span class="text-primary">{{$lecturer->fullname}}</span></li>
                            <li>
                                {{-- @if (!empty($course->categories))
                                    @foreach ($course->categories as $category)
                                        <span class="badge bg-grey">{{$category->name}}</span>
                                    @endforeach
                                @endif --}}
                            </li>
                        </ul>
                    </div>
                </div>

                <div style="text-align: justify; word-wrap: break-word;">
                    {{$course->instance->description}}
                </div>
            </div>
            <div class="panel-footer panel-footer-transparent">
                <div class="heading-elements">
                    <ul class="list-inline list-inline-separate heading-text">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('addjs')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(".clickable-row").on('click', function() {
            if($(event.target).hasClass("clickable")){
                url = $(this).attr('href');
                window.open(url, '_blank');
            }
        });
    });

    function sendAcceptSubmissionForm(){
        swal({
            title: 'Apakah anda yakin?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya'
        },
        function (isConfirm) {
            if (isConfirm) {
                $('#accept_submission_form').submit()
            }
        });
    }
</script>
@endsection

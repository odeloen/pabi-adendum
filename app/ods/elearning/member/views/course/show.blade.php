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
@if (!empty($course))
    <div class="page-header page-header-inverse">
        <div class="page-header-content bg-indigo">
            <div class="page-title">
                <h5 class="text-semibold">
                    {{$course->instance->name}}
                </h5>
            </div>
        </div>
    </div>
    @foreach ($course->topics as $topic)
        <div class="panel">
            <div class="panel-heading bg-indigo">
                <h6 class="panel-title">{{$topic->instance->name}}</h6>

            </div>

            <div class="panel-body">
                <div style="text-align:justify;">
                    {{$topic->instance->description}}
                </div>
                <div class="content-group mt-15">
                    <div class="table-responsive">
                        <table class="table table-hover" style="font-size:13px;">
                            <tbody>
                                @foreach ($topic->materials as $material)
                                    <tr class="clickable-row" href="{{route('member.material.show', [$course->instance->id, $topic->instance->id, $material->instance->id])}}" style="cursor:pointer;">
                                        <td style="width:1%;white-space:nowrap;"><i class="{{$material->type->icon}}"></i></td>
                                        <td>{{$material->instance->name}}</td>
                                        <td class="text-right" style="width:1%;white-space:nowrap;">Diperbarui {{$material->instance->created_at_string}}</td>
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
@endsection

@section('sidebar-right')
@if (!empty($course))
    <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
        <div class="sidebar-content">
        
            <a href="">
                <button type="button" class="btn bg-indigo-800 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;" data-toggle="modal" data-target="#modal_form_horizontal">
                    <i class="icon-graduation2 "></i> <span>Ujian Kelas</span>
                </button>
            </a>
            <form action="{{route('member.course.unfollow')}}" method="post">
                @csrf
                <input type="hidden" name="course_id" value="{{$course->instance->id}}">
                <button type="submit" class="btn bg-warning-800 btn-float btn-float-lg berhenti-mengikuti" style="width:100%; margin-bottom: 10px;">
                    <i class="icon-stop"></i> <span>Berhenti Mengikuti</span>
                </button>
            </form>
            <div class="thumbnail">
                <div class="thumb">
                    <img src="{{asset('template/global_assets/images/placeholders/placeholder.jpg')}}" class="img-responsive img-rounded" alt="">
                </div>

                <div class="caption">
                    <div class="content-group-sm media">
                        <div class="media-body">
                            <h6 class="text-semibold no-margin">{{$course->instance->name}}</h6>
                            <ul class="list-inline list-inline-separate no-margin text-muted">
                                <li>oleh <span class="text-primary">{{$lecturer->fullname}}</span></li></li>
                                <li>diperbarui <span style="color: #3F51B5">{{$course->instance->updated_at_string}}</span> </li>
                                <li>
                                    {{-- @foreach ($course->categories as $category)
                                        <span class="badge bg-grey">{{$category->name}}</span>
                                    @endforeach --}}
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
    let courseName = "{!!$course->instance->name!!}"
    $('.berhenti-mengikuti').on('click', function(event){
        event.preventDefault()

        var form = $(this).parent('form')
        swal({
            title: 'Apakah anda ingin berhenti mengikuti Kelas '+ courseName +'?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya'
        },
        function (isConfirm) {
            if (isConfirm) {
                form.submit()
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        $(".clickable-row").on('click', function() {
                url = $(this).attr('href');
                window.open(url, '_blank');
        });

    });
</script>
@endsection

@extends('Ods\Core::template.master')

@section('addcss')
<style>
    .blog-horizontal:hover{
        margin-top: -7px;
        -moz-box-shadow:    0 0 20px #b4abab;
        -webkit-box-shadow: 0 0 20px #b4abab;
        box-shadow:         0 0 20px #b4abab;
    }
</style>
@endsection

@section('two_sidebar')
<div hidden="hidden">{{$two_sidebar="1"}}</div>
@endsection

@section('breadcrumbs')
<li class="active text-grey">Kelas yang diikuti</li>
@endsection

@section('content')
<?php $i = 0 ?>
@if (!empty($courses))
    @foreach ($courses as $course)
        @if ($i % 2 == 0)
        <div class="row">
        @endif
        <form id="{{$course->instance->id}}" action="{{route('member.course.follow')}}" method="post">
            @csrf
            <input type="hidden" name="course_id" value="{{$course->instance->id}}">
            <div class="col-lg-6">
                <a href="{{route('member.course.show', $course->instance->id)}}" style="text-decoration:none;color:inherit;">
                <div class="panel panel-flat blog-horizontal blog-horizontal-2" style="cursor:pointer;">

                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="thumb">
                                @if (!empty($course->instance->image_path != null))
                                    <img src="{{env('APP_URL')}}/sl/images/{{$course->instance->image_path}}" class="img-responsive img-rounded" alt="">
                                @else
                                    <img src="{{asset('template/global_assets/images/placeholders/placeholder.jpg')}}" class="img-responsive img-rounded" alt="">
                                @endif
                            </div>

                            <div class="blog-preview">
                                <div class="content-group-sm media blog-title stack-media-on-mobile text-left">
                                    <div class="media-body">
                                        <h5 class="text-semibold no-margin">{{$course->instance->name}}</h5>

                                        <ul class="list-inline list-inline-separate no-margin text-muted">
                                            <li>oleh <span class="text-primary">{{$course->lecturer->fullname}}</span></li></li>
                                            <li>diperbarui <span style="color: #3F51B5">{{$course->instance->getUpdatedAt()}}</span> </li>
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
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="blog-preview" style=" word-wrap: break-word; min-height:60px;">
                                {{$course->instance->description}}
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements">
                            <a href="{{route('member.course.show', $course->instance->id)}}" class="heading-text pull-right">Lihat
                                Kelas <i class="icon-arrow-right14 position-right"></i></a>
                        </div>
                    </div>
                </div>
                </a>

            </div>
        </form>
        @if ($i % 2 == 1)
        </div>
        @endif
        <?php $i++ ?>
    @endforeach
    @if ($i % 2 == 1)
    </div>
    @endif
@endif
@endsection

@section('sidebar-right')
{{-- <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
    <div class="sidebar-content">

        <!-- Filter -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>Cari Kelas</span>
                <ul class="icons-list">
                    <li><a href="#" data-action="collapse"></a></li>
                </ul>
            </div>

            <div class="category-content">
                <form action="#">

                    <div class="form-group">
                        <legend class="text-size-mini text-muted no-border no-padding">Kategori</legend>

                        <div class="checkbox">
                            <label class="display-block">
                                <div class="checker"><span><input type="checkbox" class="styled"></span></div>
                                Development
                                <span class="text-muted">(83)</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="display-block">
                                <div class="checker"><span><input type="checkbox" class="styled"></span></div>
                                Design
                                <span class="text-muted">(92)</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="display-block">
                                <div class="checker"><span><input type="checkbox" class="styled"></span></div>
                                Management
                                <span class="text-muted">(36)</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="display-block">
                                <div class="checker"><span><input type="checkbox" class="styled"></span></div>
                                Finances
                                <span class="text-muted">(50)</span>
                            </label>
                        </div>
                    </div>

                    <a href="#" class="btn bg-blue btn-block legitRipple">Filter</a>
                </form>
            </div>
        </div>
        <!-- /filter -->
    </div>
</div> --}}
@endsection
@section('addjs')
<script src="{{asset('template/global_assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function iconFormat(icon) {
            var originalOption = icon.element;
            if (!icon.id) { return icon.text; }
            var $icon = "<i class='icon-" + $(icon.element).data('icon') + "'></i>" + icon.text;

            return $icon;
        }
        $(".select-icons").select2({
            templateResult: iconFormat,
            minimumResultsForSearch: Infinity,
            templateSelection: iconFormat,
            escapeMarkup: function(m) { return m; }
        });
    });

    //PENGENNYA MAKE QUESTION T_T tp gamau
    $('.ikuti').on('click', function(){
        swal({
            title: 'Apakah anda ingin mengikuti Kelas Bedah Jantung?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya'
        },
        function (isConfirm) {
            if (isConfirm) {

            }
        });
    });
</script>
@endsection

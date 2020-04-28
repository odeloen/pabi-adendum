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
<li class="active text-grey">Cari Kelas</li>
@endsection

@section('content')
<div class="panel">
    <div class="panel-body">
        <h4 class="text-center content-group-lg">
            Selamat Datang di Pembelajaran Online PABI
        </h4>
        <form action="#" class="main-search">
            <div class="input-group content-group">
                <div class="has-feedback has-feedback-left">
                    <input id="query" type="text" class="form-control input-xlg" placeholder="Pencarian">
                    <div class="form-control-feedback" style="margin-top:15px">
                        <i class="icon-search4 text-muted text-size-base"></i>
                    </div>
                </div>

                <div class="input-group-btn">
                    <button onclick="sendSearchQueryForm()" type="submit" class="btn btn-primary btn-xlg legitRipple">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="courses">
<?php $i = 0 ?>
{{-- @if (!empty($courses))
    @foreach ($courses as $course)
        @if ($i % 2 == 0)
        <div class="row">
        @endif
        <form id="{{$course->instance->id}}" action="{{route('member.course.follow')}}" method="post">
            @csrf
            <input type="hidden" name="course_id" value="{{$course->instance->id}}">
            <div class="col-lg-6" onclick="sendFollowForm('{{$course->instance->id}}','{{$course->instance->name}}')">
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
                                            <li>diperbarui<span style="color: #3F51B5">1 November 2019</span> </li>
                                            <li>
                                                @if (!empty($course->categories))
                                                    @foreach ($course->categories as $category)
                                                        <span class="badge bg-grey">{{$category->name}}</span>
                                                    @endforeach
                                                @endif
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
            </div>
        </form>
        @if ($i % 2 == 1)
        </div>
        @endif

    @endforeach
    @if ($i % 2 == 1)
    </div>
    @endif
@endif --}}
</div>
@endsection

@section('addjs')
<script src="{{asset('template/global_assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script>
    let followURL = "{{route('member.course.follow')}}"

    let followedCourses = {!! $courses !!}

    var csrf_js_var = "{{ csrf_token() }}"

    var base_url = {!! json_encode(url('/')) !!}

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

    function getFollowedCourse(courseID){
        if (followedCourses == null) return null;

        var course = null
        console.log("courseID " + courseID)

        for (i=0;i<followedCourses.length;i++){
            console.log("Followed ID " + followedCourses[i].instance.id)
            if (String(courseID).localeCompare(String(followedCourses[i].instance.id)) == 0){
                console.log("Hore")
                course = followedCourses[i]
                break
            }
        }
        console.log("course " + course)

        return course
    }

    function sendFollowForm(courseID, courseName){
        var form = $("#"+courseID)

        var course = getFollowedCourse(courseID)
        if (course != null) {
            console.log("kelas ditemukan")
            location.replace("{{env('APP_URL')}}/elearning/member/courses/"+courseID)
            return
        }

        swal({
            title: 'Apakah anda ingin mengikuti Kelas '+ courseName +'?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya'
        },
        function (isConfirm) {
            if (isConfirm) {
                console.log(form)
                form.submit();
            }
        });
    }

    function sendSearchQueryForm(){
        var div = $("#courses")
        div.empty()

        var query = $("#query").val()
        console.log(query)
        $.ajax({
            url: "{{route('api.member.course.search')}}",
            type: "get",
            data: {
                query: query,
            },
            success: function(response) {
                // console.log(response)
                console.log(response.data.courses)
                var courses = response.data.courses

                var it = 0
                Object.keys(courses).forEach(function(key) {
                    course = courses[key]
                    console.log(course)
                    var imageLink = course.instance.image_path
                    if (imageLink == null) {
                        imageLink = "{{asset('template/global_assets/images/placeholders/placeholder.jpg')}}"
                    } else {
                        imageLink = "{{env('APP_URL')}}/sl/images/" + imageLink
                    }
                    it++
                    if (it % 2 == 1) div.append('<div class="row">')
                    div.append('\
                        <form id="'+course.instance.id+'" action="'+followURL+'" method="post">\
                            <input name="_token" value="'+csrf_js_var+'" type="hidden">\
                            <input type="hidden" name="course_id" value="'+course.instance.id+'">\
                            <div class="col-lg-6" onclick="sendFollowForm(\''+course.instance.id+'\',\''+course.instance.name+'\')">\
                                <div class="panel panel-flat blog-horizontal blog-horizontal-2">\
                                    <div class="panel-body">\
                                        <div class="col-lg-12">\
                                            <div class="thumb">\
                                                <img src="'+imageLink+'" class="img-responsive img-rounded" alt="">\
                                            </div>\
                                            <div class="blog-preview">\
                                                <div class="content-group-sm media blog-title stack-media-on-mobile text-left">\
                                                    <div class="media-body">\
                                                        <h5 class="text-semibold no-margin">'+course.instance.name+'</h5>\
                                                        <ul class="list-inline list-inline-separate no-margin text-muted">\
                                                            <li>oleh <span class="text-primary">'+course.lecturer.fullname+'</span></li></li>\
                                                            <li>diperbarui <span style="color: #3F51B5">'+course.instance.updated_at_string+'</span> </li>\
                                                            <li>\
                                                            </li>\
                                                        </ul>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                        <div class="col-lg-12">\
                                            <div class="blog-preview" style=" word-wrap: break-word; min-height:60px;">\
                                                '+course.instance.description+'\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="panel-footer panel-footer-condensed">\
                                        <div class="heading-elements">\
                                            <a href="#" class="heading-text pull-right">Lihat\
                                                Kelas <i class="icon-arrow-right14 position-right"></i></a>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </form>\
                    ')
                });
                if (it % 2 == 0) div.append('</div>')
            },
            error: function(xhr) {
                console.log(xhr)
            }
        });
    }

    $(document).ready(function(){

    })
</script>
@endsection

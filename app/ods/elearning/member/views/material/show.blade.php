
@extends('Ods\Core::template.master')

@section('addcss')
<style>
    .content-group{
        margin-top: 20px;
    }
</style>

@endsection

@section('content')
@if (!empty($material))
    <div class="panel panel-flat border-top-xlg border-top-indigo">
        <div class="panel-heading" style="margin-bottom:-10px">
            <h5 class="panel-title"><span class="text-semibold">{{$material->instance->name}}</h5>
            oleh <span class="text-primary">{{$lecturer->fullname}}</span>
            <br>
            terbit <span style="color: #3F51B5">{{$material->instance->updated_at_string}}</span>
            <br>
            dari Kelas {{$course->instance->name}}, Topik {{$topic->instance->name}}
            <br>
        </div>
        <hr>

        @include('Ods\Elearning\Core::materials.partials.'.$material->type->view)
    </div>
@endif
@endsection

@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script>
    //code for via post
    // Setup
    CKEDITOR.replace('editor-full', {
        height: 400,
        extraPlugins: 'forms'
    });
    //end code

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
</script>
@endsection

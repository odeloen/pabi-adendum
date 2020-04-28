
@extends('Ods\Core::template.master')
@section('addcss')
<style>
    .content-group{
        margin-top: 20px;
    }
</style>

@endsection

@section('content')
@if (!empty($course))
<div class="panel panel-flat border-top-xlg border-top-indigo">
    <div class="panel-heading" style="margin-bottom:-10px">
        <h5 class="panel-title"><span class="text-semibold">{{$material->instance->name}}</h5>
        oleh <span class="text-primary">{{$lecturer->fullname}}</span>
        <br>
        dari Kelas {{$course->instance->name}}, Topik {{$topic->instance->name}}
        <br>
        <span style="font-style:italic">Materi ini bersifat
            @if ($material->isPublic())
                umum
            @else
                tidak umum
            @endif
        </span>
    </div>
    <hr>
    @include('Ods\Elearning\Core::materials.partials.'.$material->type->view)
</div>
@endif
@endsection

@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/autosize.min.js')}}"></script>
<script>
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

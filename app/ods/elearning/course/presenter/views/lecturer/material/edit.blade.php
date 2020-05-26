
@extends('Ods\Core::template.master')
<?php
/**
 * @var \App\Ods\Elearning\Course\Presenter\Models\MaterialDetailViewModel $data
 */
?>
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
                Topik Bedah Jantung - Kelas Bedah Jantung
            </h5>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-heading bg-indigo">
        <h6 class="panel-title">Edit Materi<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
    </div>
    <form action="{{route('elearning.lecturer.material.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <input type="hidden" name="course_id" value="{{$data->course->id}}">
        <input type="hidden" name="material_id" value="{{$data->material->id}}">
        <input type="hidden" name="type" value="{{$data->material->type}}">
        <div class="panel-body">
            <div class="row form-group">
                <label class="control-label col-sm-3"><strong>Judul Materi</strong></label>
                <div class="col-sm-9">
                    <input name="name" value="{{$data->material->name}}" type="text" placeholder="Judul Materi" class="form-control">
                </div>
            </div>
            <!-- kalo dia jenisnya post-->
            <div class="row form-group">
                <label class="control-label col-sm-3"><strong>Aksesbilitas Materi</strong></label>
                <div class="col-sm-12">
                    <label class="checkbox-inline">
                        <input name="public_checked" type="checkbox" class="styled"
                        @if ($data->material->isPublic())
                            checked
                        @endif
                        >
                        Dapat diakses umum
                    </label>
                    <span class="help-block">Apabila materi dapat diakses oleh umum, materi dapat diakses oleh pengunjung halaman PABI, baik dokter anggota ataupun tidak</span>
                </div>
            </div>
            <!-- end-->

            @include('Ods\Elearning\Lecturer::material.partials.'.$data->material->getView().'-edit')
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Simpan Materi</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/autosize.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {

        // Default file input style
        $(".file-styled").uniform({
            fileButtonClass: 'action btn btn-default'
        });


        // Primary file input
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
            // Checkboxes and radios
        $(".styled").uniform({
            wrapperClass: "border-indigo text-indigo-600"
        });
    });
    //code for autoresize textarea
    var ta = document.getElementsByClassName('textarea');

    autosize(ta);

    // Dispatch a 'autosize:update' event to trigger a resize:
    var evt = document.createEvent('Event');
    evt.initEvent('autosize:update', true, false);
    //end code
</script>
@endsection

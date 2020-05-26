
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
                @if (!empty($data->course))
                    {{$data->topic->name}} - {{$data->course->name}}
                @endif
            </h5>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading bg-indigo">
        <h6 class="panel-title">Tambah Materi<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
    </div>
    <form action="{{route('elearning.lecturer.material.store')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        @csrf
        <input id="create_material_type" name="type" type="hidden" value="PostMaterial">
        @if (!empty($data->course))
            <input name="course_id" type="hidden" value="{{$data->course->id}}">
        @endif
        @if (!empty($data->topic))
            <input name="topic_id" type="hidden" value="{{$data->topic->id}}">
        @endif
        <div class="panel-body">
            <div class="content-group">
                <div class="row form-group">
                    <label class="control-label col-sm-3"><strong>Judul Materi</strong></label>
                    <div class="col-sm-9">
                        <input name="name" type="text" placeholder="Judul Materi" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-3"><strong>Aksesbilitas Materi</strong></label>
                    <div class="col-sm-12">
                        <label class="checkbox-inline">
                            <input name="public_checked" type="checkbox" class="styled" >
                            Dapat diakses umum
                        </label>
                        <span class="help-block">Apabila materi dapat diakses oleh umum, materi dapat diakses oleh pengunjung halaman PABI, baik dokter anggota ataupun tidak</span>
                    </div>
                </div>
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
                    <li class="active"><a href="#bottom-justified-tab1" onclick="setType('PostMaterial')" data-toggle="tab">Post</a></li>
                    <li><a href="#bottom-justified-tab2" onclick="setType('FileMaterial')" data-toggle="tab">File PDF</a></li>
                    <li><a href="#bottom-justified-tab3" onclick="setType('VideoMaterial')" data-toggle="tab">Video</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="bottom-justified-tab1">
                        <div class="content-group">
                            <textarea name="post_content" id="editor-full" rows="4" cols="4">
                            </textarea>
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-justified-tab2">
                        <div class="form-group">
                            <label class="control-label col-lg-2">File</label>
                            <div class="col-lg-10">
                                <input name="file_content" type="file" class="file-styled" accept="application/pdf">
                                <span class="help-block">Hanya menerima file pdf, ukuran maksimal 15MB</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Keterangan Tambahan</label>
                            <div class="col-md-10">
                                <textarea name="file_description" class="textarea form-control" rows="1" style="resize:vertical;"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="bottom-justified-tab3">
                        <div class="form-group">
                            <label class="control-label col-md-2">URL</label>
                            <div class="col-md-10">
                                <input name="video_content" class="form-control" type="url">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Keterangan Tambahan</label>
                            <div class="col-md-10">
                                <textarea name="video_description" class="textarea form-control" rows="1" style="resize:vertical;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Buat Materi</button>
                    </div>
                </div>
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
    $(document).ready(function(){
        setType('PostMaterial')
    })

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

    function setType(type){
        $('#create_material_type').val(type)
    }
</script>
@endsection

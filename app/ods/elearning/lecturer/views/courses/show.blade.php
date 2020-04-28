
@extends('Ods\Core::template.master')
@section('addcss')
<link href="{{asset('template/croppie/croppie.css')}}" rel="stylesheet" type="text/css">
<style>
	.table tr:first-child td{
		border-top: none;
	}
    .table-responsive{
        border:none;
    }
    #upload-demo{
        width: 250px;
        height: 250px;
        padding-bottom:25px;
    }
    span.text-primary-700{
        color:black !important;
    }span.text-primary-700:hover{
        color:black !important;
    }
    .border-primary{
        border-color:#ddd;
    }
    .astext {
        background:none;
        border:none;
        margin:0;
        width: 100%;
        padding:8px 16px;
        text-align: left;
        cursor: pointer;
    }
    .astext:hover{
        background-color:#F5F5F5;
    }
</style>
@endsection
@section('two_sidebar')
<div hidden="hidden">{{$two_sidebar="1"}}</div>
@endsection
@section('content')
<div class="page-header page-header-inverse">
    <div class="page-header-content bg-indigo">
        <div class="page-title">
            <h5>
                Kelola Kelas
            </h5>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

        <div class="heading-elements">

        </div>
    </div>
</div>
@if (!empty($course))
    @if ($course->isLocked())
        <div class="alert alert-warning alert-styled-left">
            Kelas ini sedang dalam proses verifikasi admin.
        </div>
    @endif
    @if ($course->isLocked() && $course->instance->isDeleted())
        <div class="alert alert-danger alert-styled-left">
            Kelas ini sedang dalam proses penutupan.
        </div>
    @endif
    @if (!$course->isLocked() && $course->instance->isModified())
        <div class="alert alpha-grey-600 border-grey alert-styled-left">
            Ada perubahan yang belum diverifikasi oleh admin. <span class="text-semibold">Silahkan membuat pengajuan</span>.
        </div>
    @endif
@endif
@if (!empty($course->topics))
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
                        <li class="dropdown" style="margin-right:5px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-cog5"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a onclick="onClickUpdateTopic('{{$topic->instance->id}}')" data-toggle="modal" data-target="#modal_topicEdit">Edit Topik</a></li>
                                <li>
                                    <form action="{{route('lecturer.topic.delete')}}" method="post">
                                        @csrf
                                        <input name="topic_id" value="{{$topic->instance->id}}" type="hidden">
                                        <button type="submit" class="astext hapus-topik" value="{{$topic->instance->id}}">Hapus Topik</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
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
                    <a href="{{route('lecturer.material.create', [$course->instance->id, $topic->instance->id])}}">
                        <button type="submit" class="btn bg-pink"><i class="icon-plus22"></i>Tambah Materi</button>
                    </a>
                </div>
                <div class="content-group mt-15">
                    <div class="table-responsive">
                        <table class="table table-hover" style="font-size:13px;">
                            <tbody>
                                @foreach ($topic->materials as $material)
                                <tr class="clickable-row" href="{{route('lecturer.material.show', [$course->instance->id, $topic->instance->id, $material->instance->id])}}"style="cursor:pointer;">
                                    <td class="clickable" style="width:1%;white-space:nowrap;"><i class="{{$material->type->icon}}"></i></td>
                                    <td class="clickable">{{$material->instance->name}}</td>
                                    <td class="clickable" style="width:1%;white-space:nowrap;">
                                        <center>
                                            @if ($material->instance->isModified())
                                                {!!$material->instance->getActionTag()!!}
                                            @else
                                                {{$material->instance->updated_at_string}}
                                            @endif
                                        </center>
                                    </td>
                                    <td style="width:1%;white-space:nowrap;" >
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-more2"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="{{route('lecturer.material.edit', [$course->instance->id, $topic->instance->id, $material->instance->id])}}">Edit Materi</a></li>
                                                    <li>
                                                        <form action="{{route('lecturer.material.delete')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="course_id" value="{{$course->instance->id}}">
                                                            <input type="hidden" name="material_id" value="{{$material->instance->id}}">
                                                            <button type="submit" class="astext hapus-materi">Hapus Materi</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
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
@if (!empty($course))
<div id="modal_topicAdd" class="modal fade" tabindex="-1" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title">Tambah Topik</h5>
            </div>

            <form action="{{route('lecturer.topic.create')}}" method="POST">
                @csrf
                <input type="hidden" name="course_id" value="{{$course->instance->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                Judul Topik
                                <input name="name" type="text" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Deskripsi</h6>
                                <textarea name="description" autocomplete="off"class="form-control maxlength-textarea" maxLength="250" rows="2" style="resize:vertical"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-primary">Tambah Topik</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="modal_topicEdit" class="modal fade" tabindex="-1" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title">Edit Topik</h5>
            </div>

            <form action="{{route('lecturer.topic.update')}}" method="POST">
                @csrf
                <input id="update_topic_id" name="topic_id" type="hidden">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                Judul Topik
                                <input id="update_topic_name" name="name" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Deskripsi</h6>
                                <textarea id="update_topic_description" name="description" class="form-control maxlength-textarea" maxLength="250" rows="3" style="resize:vertical"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="modal_classEdit" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Ubah Informasi Kelas</h5>
            </div>

            <form action="{{route('lecturer.course.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" value="{{$course->instance->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Nama Kelas</h6>
                                <input name="name" type="text" class="form-control" value="{{$course->instance->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Foto Kelas</h6>
                                <input name="image" type="file" class="file-styled item-img file center-block " accept="image/*"/>
                                <figure class="text-center">
                                    <img class="gambar img-responsive img-thumbnail" id="item-img-output" src="{{env('APP_URL')}}/sl/images/{{$course->instance->image_path}}" style="max-height:300px;width:auto;"/>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Deskripsi</h6>
                                <textarea name="description" class="form-control maxlength-textarea" maxLength="250" rows="2" style="resize:vertical">{{$course->instance->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <h6>Topik Terkait</h6>
                        <select name="categories[]" data-placeholder="Pilih topik terkait" multiple="multiple" class="select-border-color border-warning">
                            <option></option>
                            @if (!empty($categories))
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div> --}}

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="modal_comment" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Alasan Penolakan</h5>
            </div>

            <form action="#">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <blockquote style="border-left:10px solid #777777; background:#eeeeee;">
                                    <p>Bukti terlampir tidak valid</p>
                                </blockquote>
                            </div>
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
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('sidebar-right')
@if (!empty($course))
<div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
    <div class="sidebar-content">
        <button type="button" class="btn bg-primary btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;" data-toggle="modal" data-target="#modal_topicAdd">
            <i class="icon-plus22"></i><span>Tambah Topik</span>
        </button>
        <a href="{{route('lecturer.submission.list', $course->instance->id)}}">
            <button type="button" class="btn bg-pink btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;" data-toggle="modal" data-target="#modal_form_horizontal">
                <i class="icon-check"></i> <span>Pengajuan</span>
            </button>
        </a>
        <button type="button" class="btn bg-teal btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;" data-toggle="modal" data-target="#modal_classEdit">
            <i class="icon-quill4"></i><span>Ubah Informasi Kelas</span>
        </button>
        <button type="button" class="btn bg-grey-800 btn-float btn-float-lg tutup-kelas" style="width:100%; margin-bottom: 10px;">
            <i class="icon-trash"></i> <span>Tutup Kelas</span>
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

                <div style="text-align: justify;  word-wrap: break-word;">
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
<form id="form_course_delete" action="{{route('lecturer.course.delete')}}" method="POST">
    @csrf
    <input type="hidden" name="course_id" value="{{$course->instance->id}}">
</form>
@endif
@endsection

@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/autosize.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/maxlength.min.js')}}"></script>
<script src="{{asset('template/croppie/croppie.js')}}"></script>
<script src="{{asset('template/global_assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
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

        $(".clickable-row").on('click', function() {
            if($(event.target).hasClass("clickable")){
                url = $(this).attr('href');
                window.open(url, '_blank');
            }
        });

    });
    //code for autoresize textarea
    var ta = document.querySelector('textarea');

    autosize(ta);

    // Dispatch a 'autosize:update' event to trigger a resize:
    var evt = document.createEvent('Event');
    evt.initEvent('autosize:update', true, false);
    ta.dispatchEvent(evt);
    //end code

    //code for photo in form
    var $uploadCrop,
    tempFilename,
    rawImg,
	imageId;
    function readFile(input) {
	    if (input.files && input.files[0]) {
		    var reader = new FileReader();
			reader.onload = function (e) {
			    $('.upload-demo').addClass('ready');
				$('#cropImagePop').modal('show');
                rawImg = e.target.result;
			}
			reader.readAsDataURL(input.files[0]);
		}
		else {
		    swal("Maaf broser anda tidak mensupport FileReader API");
		}
	}

	$uploadCrop = $('#upload-demo').croppie({
		viewport: {
			width: 200,
			height: 200,
		},
		enforceBoundary: false,
		enableExif: true
	});
	$('#cropImagePop').on('shown.bs.modal', function(){
		// alert('Shown pop');
		$uploadCrop.croppie('bind', {
			url: rawImg
		}).then(function(){
			console.log('jQuery bind complete');
		});
	});

	$('.item-img').on('change', function () {
        imageId = $(this).data('id'); tempFilename = $(this).val();
	    $('#cancelCropBtn').data('id', imageId);
        readFile(this);
    });
	$('#cropImageBtn').on('click', function (ev) {
            $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            size: {width: 200, height: 200}
        }).then(function (resp) {
            $('#item-img-output').attr('src', resp);
            $('#cropImagePop').modal('hide');
        })
	});
	// End code

    //code for maxlength in textarea
    $('.maxlength-textarea').maxlength({
        threshold: 250,
        warningClass: "label label-primary",
        limitReachedClass: "label label-danger"
    });
    //end code
    //code for topik terkait in form
    $('.select-border-color').select2({
        dropdownCssClass: 'border-primary',
        containerCssClass: 'border-primary text-primary-700',
        minimumResultsForSearch: 0
    });
    //end code

    //code swal
    $('.tutup-kelas').on('click', function(){
        var form = $('#form_course_delete')

        swal({
            title: 'Apakah anda yakin akan menutup Kelas {{$course->instance->name}}?',
            text: 'Topik dan Materi yang pernah anda buat akan menghilang',
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

    $('.hapus-topik').on('click', function(e){
        e.preventDefault()

        var topicID = $(this).val()
        var topic = getTopic(topicID)

        if (topic == null) return
        var form = $(this).parent('form')

        swal({
            title: 'Apakah anda yakin akan menghapus Topik '+topic.instance.name+'?',
            text: 'Semua materi dalam Topik '+topic.instance.name+' yang pernah anda buat akan menghilang',
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

    $('.hapus-materi').on('click', function(){
        e.preventDefault()

        var form = $(this).parent('form')

        swal({
            title: 'Apakah anda yakin akan menghapus materi?',
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
    //end code

    //code for dropdown
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "auto" );
    })
    //endcode
</script>
@if (!empty($course))
<script>
    let topics = {!!$course->topics!!}

    $(document).ready(function(){
        var length= 0;
        for(var key in topics) {
            if(topics.hasOwnProperty(key)){
                length++;
            }
        }
        topics.length = length
    })

    function getTopic(topicID){
        var topic = null
        for (i=0;i<topics.length;i++){
            if (topics[i].instance.id === topicID){
                topic = topics[i]
                break
            }
        }
        console.log(topic)

        return topic
    }

    function onClickUpdateTopic(topicID){
        console.log(topicID)
        var topic = getTopic(topicID)

        if (topic == null) return
        setUpdateTopicModal(topic)
    }

    function setUpdateTopicModal(topic){
        $('#update_topic_id').val(topic.instance.id)
        $("#update_topic_name").val(topic.instance.name)
        $("#update_topic_description").text(topic.instance.description)
    }

    function onClickDeleteTopic(topicID){
        var topic = getTopic(topicID)

        if (topic == null) return
        setDeleteTopicForm(topic)

        swal({
            title: 'Apakah anda yakin akan menghapus Topik ' + topic.instance.name + '?',
            text: 'Semua materi dalam Topik ' + topic.instance.name + ' yang pernah anda buat akan menghilang',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya'
        },
        function (isConfirm) {
            if (isConfirm) {
                $('#delete_topic_delete').submit()
            }
        });
    }

    function setDeleteTopicForm(topic){
        $('#delete_topic_id').val(topic.instance.id)
    }
</script>
@endif
@endsection

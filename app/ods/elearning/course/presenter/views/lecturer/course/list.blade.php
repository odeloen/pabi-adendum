
@extends('Ods\Core::template.master')
<?php
/**
 * @var \App\Ods\Elearning\Course\Presenter\Models\CourseViewModel[] $courses
 */
?>
@section('addcss')
<link href="{{asset('template/croppie/croppie.css')}}" rel="stylesheet" type="text/css">
<style>]
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
.blog-horizontal:hover{
  margin-top: -7px;
 -moz-box-shadow:    0 0 20px #b4abab;
 -webkit-box-shadow: 0 0 20px #b4abab;
 box-shadow:         0 0 20px #b4abab;
}
</style>
@endsection
@section('breadcrumbs')
<li class="active text-grey">Kelola Kelas</li>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-body panel-body-accent">
            <div class="media no-margin">
                <div class="media-left media-middle">
                    <i class="icon-book2 icon-3x" style="color:#4C568A"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="no-margin text-semibold">
                        @if (!empty($courses))
                            {{$courses->count()}}
                        @else
                            10
                        @endif
                    </h3>
                    <span class="text-uppercase text-size-mini text-muted">kelas yang anda buka</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $i = 0 ?>
@if (!empty($courses))
    @foreach ($courses as $course)
        @if ($i % 2 == 0)
        <div class="row">
        @endif
        <div class="col-lg-6" >
            <a href="{{route('elearning.lecturer.course.show', $course->id)}}" style="text-decoration:none;color:inherit;">
            <div class="panel panel-flat blog-horizontal blog-horizontal-2">

                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="thumb">
                            @if (!empty($course->image_path != null))
                                <img src="{{env('APP_URL')}}/sl/images/{{$course->image_path}}" class="img-responsive img-rounded" alt="" style="max-height:100px; width:auto; width:auto;">
                            @else
                                <img src="{{asset('template/global_assets/images/placeholders/placeholder.jpg')}}" class="img-responsive img-rounded" alt="" style="max-height:100px; width:auto;">
                            @endif
                        </div>

                            <div class="blog-preview">
                                <div class="content-group-sm media blog-title stack-media-on-mobile text-left">
                                    <div class="media-body">
                                        <h5 class="text-semibold no-margin">{{$course->name}}</h5>

                                        <ul class="list-inline list-inline-separate no-margin text-muted">
                                            <li>oleh <span class="text-primary">{{$course->lecturer}}</span></li>
                                            <li>diperbarui <span style="color: #3F51B5">{{$course->updated_at_string}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="blog-preview" style=" word-wrap: break-word; min-height:60px;">
                                {{$course->description}}
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements">
                            <a href="{{route('elearning.lecturer.course.show', $course->id)}}" class="heading-text pull-right">Lihat Kelas <i class="icon-arrow-right14 position-right"></i></a>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @if ($i % 2 == 1)
        </div>
        @endif
        <?php $i++ ?>
    @endforeach
    @if ($i % 2 == 1)
    </div>
    @endif
@endif

<div class="row" style="position: fixed; right: 40px; bottom: 70px; z-index: 1">
    <div class="col-md-12">
        <button type="button" class="btn bg-primary btn-float btn-float-lg legitRipple" style="float: right;" data-toggle="modal" data-target="#modal_classAdd">
            <i class="icon-plus22"></i>
            <span>Tambah Kelas</span>
        </button>
    </div>
</div>
<div id="modal_classAdd" class="modal fade" tabindex="-1" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Buat Kelas</h5>
            </div>

            <form action="{{route('elearning.lecturer.course.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Nama Kelas</h6>
                                <input name="name" type="text" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Foto Kelas</h6>
                                <input name="image" type="file" class="file-styled item-img file center-block " accept="image/*" autocomplete="off"/>
                                <figure class="text-center">
                                    <img class="gambar img-responsive img-thumbnail" id="item-img-output" />
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Deskripsi</h6>
                                <textarea name="description" class="form-control maxlength-textarea" autocomplete="off" maxLength="200" rows="2" style="resize:vertical"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Kelas</button>
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
                <div id="upload-demo" class="center-block" style="max-height:300px;width:auto;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>
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
            $('#cropImagePop').modal('toggle');
        });
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
</script>
@endsection

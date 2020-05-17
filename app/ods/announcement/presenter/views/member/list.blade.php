@extends('Ods\Core::template.master')

@section('addcss')
<style>]

.blog-horizontal:hover{
  margin-top: -7px;
 -moz-box-shadow:    0 0 20px #b4abab;
 -webkit-box-shadow: 0 0 20px #b4abab;
 box-shadow:         0 0 20px #b4abab;
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close_image {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close_image:hover,
.close_image:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}


</style>
@endsection
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading " style="background: #00838F;">
        <h6 class="panel-title">Announcement</h6>
    </div>
    <div class="panel-body">
        @if(!empty($announcements))
            @foreach ($announcements as $announcement)
                <div class="col-lg-6">
                    <a href="{{route('member.announcement.show', $announcement->id)}}" style="text-decoration:none;color:inherit;">
                        <div class="panel panel-flat blog-horizontal blog-horizontal-2" style="cursor:pointer;">

                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="thumb">
                                        <img src="{{env('APP_URL')}}/sl/images/{{$announcement->imagePath}}" style="height:200px; width:auto;" alt="">
                                    </div>

                                    <div class="blog-preview">
                                        <div class="content-group-sm media blog-title stack-media-on-mobile text-left">
                                            <div class="media-body">
                                                <h5 class="text-semibold no-margin">{{$announcement->title}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

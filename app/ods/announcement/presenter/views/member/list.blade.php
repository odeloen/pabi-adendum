@extends('Ods\Core::template.master')

@section('addcss')
<style>]

.blog-horizontal:hover{
  margin-top: -7px;
 -moz-box-shadow:    0 0 20px #b4abab;
 -webkit-box-shadow: 0 0 20px #b4abab;
 box-shadow:         0 0 20px #b4abab;
}
</style>
@endsection
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading panel-indigo">
        <h6 class="panel-title">Announcement</h6>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <a href="{{route('admin.list')}}" style="text-decoration:none;color:inherit;">
            <div class="panel panel-flat  blog-horizontal blog-horizontal-2">
                <div class="panel-body">
                    <div class="thumb">
                        <img src="{{asset('portrait.jpg')}}" style="height:200px; width:auto;" alt="">
                    </div>

                    <div class="blog-preview">
                        <h6 class="text-semibold mt-3"><a href="#" class="text-default">For ostrich much For ostrich much For ostrich much For ostrich much For ostrich much For ostrich much </a></h6>
                    </div>
                </div>
            </div>
        </div>
    </a>
        <div class="col-lg-6">
            <div class="panel panel-flat  blog-horizontal blog-horizontal-2">
                <div class="panel-body">
                    <div class="thumb">
                        <img src="{{asset('landscape.jpg')}}"  style="height:200px; width:auto;" alt="">
                    </div>

                    <div class="caption">
                        <h6 class="text-semibold mt-3"><a href="#" class="text-default">A while back I needed to count the amount of letters that a piece of text in an email template had (to avoid passing any character limits). Unfortunately, I could not think of a quick way to do so on my macbook and I therefore turned to the Internet.</a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-flat  blog-horizontal blog-horizontal-2">
                <div class="panel-body">
                    <div class="thumb">
                        <img src="{{asset('portrait.jpg')}}" style="height:200px; width:auto;" alt="">
                    </div>

                    <div class="caption">
                        <h6 class="text-semibold mt-3"><a href="#" class="text-default">For ostrich much For ostrich much For ostrich much For ostrich much For ostrich much For ostrich much </a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-flat  blog-horizontal blog-horizontal-2">
                <div class="panel-body">
                    <div class="thumb">
                        <img src="{{asset('landscape.jpg')}}"  style="height:200px; width:auto;" alt="">
                    </div>

                    <div class="caption">
                        <h6 class="text-semibold mt-3"><a href="#" class="text-default">A while back I needed to count the amount of letters that a piece of text in an email template had (to avoid passing any character limits). Unfortunately, I could not think of a quick way to do so on my macbook and I therefore turned to the Internet.</a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6" >
            <a href="#" style="text-decoration:none;color:inherit;">
            <div class="panel panel-flat blog-horizontal blog-horizontal-2">

                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="thumb">
                            <img src="{{asset('landscape.jpg')}}" class="img-responsive img-rounded" alt="" style="max-height:100px; width:auto;">
                        </div>

                            <div class="blog-preview">
                                <div class="content-group-sm media blog-title stack-media-on-mobile text-left">
                                    <div class="media-body">
                                        <h5 class="text-semibold no-margin">ohhh</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="blog-preview" style=" word-wrap: break-word; min-height:60px;">
                                aaaa
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements">
                            stack-media-on-mobile
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('addjs')
<script type="text/javascript">

</script>
@endsection
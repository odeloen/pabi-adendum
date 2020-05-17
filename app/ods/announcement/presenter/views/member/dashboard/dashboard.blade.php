<div class="panel panel-info">
    <div class="panel-heading" style="background: #00838F;">
        <h6 class="panel-title">Announcement Terbaru</h6>
    </div>
    <div class="panel-body">
        @if(!empty($announcements))
            @foreach ($announcements as $announcement)
                <div class="col-lg-6">
                    <a href="{{route('member.announcement.show', $announcement->id)}}" target="_blank" style="text-decoration:none;color:inherit;">
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
        
        <div class="col-lg-12" style="margin-bottom: 10px;">
            <div class="text-right mt-5">
                <a href="{{route('member.announcement.list')}}">
                    <button class="btn bg-info-600">Lihat Announcement Lainnya</button>
                </a>
            </div>
        </div>
    </div>
</div>
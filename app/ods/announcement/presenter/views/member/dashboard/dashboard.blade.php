<div class="panel panel-info">
    <div class="panel-heading" style="background: #00838F;">
        <h6 class="panel-title">Announcement Terbaru</h6>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <a data-target="#modal_detail" data-toggle="modal" href="#modal_detail" style="text-decoration:none;color:inherit;">
                <div class="panel panel-flat blog-horizontal blog-horizontal-2" style="cursor:pointer;">

                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="thumb">
                                <img src="{{asset('landscape.jpg')}}" style="height:200px; width:auto;" alt="">
                            </div>

                            <div class="blog-preview">
                                <div class="content-group-sm media blog-title stack-media-on-mobile text-left">
                                    <div class="media-body">
                                        <h5 class="text-semibold no-margin">ohhh</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6">
            <a data-target="#modal_detail" data-toggle="modal" href="#modal_detail" style="text-decoration:none;color:inherit;">
                <div class="panel panel-flat blog-horizontal blog-horizontal-2" style="cursor:pointer;">

                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="thumb">
                                <img src="{{asset('portrait.jpg')}}" style="height:200px; width:auto;" alt="">
                            </div>

                            <div class="blog-preview">
                                <div class="content-group-sm media blog-title stack-media-on-mobile text-left">
                                    <div class="media-body">
                                        <h5 class="text-semibold no-margin">ohhh</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-lg-12" style="margin-bottom: 10px;">
            <div class="text-right mt-5">
                <a href="{{route('member.announcement.list')}}">
                    <button class="btn bg-info-600">Lihat Announcement Lainnya</button>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="modal_detail" class="modal fade" tabindex="-1" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Detail Announcement</h5>
            </div>

            <div class="modal-body">
                <h6 class="text-semibold">Judul</h6>
                <img class="myImg" src="{{asset('portrait.jpg')}}" alt="Snow" style="width:100%;max-width:250px;display: block;margin-left: auto; margin-right: auto; margin-bottom:10px">
				<p>Konten</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_image" class="modal" style="overflow-y: auto; background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.9);">
    <span class="close_image">&times;</span>
    <img class="modal-content" id="img01">
</div>
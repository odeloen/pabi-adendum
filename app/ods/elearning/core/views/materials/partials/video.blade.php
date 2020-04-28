<div class="panel-body">
    {{--video--}}
    <div class="content-group-lg">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="{{$material->instance->video_path}}" frameborder="0" allowfullscreen></iframe>
            {{-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/vlDzYIIOYmM" frameborder="0" allowfullscreen></iframe> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h6 class="text-semibold">Keterangan Tambahan</h6>
            <div style="text-align:justify">
                <p>{{$material->instance->description}}</p>
            </div>
        </div>
    </div>
</div>

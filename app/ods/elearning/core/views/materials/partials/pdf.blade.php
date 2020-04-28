<div class="panel-body">
    {{--pdf--}}
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-body">
                <div class="media">
                    <div class="media-left">
                        <a href="#"><i class="icon-file-text2 text-primary-400  no-edge-top mt-5"></i></a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-heading text-semibold"><a href="{{route('sl.file.images', $material->instance->file_path)}}" class="text-default">{{$material->instance->file_name}}</a></h6>
                    </div>
                </div>
            </div>
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

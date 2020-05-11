@extends('Ods\Core::template.master')


@section('two_sidebar')
<div hidden="hidden">{{$two_sidebar="1"}}</div>
@endsection


@section('content')
<div class="panel">
    <div class="panel-heading">
        <h6 class="panel-title"><strong>Ujian Kelas</strong></h6>
    </div>
    <div class="panel-body">
    nama kelasnya apa, topiknya apa aja(?), durasi, nilai minimum, aturan
    </div>
</div>
@endsection

@section('sidebar-right')
    <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
        <div class="sidebar-content">
        
            <a href="">
                <button type="button" class="btn bg-indigo-800 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;" data-toggle="modal" data-target="#modal_form_horizontal">
                    <i class="icon-circle-left2"></i> <span>Kembali ke Kelas</span>
                </button>
            </a>
            <div class="thumbnail">
                <div class="thumb">
                    <img src="{{asset('template/global_assets/images/placeholders/placeholder.jpg')}}" class="img-responsive img-rounded" alt="">
                </div>

                <div class="caption">
                    <div class="content-group-sm media">
                        <div class="media-body">
                            <h6 class="text-semibold no-margin">g</h6>
                            <ul class="list-inline list-inline-separate no-margin text-muted">
                                <li>oleh <span class="text-primary">g</span></li></li>
                                <li>diperbarui <span style="color: #3F51B5">g</span> </li>
                                <li>
                                    <span class="badge bg-grey">g</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div style="text-align: justify; word-wrap: break-word;">
                        g
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
@endsection
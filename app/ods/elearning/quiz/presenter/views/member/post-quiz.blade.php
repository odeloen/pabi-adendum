@extends('Ods\Core::template.master')



@section('content')
<div class="panel panel-body border-top-indigo text-center">
    <h5 class="no-margin text-semibold">Hasil Kuis</h5>
    <br>
    <p class="mb-15">Nilai Akhir</p>
    <h2>80</h2>

    <h5 class="mt-3 text-success">Selamat Anda Lulus!</h5>
    <p class="mb-15">Silahkan ajukan kredit poin kelulusan anda, pada menu <b>Borang</b> atau klik tombol di bawah</p>
    <div class="text-center">
        <a href="{{ url('/member/master_borang') }}">
        <button type="button" class="btn bg-success-400 btn-labeled"><b><i class=" icon-chevron-right"></i></b> Menuju Borang</button>
        </a>
    </div>

    <h5 class="mt-3 text-danger">Anda gagal lulus ujian.</h5>
    <p class="mb-15">Silahkan mengerjakan kuis kelas ini lain waktu.</p>
</div>
@endsection

@section('sidebar-right')
    <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
        <div class="sidebar-content">
        
            <a href="">
                <button type="button" class="btn bg-grey-300 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;">
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

@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script>
$(".control-primary").uniform({
    wrapperClass: 'border-primary-600 text-primary-800'
});
</script>
@endsection
@extends('Ods\Core::template.master')


@section('two_sidebar')
<div hidden="hidden">{{$two_sidebar="1"}}</div>
@endsection


@section('content')
<div class="panel panel-body border-top-indigo text-center">
    <h5 class="no-margin text-semibold">Kuis Kelas Judul</h5>
    <br>
    <table class="table table-borderless table-xs content-group-sm" style="width:70%;margin-left:auto; margin-right:auto;">
        <tbody>
            <tr>
                <td><i class="icon-alarm position-left"></i> Durasi</td>
                <td>120 menit</td>
            </tr>
            <tr>
                <td><i class="icon-cube position-left"></i> Jumlah soal</td>
                <td>500 butir</td>
            </tr>
            <tr>
                <td><i class="icon-star-full2 position-left"></i> Nilai batas bawah</td>
                <td>60</td>
            </tr>
            <tr>
                <td><i class="icon-clipboard6 position-left"></i> Nilai terakhir</td>
                <td><i>belum pernah mengikuti kuis kelas ini</i></td>
            </tr>
            <tr>
                <td><i class="icon-clipboard6 position-left"></i> Nilai tertinggi anda</td>
                <td><i>belum pernah mengikuti kuis kelas ini</i></td>
            </tr>
            <tr>
                <td><i class="icon-calendar position-left"></i> Terakhir mengambil kuis</td>
                <td><i>belum pernah mengikuti kuis kelas ini</i></td>
            </tr>
        </tbody>
    </table>

    <br>
    <h6 class="text-semibold text-left">Aturan yang perlu peserta pahami sebelum melakukan kuis</h6>
    <p class="content-group text-left">
        1. Kuis akan dinyatakan selesai dan nilai akan keluar ketika waktu pengerjaan sudah habis atau peserta menekan tombol <b>Selesai</b>.<br>
        2. Peserta akan mendapat kredit poin ketika dinyatakan lulus kuis atau mendapat nilai di atas <b>nilai batas bawah</b>.<br>
        3. Peserta hanya dapat menerima kredit poin dari kuis ini sekali.<br>
        4. Peserta perlu mengajukan melalui menu <b>Borang</b> untuk mendapatkan kredit poin.<br>
        5. Apabila terjadi hal-hal menyebabkan website kuis tertutup, jawaban peserta tidak akan tersimpan dan peserta perlu mengerjakan kuis dari awal.
    </p>
    <label class="checkbox-inline">
        <input type="checkbox" class="control-primary">
        Saya telah memahami aturan kuis
    </label>
    <br>
    <br>
    <div class="text-center">
        <button type="button" class="btn bg-primary-400 btn-labeled"><b><i class=" icon-chevron-right"></i></b> Mulai Ujian</button>
    </div>
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
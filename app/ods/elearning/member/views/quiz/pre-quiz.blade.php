@extends('Ods\Core::template.master')

<?php
/**
 * @var \App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse $course
 * @var \App\Ods\Elearning\Core\Entities\Quizzes\AcceptedQuiz $quiz
 */
?>

@section('content')
<div class="panel panel-body border-top-indigo text-center">
    <h5 class="no-margin text-semibold">Kuis Kelas {{$course->name}}</h5>
    <br>
    <table class="table table-borderless table-xs content-group-sm" style="width:70%;margin-left:auto; margin-right:auto;">
        <tbody>
            <tr>
                <td><i class="icon-alarm position-left"></i> Durasi</td>
                <td>{{$quiz->duration}} menit</td>
            </tr>
            <tr>
                <td><i class="icon-cube position-left"></i> Jumlah soal</td>
                <td>{{$quiz->questions->count()}} butir</td>
            </tr>
            <tr>
                <td><i class="icon-star-full2 position-left"></i> Nilai batas bawah</td>
                <td>{{$quiz->threshold}}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <form action="{{route('member.quiz.quiz')}}" method="post">
        @csrf
        <input type="hidden" name="course_id" value="{{$course->id}}">
        <h6 class="text-semibold text-left">Aturan yang perlu peserta pahami sebelum melakukan kuis</h6>
        <p class="content-group text-left">
            1. Kuis akan dinyatakan selesai dan nilai akan keluar ketika waktu pengerjaan sudah habis atau peserta menekan tombol <b>Selesai</b>.<br>
            2. Peserta akan mendapat kredit poin ketika dinyatakan lulus kuis atau mendapat nilai di atas <b>nilai batas bawah</b>.<br>
            3. Peserta hanya dapat menerima kredit poin dari kuis ini sekali.<br>
            4. Peserta perlu mengajukan melalui menu <b>Borang</b> untuk mendapatkan kredit poin.<br>
            5. Apabila terjadi hal-hal menyebabkan website kuis tertutup, jawaban peserta tidak akan tersimpan dan peserta perlu mengerjakan kuis dari awal.
        </p>
        <label class="checkbox-inline">
            <input name="tac" type="checkbox" class="control-primary">
            Saya telah memahami aturan kuis
        </label>
        <br>
        <br>
        <div class="text-center">
            <button type="submit" class="btn bg-primary-400 btn-labeled"><b><i class=" icon-chevron-right"></i></b> Mulai Ujian</button>
        </div>
    </form>
</div>
@endsection

@section('sidebar-right')
    <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
        <div class="sidebar-content">

            <a href="{{route('member.course.show', $course->id)}}">
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
                            <h6 class="text-semibold no-margin">{{$course->name}}</h6>
                            <ul class="list-inline list-inline-separate no-margin text-muted">
                                <li>oleh <span class="text-primary">{{$course->lecturer->fullname}}</span></li></li>
                                <li>diperbarui <span style="color: #3F51B5">{{$course->updated_at_string}}</span> </li>
                            </ul>
                        </div>
                    </div>

                    <div style="text-align: justify; word-wrap: break-word;">
                        {{$course->description}}
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

@extends('Ods\Core::template.master')

<?php
    /**
     * @var \App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse $course
     * @var \App\Ods\Elearning\Core\Entities\Quizzes\SubmittedQuiz $quiz
     * @var \App\Ods\Elearning\Core\Entities\Questions\SubmittedQuestion $active_question
     */
?>
@section('two_sidebar')
<div hidden="hidden">{{$two_sidebar="1"}}</div>
@endsection


@section('content')
<div class="alert alpha-indigo border-indigo alert-styled-left">
    Ujian Kelas <b>{{$course->name}}</b>
</div>
<div class="panel panel-flat border-left-xlg border-left-indigo">
    <div class="panel-heading">
        <span class="label bg-indigo-300" style="font-size: 22pt;margin-bottom:5px;">{{$active_question->no}}</span>
        <br>
        <h4 class="panel-title"><span class="text-semibold">Pertanyaan:</h4>
    </div>


    <div class="panel-body" style="font-size:12pt;">
        {!! $active_question->description !!}
    </div>
</div>

<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-title text-semibold">
            <h5>Jawaban Benar Pertanyaan Terkait</h5>
        </div>
    </div>

    <div class="panel-body text-center" >
        <div class="btn-toolbar">
            <div class="btn-group">
                <button type="button" class="btn @if($active_question->correct_answer === 'A') btn-success @else btn-default @endif" style="width:18%; margin-bottom:5px;">A</button>
                <button type="button" class="btn @if($active_question->correct_answer === 'B') btn-success @else btn-default @endif" style="width:18%; margin-bottom:5px;">B</button>
                <button type="button" class="btn @if($active_question->correct_answer === 'C') btn-success @else btn-default @endif" style="width:18%; margin-bottom:5px;">C</button>
                <button type="button" class="btn @if($active_question->correct_answer === 'D') btn-success @else btn-default @endif" style="width:18%; margin-bottom:5px;">D</button>
                <button type="button" class="btn @if($active_question->correct_answer === 'E') btn-success @else btn-default @endif" style="width:18%; margin-bottom:5px;">E</button>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban A</span>
        <br>
        {!! $active_question->answer_a !!}
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban B</span>
        <br>
        {!! $active_question->answer_b !!}
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban C</span>
        <br>
        {!! $active_question->answer_c !!}
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban D</span>
        <br>
        {!! $active_question->answer_d !!}
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban E</span>
        <br>
        {!! $active_question->answer_e !!}
    </div>
</div>

@endsection

@section('sidebar-right')
    <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
        <div class="sidebar-content" >

            <a href="{{route('admin.submission.show', $course->id)}}">
                <button type="button" class="btn bg-grey-300 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;">
                    <i class="icon-circle-left2"></i> <span>Kembali ke Kelas</span>
                </button>
            </a>
            <div class="panel panel-flat border-top-primary">

                <div class="panel-body text-center">
                    <h6><span class="text-semibold">Waktu Pengerjaan</h6>
                    <h2><span class="text-semibold">{{$quiz->duration}} menit</h2>
                </div>
            </div>
            <div class="panel panel-flat border-top-primary">

                <div class="panel-body text-center">
                    <h6><span class="text-semibold">Batas Nilai Bawah Kelulusan</h6>
                    <h2><span class="text-semibold">{{$quiz->threshold}}</h2>
                </div>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading">
                    <div class="panel-title text-semibold">
                        Soal
                    </div>
                </div>

                <div class="panel-body text-center">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            @foreach($quiz->questions as $question)
                                <a href="{{route('admin.question.show', [$course->id, $quiz->id, $question->id])}}">
                                    @if($question->no == $active_question->no)
                                    <button type="button" class="btn bg-indigo-300" style="width:32%; margin-bottom:5px;">
                                        {{$question->no}}
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-default" style="width:32%; margin-bottom:5px;">
                                        {{$question->no}}
                                    </button>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addjs')

@endsection

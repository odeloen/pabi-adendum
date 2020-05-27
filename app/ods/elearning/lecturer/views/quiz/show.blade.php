@extends('Ods\Core::template.master')
<?php
    /**
     * @var \App\Ods\Elearning\Core\Entities\Courses\Course $course
     * @var \App\Ods\Elearning\Core\Entities\Quizzes\OriginalQuiz $quiz
     * @var \App\Ods\Elearning\Core\Entities\Questions\OriginalQuestion $active_question
     */
?>
@section('two_sidebar')
<div hidden="hidden">{{$two_sidebar="1"}}</div>
@endsection


@section('content')
<form id="update_form" action="{{route('lecturer.question.update')}}" method="post">
    @csrf
    <input type="hidden" name="course_id" value="{{$course->id}}">
    <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
    <input type="hidden" name="question_id" value="{{$active_question->id}}">
    <div class="alert alpha-indigo border-indigo alert-styled-left">
        Ujian Kelas <b>{{$course->name}}</b>
    </div>
    <div class="text-right mt-5 mb-10">
        <button type="submit" formaction="{{route('lecturer.question.delete')}}" formmethod="post" class="btn bg-grey-300">Hapus Pertanyaan dan Jawaban</button>
    </div>
    <div class="panel panel-flat border-left-xlg border-left-indigo">
        <div class="panel-heading">
            <span id="question_number_text" class="label label-default" style="font-size: 22pt;margin-bottom:5px;">{{$active_question->no}}</span>
            <br>
            <h4 class="panel-title"><span class="text-semibold">Pertanyaan:</h4>
        </div>


        <div class="panel-body">
            <textarea name="description" class="editor-full" rows="4" cols="4">
                {{$active_question->description}}
            </textarea>
        </div>
    </div>

    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <h5>Jawaban Benar Pertanyaan Terkait</h5>
            </div>
        </div>

        <div class="panel-body text-center" >
            <div class="col-lg-12">
                <label class="radio-inline" style="font-size: 12pt;">
                    <div class="choice"><input @if($active_question->correct_answer === 'A') checked @endif name="correct_answer" value="A" type="radio" class="control-custom" ></div>
                    A
                </label>
                <label class="radio-inline"style="font-size: 12pt;">
                    <div class="choice"><input @if($active_question->correct_answer === 'B') checked @endif name="correct_answer" value="B" type="radio" class="control-custom" ></div>
                    B
                </label>
                <label class="radio-inline"style="font-size: 12pt;">
                    <div class="choice"><input @if($active_question->correct_answer === 'C') checked @endif name="correct_answer" value="C" type="radio" class="control-custom" ></div>
                    C
                </label>
                <label class="radio-inline"style="font-size: 12pt;">
                    <div class="choice"><input @if($active_question->correct_answer === 'D') checked @endif name="correct_answer" value="D" type="radio" class="control-custom" ></div>
                    D
                </label>
                <label class="radio-inline"style="font-size: 12pt;">
                    <div class="choice"><input @if($active_question->correct_answer === 'E') checked @endif name="correct_answer" value="E" type="radio" class="control-custom" ></div>
                    E
                </label>
            </div>
        </div>
    </div>
    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban A</span>
            <textarea name="answers[a]" class="editor-answer" rows="2" cols="4">
                {{$active_question->answer_a}}
            </textarea>
        </div>
    </div>
    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban B</span>
            <textarea name="answers[b]" class="editor-answer" rows="2" cols="4">
                {{$active_question->answer_b}}
            </textarea>
        </div>
    </div>
    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban C</span>
            <textarea name="answers[c]" class="editor-answer" rows="2" cols="4">
                {{$active_question->answer_c}}
            </textarea>
        </div>
    </div>
    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban D</span>
            <textarea name="answers[d]" class="editor-answer" rows="2" cols="4">
                {{$active_question->answer_d}}
            </textarea>
        </div>
    </div>
    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban E</span>
            <textarea name="answers[e]" class="editor-answer" rows="2" cols="4">
                {{$active_question->answer_e}}
            </textarea>
        </div>
    </div>
</form>
    <div id="modal_setting" class="modal fade" tabindex="-1" style="overflow-y: auto;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-teal-700">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Pengaturan Kuis</h5>
                </div>

                <form action="{{route('lecturer.quiz.update')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Durasi:</label>
                            <div class="input-group">
                                <input name="duration" value="{{$quiz->duration}}" type="text" class="form-control">
                                <span class="input-group-addon">menit</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nilai Batas Bawah Kelulusan:</label>
                            <input name="threshold" value="{{$quiz->threshold}}" type="text" class="form-control" id="inputNumber">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('sidebar-right')
    <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
        <div class="sidebar-content" >

            <a href="{{route('lecturer.course.show', $course->id)}}">
                <button type="button" class="btn bg-grey-300 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;">
                    <i class="icon-circle-left2"></i> <span>Kembali ke Kelas</span>
                </button>
            </a>
            <button type="button" class="btn bg-teal-700 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;" data-toggle="modal" data-target="#modal_setting">
                <i class="icon-cog"></i> <span>Pengaturan Kuis</span>
            </button>
            <button onclick="onClickUpdateQuestion()" type="submit" class="btn bg-indigo-800 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;">
                <i class="icon-floppy-disk"></i> <span>Simpan Soal dan Jawaban</span>
            </button>
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
                                <a href="{{route('lecturer.question.show', [$course->id, $quiz->id, $question->id])}}">
                                    <button type="button" class="btn btn-default" style="width:32%; margin-bottom:5px;">
                                        {{$question->no}}
                                    </button>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <form action="{{route('lecturer.question.create')}}" method="post">
                    @csrf
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                    <div class="panel-footer no-padding">
                        <button type="submit" class="btn btn-default btn-block no-border">Tambah Soal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
<script>
    let updateForm = $('#update_form')

    function onClickUpdateQuestion(){
        updateForm.submit()
    }
</script>
<script>

$(".control-custom").uniform({
    wrapperClass: 'border-indigo-600'
});

CKEDITOR.replaceAll('editor-answer', {
    height: 50,
    extraPlugins: 'forms'
});
CKEDITOR.replaceAll('editor-full', {
    height: 200,
    extraPlugins: 'forms'
});
    $("input[name='verdict']").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        initval: 60,
        boosted:5,
        maxboostedstep:10,
    });
</script>
@endsection

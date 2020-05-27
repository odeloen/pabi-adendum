@extends('Ods\Core::template.master')
<?php
/**
 * @var \App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse $course
 * @var \App\Ods\Elearning\Core\Entities\Quizzes\AcceptedQuiz $quiz
 * @var \App\Ods\Elearning\Core\Entities\QuizHistory\QuizHistory $quiz_history
 */
?>

@section('need_sidebar')
<div hidden="hidden">{{$need_sidebar="1"}}</div>
@endsection


@section('content')
<form id="quiz_form" action="{{route('member.quiz.post')}}" method="post">
    @csrf
    <input type="hidden" name="course_id" value="{{$course->id}}">
    <input type="hidden" name="quiz_history_id" value="{{$quiz_history->id}}">
    <input id="quiz_answers" type="hidden" name="answers">
</form>
<div class="col-sm-3">

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
                        <button id="question_number_{{$question->no}}" onclick="onClickChangeQuestion('{{$question->no}}')" type="button" class="btn btn-default" style="width:32%; margin-bottom:5px;">{{$question->no}}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-9">
    <div class="alert alpha-indigo border-indigo alert-styled-left">
        Ujian Kelas <b>{{$course->name}}</b>
    </div>
    <div class="panel panel-flat border-left-xlg border-left-indigo">
        <div class="panel-heading">
            <span id="question_number_text" class="label label-default" style="font-size: 22pt;margin-bottom:5px;">78</span>
            <br>
            <h4 class="panel-title"><span class="text-semibold">Pertanyaan:</h4>
        </div>


        <div id="question_description_text" class="panel-body" style="font-size:12pt;">
            Pertanyaan
        </div>
    </div>

    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <input id="question_answer_a_check" onclick="onClickAnswer(0)" name="choice" type="radio" class="control-custom" >
            <br>
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban A</span>
            <br>
            <div id="question_answer_a_text">Jawaban</div>
        </div>
    </div>
    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <input id="question_answer_b_check" onclick="onClickAnswer(1)" name="choice" type="radio" class="control-custom" >
            <br>
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban B</span>
            <br>
            <div id="question_answer_b_text">Jawaban</div>
        </div>
    </div>
    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <input id="question_answer_c_check" onclick="onClickAnswer(2)" name="choice" type="radio" class="control-custom" >
            <br>
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban C</span>
            <br>
            <div id="question_answer_c_text">Jawaban</div>
        </div>
    </div>
    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <input id="question_answer_d_check" onclick="onClickAnswer(3)" name="choice" type="radio" class="control-custom" >
            <br>
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban D</span>
            <br>
            <div id="question_answer_d_text">Jawaban</div>
        </div>
    </div>
    <div class="panel panel-flat border-left-lg border-left-info">
        <div class="panel-body">
            <input id="question_answer_e_check" onclick="onClickAnswer(4)" name="choice" type="radio" class="control-custom" >
            <br>
            <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban E</span>
            <br>
            <div id="question_answer_e_text">Jawaban</div>
        </div>
    </div>
</div>



@endsection

@section('sidebar-right')
    <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
        <div class="sidebar-content" >

            <button onclick="onClickSubmit()" type="button" class="btn bg-warning-300 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;">
                <i class=" icon-checkmark"></i> <span>Selesai</span>
            </button>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-watch position-left"></i> Durasi</h6>
                </div>

                <div class="panel-body">

                    <ul class="timer mb-10">
                        <li>
                            <div id="duration_hour_text">09</div> <span>jam</span>
                        </li>
                        <li class="dots">:</li>
                        <li>
                            <div id="duration_minute_text">09</div> <span>menit</span>
                        </li>
                        <li class="dots">:</li>
                        <li>
                            <div id="duration_second_text">09</div> <span>waktu</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-flat border-top-primary">

                <div class="panel-body text-center">
                    <h6><span class="text-semibold">Batas Nilai Bawah Kelulusan</h6>
                    <h2><span class="text-semibold">80</h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addjs')
{{--Script for initialization--}}
<script>
    let questions = {!! $quiz->questions !!};

    var active_question = null

    $(document).ready(function () {
        onClickChangeQuestion(1)
    })

    String.prototype.replaceAt = function(index, replacement) {
        return this.substr(0, index) + replacement + this.substr(index + replacement.length);
    }
</script>
{{--Script for answering--}}
<script>
    var member_answers = "{!! $quiz_history->answers !!}";
    var form_member_answers = "{!! $quiz_history->answers !!}";

    function onClickAnswer(member_choice){

        form_member_answers = form_member_answers.replaceAt(active_question.no - 1, active_question.answers[member_choice].choice);

        if (member_choice == 0){
            member_answers = member_answers.replaceAt(active_question.no - 1, "A");
        }
        else if (member_choice == 1){
            member_answers = member_answers.replaceAt(active_question.no - 1, "B");
        }
        else if (member_choice == 2){
            member_answers = member_answers.replaceAt(active_question.no - 1, "C");
        }
        else if (member_choice == 3){
            member_answers = member_answers.replaceAt(active_question.no - 1, "D");
        }
        else if (member_choice == 4){
            member_answers = member_answers.replaceAt(active_question.no - 1, "E");
        }

        var question_html_id = "#question_number_" + active_question.no;
        $(question_html_id).addClass("btn-success");
    }
</script>
{{--Script for question detail manipulation--}}
<script>
    function getQuestion(no){
        return questions[no - 1]
    }

    function onClickChangeQuestion(no){
        var question = getQuestion(no)

        active_question = question
        setQuestionDetail(question)
    }

    function setQuestionDetail(question){
        $('#question_number_text').html(question.no)
        $('#question_description_text').html(question.description)

        $('#question_answer_a_text').html(question.answers[0].description)
        $('#question_answer_b_text').html(question.answers[1].description)
        $('#question_answer_c_text').html(question.answers[2].description)
        $('#question_answer_d_text').html(question.answers[3].description)
        $('#question_answer_e_text').html(question.answers[4].description)

        $('.control-custom').prop('checked', false)

        if (member_answers[active_question.no - 1] == 'A'){
            $('#question_answer_a_check').prop('checked', true)
        }
        else if (member_answers[active_question.no - 1] == 'B'){
            $('#question_answer_b_check').prop('checked', true)
        }
        else if (member_answers[active_question.no - 1] == 'C'){
            $('#question_answer_c_check').prop('checked', true)
        }
        else if (member_answers[active_question.no - 1] == 'D'){
            $('#question_answer_d_check').prop('checked', true)
        }
        else if (member_answers[active_question.no - 1] == 'E'){
            $('#question_answer_e_check').prop('checked', true)
        }
    }
</script>
{{--Script for ending the quiz--}}
<script>
    function onClickSubmit() {
        var quiz_form = $('#quiz_form');
        $('#quiz_answers').val(form_member_answers)

        quiz_form.submit()
    }
</script>
{{--Script for duration--}}
<script>
    // Set the date we're counting down to
    var startedAtDate = new Date("{!! $quiz_history->started_at !!}");
    var countDownDate = new Date(startedAtDate.getTime() + {!!$quiz->duration!!} * 60000).getTime();

    // Get today's date and time
    var now = startedAtDate;

    // Update the count down every 1 second
    var x = setInterval(function() {
        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        $('#duration_hour_text').text(hours);
        $('#duration_minute_text').text(minutes);
        $('#duration_second_text').text(seconds);

        // If the count down is over, write some text
        if (distance < 0) {
            onClickSubmit()
        }

        now = new Date(now.getTime() + 1000);
    }, 1000);
</script>
@endsection

<?php

view()->addNamespace('Ods\Elearning\Quiz', app_path('ods/elearning/quiz/presenter/views'));

Route::namespace('Web')->middleware(['web'])->group(function () {
    Route::get("member/pre", function(){
        return view('Ods\Elearning\Quiz::member.pre-quiz');
    });
    Route::get("member/quiz", function(){
        return view('Ods\Elearning\Quiz::member.quiz');
    });
    Route::get("member/post", function(){
        return view('Ods\Elearning\Quiz::member.post-quiz');
    });
    Route::get("lecturer/quiz", function(){
        return view('Ods\Elearning\Quiz::lecturer.quiz');
    });
    Route::get("lecturer/result", function(){
        return view('Ods\Elearning\Quiz::lecturer.result');
    });
    Route::get("admin/quiz", function(){
        return view('Ods\Elearning\Quiz::admin.quiz');
    });
    Route::get("admin/result", function(){
        return view('Ods\Elearning\Quiz::admin.result');
    });
});

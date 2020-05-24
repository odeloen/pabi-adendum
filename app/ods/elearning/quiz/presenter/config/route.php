<?php

view()->addNamespace('Ods\Elearning\Quiz', app_path('ods/elearning/quiz/presenter/views'));

Route::namespace('Web')->middleware(['web'])->group(function () {
    Route::get("member/pre", function(){
        return view('Ods\Elearning\Quiz::member.pre-quiz');
    });
    Route::get("lecturer/quiz", function(){
        return view('Ods\Elearning\Quiz::lecturer.quiz');
    });
    Route::get("admin/quiz", function(){
        return view('Ods\Elearning\Quiz::admin.quiz');
    });
});

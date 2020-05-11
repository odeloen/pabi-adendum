<?php

view()->addNamespace('Ods\Elearning\Quiz', app_path('ods/elearning/quiz/presenter/views'));

Route::namespace('Web')->middleware(['web'])->group(function () {
    Route::get("test", function(){
        return view('Ods\Elearning\Quiz::member.pre-test');
    });
});

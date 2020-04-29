<?php

view()->addNamespace('Ods\Elearning\Quiz', app_path('ods/elearning/quiz/presenter/views'));

Route::namespace('Web')->group(function () {
    Route::get("test", function(){
        return view('Ods\Elearning\Quiz::dummy');
    });
});

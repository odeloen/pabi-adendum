<?php

view()->addNamespace('Ods\Elearning', app_path('ods/elearning/course/presenter/views'));

Route::namespace('App\Ods\Elearning\Course\Presenter\Controllers\Web')->prefix('elearning/')->name('elearning.')->middleware(['web', 'login'])->group(function (){
    Route::namespace('Lecturer')->prefix('lecturer/')->name('lecturer.')->middleware(['web', 'login'])->group(function (){
        Route::get('course/list', 'CourseController@list')->name('course.list');
        Route::post('course/create', 'CourseController@create')->name('course.create');
        Route::post('course/update', 'CourseController@update')->name('course.update');
        Route::post('course/delete', 'CourseController@delete')->name('course.delete');
    });
});

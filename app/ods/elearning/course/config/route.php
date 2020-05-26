<?php

view()->addNamespace('Ods\Elearning\Common', app_path('ods/elearning/course/presenter/views/common'));
view()->addNamespace('Ods\Elearning\Lecturer', app_path('ods/elearning/course/presenter/views/lecturer'));
view()->addNamespace('Ods\Elearning\Admin', app_path('ods/elearning/course/presenter/views/admin'));

Route::namespace('App\Ods\Elearning\Course\Presenter\Controllers\Web')->prefix('elearning/')->name('elearning.')->middleware(['web', 'login'])->group(function (){
    /**
     * Lecturer Routes
     */
    Route::namespace('Lecturer')->prefix('lecturer/')->name('lecturer.')->middleware(['web', 'login'])->group(function (){
        Route::get('course/list', 'CourseController@list')->name('course.list');
        Route::get('course/show/{courseID}', 'CourseController@show')->name('course.show');
        Route::post('course/create', 'CourseController@create')->name('course.create');
        Route::post('course/update', 'CourseController@update')->name('course.update');
        Route::post('course/delete', 'CourseController@delete')->name('course.delete');

        Route::post('topic/create', 'TopicController@create')->name('topic.create');
        Route::post('topic/update', 'TopicController@update')->name('topic.update');
        Route::post('topic/delete', 'TopicController@delete')->name('topic.delete');

        Route::get('material/show/{courseID}:{topicID}:{materialID}', 'MaterialController@show')->name('material.show');
        Route::get('material/create/{courseID}:{topicID}', 'MaterialController@createPage')->name('material.create');
        Route::post('material/create', 'MaterialController@create')->name('material.store');
        Route::get('material/update/{courseID}:{topicID}:{materialID}', 'MaterialController@updatePage')->name('material.edit');
        Route::post('material/update', 'MaterialController@update')->name('material.update');
        Route::post('material/delete', 'MaterialController@delete')->name('material.delete');
    });
});

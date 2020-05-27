<?php

Route::namespace('Web')->middleware(['web', 'login', 'member'])->group(function () {
    Route::get('courses', 'CourseController@list')->name('lecturer.course.list');
    Route::get('courses/{courseID}', 'CourseController@show')->name('lecturer.course.show');
    Route::post('courses/create', 'CourseController@create')->name('lecturer.course.create');
    Route::post('courses/update', 'CourseController@update')->name('lecturer.course.update');
    Route::post('courses/delete', 'CourseController@delete')->name('lecturer.course.delete');

    Route::post('topic/create', 'TopicController@create')->name('lecturer.topic.create');
    Route::post('topic/update', 'TopicController@update')->name('lecturer.topic.update');
    Route::post('topic/delete', 'TopicController@delete')->name('lecturer.topic.delete');

    Route::get('material/{courseID}:{topicID}:{materialID}', 'MaterialController@show')->name('lecturer.material.show');
    Route::get('material/create/{courseID}:{topicID}', 'MaterialController@createPage')->name('lecturer.material.create');
    Route::post('material/create', 'MaterialController@create')->name('lecturer.material.store');
    Route::get('material/update/{courseID}:{topicID}:{materialID}', 'MaterialController@updatePage')->name('lecturer.material.edit');
    Route::post('material/update', 'MaterialController@update')->name('lecturer.material.update');
    Route::post('material/delete', 'MaterialController@delete')->name('lecturer.material.delete');

    Route::get('courses/submissions/{courseID}', 'SubmissionController@list')->name('lecturer.submission.list');
    Route::get('courses/submissions/{courseID}/{submissionID}', 'SubmissionController@show')->name('lecturer.submission.show');
    Route::get('submission/material/{courseID}:{topicID}:{materialID}', 'SubmissionController@showMaterial')->name('lecturer.submission.material.show');

    Route::post('courses/submissions/create', 'SubmissionController@create')->name('lecturer.submission.create');

    Route::get('courses/{courseID}/quiz', 'QuizController@show')->name('lecturer.quiz.show');

    Route::post('quiz/update', 'QuizController@update')->name('lecturer.quiz.update');

    Route::get('quiz/question/{courseID}:{quizID}:{questionID}', 'QuestionController@show')->name('lecturer.question.show');
    Route::post('quiz/question/create', 'QuestionController@create')->name('lecturer.question.create');
    Route::post('quiz/question/update', 'QuestionController@update')->name('lecturer.question.update');
    Route::post('quiz/question/delete', 'QuestionController@delete')->name('lecturer.question.delete');
});

Route::namespace('API')->prefix('api')->name('api.')->middleware(['api'])->group(function () {
    Route::post('topic/delete', 'TopicController@delete')->name('lecturer.topic.delete');
});

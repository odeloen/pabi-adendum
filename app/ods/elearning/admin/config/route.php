<?php
use Illuminate\Support\Facades\Route;

Route::namespace('Web')->middleware(['web', 'login', 'admin'])->group(function () {
    Route::get('submissions/list', 'SubmissionController@list')->name('admin.submission.list');
    Route::get('submissions/{submissionID}', 'SubmissionController@show')->name('admin.submission.show');
    Route::post('submissions/comment', 'SubmissionController@createComment')->name('admin.comment.create');
    Route::post('submissions/uncomment', 'SubmissionController@deleteComment')->name('admin.comment.delete');
    Route::post('submissions/accept', 'SubmissionController@accept')->name('admin.submission.accept');
    Route::post('submissions/decline', 'SubmissionController@decline')->name('admin.submission.decline');

    Route::get('material/{submssionID}:{topicID}:{materialID}', 'MaterialController@show')->name('admin.material.show');

    Route::get('categories/list', 'CategoryController@list')->name('admin.category.list');
    Route::post('categories/create', 'CategoryController@create')->name('admin.category.create');
    Route::post('categories/update', 'CategoryController@update')->name('admin.category.update');
    Route::post('categories/delete', 'CategoryController@delete')->name('admin.category.delete');

    Route::get('submissions/{courseID}/quiz', 'QuizController@show')->name('admin.quiz.show');
    Route::get('quiz/question/{courseID}:{quizID}:{questionID}', 'QuestionController@show')->name('admin.question.show');

    Route::get('quiz/history', 'QuizHistoryController@list')->name('admin.quiz.history');
});

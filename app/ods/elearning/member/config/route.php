<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Web')->middleware(['web', 'login', 'member'])->group(function () {
    Route::get('courses/search', 'CourseController@search')->name('member.course.search');
    Route::get('courses/list', 'CourseController@list')->name('member.course.list');
    Route::get('courses/{courseID}', 'CourseController@show')->name('member.course.show');
    Route::post('courses/follow', 'CourseController@follow')->name('member.course.follow');
    Route::post('courses/unfollow', 'CourseController@unfollow')->name('member.course.unfollow');

    Route::get('material/{submssionID}:{topicID}:{materialID}', 'MaterialController@show')->name('member.material.show');
});

Route::namespace('API')->prefix('api')->middleware(['web','api'])->group(function () {
    Route::get('courses/search', 'CourseController@search')->name('api.member.course.search');
    Route::get('courses/list', 'CourseController@list');
    Route::get('courses/{courseID}', 'CourseController@show');
    Route::get('courses/images/{courseID}','ResourceController@courseImage');

    Route::get('material/{submissionID}:{topicID}:{materialID}', 'MaterialController@show')->name('api.member.material.show');
});

Route::namespace('API')->prefix('api')->middleware(['api'])->group(function () {
    Route::post('courses/follow', 'CourseController@follow')->name('api.member.course.follow');
    Route::post('courses/unfollow', 'CourseController@unfollow')->name('api.member.course.unfollow');
});

<?php
use Illuminate\Support\Facades\Route;

Route::namespace('Web')->middleware(['api'])->group(function () {
    Route::post("lecturer/courses/create", 'LecturerCourseController@create')->name('test.lecturer.course.create');
});

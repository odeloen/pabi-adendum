<?php
use Illuminate\Support\Facades\Route;

Route::namespace('Web')->middleware(['web'])->group(function () {
    Route::get('articles', 'MaterialController@list')->name('general.article.list');
    Route::get('articles/{articleID}', 'MaterialController@show')->name('general.article.show');
});

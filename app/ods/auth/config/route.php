<?php
use Illuminate\Support\Facades\Route;

Route::namespace('Web')->middleware(['web'])->group(function () {
    
});

Route::namespace('Api')->prefix('api')->middleware(['web', 'api'])->group(function () {
    Route::get('member/{userID}', 'MemberController@show');    
});
